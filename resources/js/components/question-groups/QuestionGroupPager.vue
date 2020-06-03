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
                    <InputComponent
                        :label="'Description'"
                        :is_validation_enabled="is_form_dirty"
                        :error_messages="getErrorMessages('description')"
                        v-slot="{ classes }"
                    >
                        <input
                            type="text"
                            :class="classes"
                            v-model="form_model.description"
                        />
                    </InputComponent>
                </div>
            </PagerFormComponent>
        </div>
    </div>
</template>

<script>
import PagerComponent from "../shared/pager/PagerComponent.vue";
import PagerFormComponent from "../shared/pager/PagerFormComponent";
import InputComponent from "../shared/forms/InputComponent";
import PagerFormMixin from "../../mixins/PagerFormMixin";
import EditActionMixin from "../../mixins/EditActionMixin";
import PagerMixin from "../../mixins/PagerMixin";
import AddButtonMixin from "../../mixins/AddButtonMixin";
import DeleteActionMixin from "../../mixins/DeleteActionMixin";

export default {
    mixins: [
        PagerMixin,
        PagerFormMixin,
        EditActionMixin,
        DeleteActionMixin,
        AddButtonMixin
    ],
    data() {
        return {
            form_model: {
                description: ""
            },
            endpoint: "/questiongroups",
            headers: { description: "DESCRIPTION" },
            actions: [
                {
                    caption: "Tag Ranks",
                    class_name: "btn-secondary",
                    callback: row => {
                        this.onTagRankClick(row);
                    }
                },
                {
                    caption: "Tag Questions",
                    class_name: "btn-secondary",
                    callback: row => {
                        this.onTagQuestionClick(row);
                    }
                }
            ]
        };
    },
    methods: {
        onTagRankClick: function(row) {
            window.location.href = `${this.endpoint}/${row.id}/ranks`;
        },
        onTagQuestionClick: function(row) {
            window.location.href = `${this.endpoint}/${row.id}/questions`;
        },
        validateForm: function() {
            if (this.form_model["description"].length === 0) {
                this.errors["description"] = [
                    "This field is required",
                    ...(this.errors["description"] || [])
                ];
            }
        }
    },
    components: { PagerComponent, PagerFormComponent, InputComponent }
};
</script>
