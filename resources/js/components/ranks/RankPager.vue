<template>
    <div class="container">
        <div class="row justify-content-end">
            <button class="btn btn-primary mb-3" @click="onAddClick()">
                Add
            </button>
            <PagerComponent
                :headers="headers"
                :actions="actions"
                :endpoint="api_endpoint"
                :bus="child_bus"
            />
            <PagerFormComponent
                :show="form_visible"
                :title="'Rank Form'"
                :disabled_save="is_form_valid === false"
                @saveClick="onSaveClick"
                @closeClick="onCloseClick"
            >
                <div class="form-group">
                    <label for="rankdesc">Description</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            is_form_dirty == false
                                ? ''
                                : isFormControlValid('description')
                                ? 'is-valid'
                                : 'is-invalid'
                        ]"
                        v-model="form_model.description"
                    />
                    <div
                        v-if="isFormControlValid('description') == false"
                        class="invalid-feedback"
                    >
                        <ul>
                            <li
                                v-for="(error, index) in getErrorMessages(
                                    'description'
                                )"
                                :key="index"
                            >
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
            </PagerFormComponent>
        </div>
    </div>
</template>

<script>
import PagerComponent from "../shared/pager/PagerComponent.vue";
import PagerFormComponent from "../shared/pager/PagerFormComponent";

export default {
    data() {
        return {
            child_bus: new Vue(),
            form_model: {
                description: ""
            },
            is_form_dirty: false,
            is_edit: false,
            edit_id: 0,
            errors: {},
            form_visible: false,
            endpoint: "/ranks",
            headers: { description: "DESCRIPTION" },
            actions: [
                {
                    caption: "Edit",
                    class_name: "btn-warning",
                    callback: row => {
                        this.onEditClick(row);
                    }
                },
                {
                    caption: "Delete",
                    class_name: "btn-danger",
                    callback: row => {
                        axios.delete(`${this.endpoint}/${row.id}`).then(() => {
                            this.reloadPager();
                        });
                    }
                }
            ]
        };
    },
    methods: {
        showForm: function() {
            this.form_visible = true;
        },
        hideForm: function() {
            this.form_visible = false;
        },
        clearForm: function() {
            this.is_form_dirty = false;
            Object.keys(this.form_model).forEach(v => {
                this.form_model[v] = "";
            });
        },
        isFormControlValid: function(name) {
            return this.errors[name] ? false : true;
        },
        getErrorMessages: function(name) {
            return this.errors[name];
        },
        onSaveClick: async function() {
            let saveOperation = () => {};
            if (this.checkForm == false) return;
            if (this.is_edit) {
                saveOperation = axios.patch(
                    this.endpoint + "/" + this.edit_id,
                    this.form_model
                );
            } else {
                saveOperation = axios.post(this.endpoint, this.form_model);
            }
            saveOperation
                .then(() => {
                    this.reloadPager();
                    alertify.success("Successfully Saved!", 3);
                })
                .catch(result => {
                    if (result.response.data.errors) {
                        this.errors = result.response.data.errors;
                    } else {
                        alertify.error(result.response.data.message);
                    }
                });
        },
        onCloseClick: function() {
            this.clearForm();
            this.hideForm();
        },
        onAddClick: function(row) {
            this.is_form_dirty = false;
            this.is_edit = false;
            this.showForm();
        },
        onEditClick: function(row) {
            axios.get(`${this.api_endpoint}/${row.id}`).then(result => {
                this.is_edit = true;
                this.edit_id = row.id;
                this.form_model = result.data;
                this.is_form_dirty = true;
                this.showForm();
            });
        },
        reloadPager: function() {
            this.child_bus.$emit("reload");
            this.clearForm();
            this.hideForm();
        }
    },
    computed: {
        is_form_valid: function() {
            return Object.keys(this.errors).length === 0;
        },
        api_endpoint: function() {
            return "/api" + this.endpoint;
        }
    },
    watch: {
        form_model: {
            handler: function() {
                this.is_form_dirty = true;
                this.errors = {};
                if (this.form_model["description"].length === 0) {
                    this.errors["description"] = [
                        "This field is required",
                        ...(this.errors["description"] || [])
                    ];
                }
            },
            deep: true
        }
    },
    components: { PagerComponent, PagerFormComponent }
};
</script>
