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
                :title="'User Form'"
                :disabled_save="is_form_valid === false"
                @saveClick="onSaveClick"
                @closeClick="onCloseClick"
            >
                <div class="form-group">
                    <div class="row mb-3">
                        <div class="col">
                            <img
                                src="https://image.flaticon.com/icons/svg/892/892781.svg"
                                class="rounded mx-auto d-block"
                                alt="Responsive image"
                                style="max-width: 100px;"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Marine Number'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="
                                    getErrorMessages('marine_number')
                                "
                                :model="form_model.marine_number"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.marine_number"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'First Name'"
                                :is_validation_enabled="is_form_dirty"
                                :model="form_model.first_name"
                                :error_messages="getErrorMessages('first_name')"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.first_name"
                                />
                            </InputComponent>
                        </div>
                        <div class="col">
                            <InputComponent
                                :label="'Middle Name'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="
                                    getErrorMessages('middle_name')
                                "
                                :model="form_model.middle_name"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.middle_name"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Last Name'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('last_name')"
                                :model="form_model.last_name"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.last_name"
                                />
                            </InputComponent>
                        </div>
                        <div class="col">
                            <InputComponent
                                :label="'Suffix'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('suffix')"
                                :model="form_model.suffix"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.suffix"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Birth Place'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="
                                    getErrorMessages('birth_place')
                                "
                                :model="form_model.birth_place"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.birth_place"
                                />
                            </InputComponent>
                        </div>
                        <div class="col">
                            <InputComponent
                                :label="'Nationality'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="
                                    getErrorMessages('nationality')
                                "
                                :model="form_model.nationality"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.nationality"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Date of Birth'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('birthday')"
                                :model="form_model.birthday"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="date"
                                    :class="classes"
                                    v-model="form_model.birthday"
                                />
                            </InputComponent>
                        </div>
                        <div class="col">
                            <InputComponent
                                :label="'Age'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('age')"
                                :model="form_model.age"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    readonly
                                    :class="classes"
                                    v-model="age"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Highest Career Course'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="
                                    getErrorMessages('highest_career_course')
                                "
                                :model="form_model.highest_career_course"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.highest_career_course"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Address (Provincial)'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('address')"
                                :model="form_model.address"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.address"
                                />
                            </InputComponent>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <InputComponent
                                :label="'Gender'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('gender')"
                                :model="form_model.gender"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="text"
                                    :class="classes"
                                    v-model="form_model.gender"
                                />
                            </InputComponent>
                        </div>
                        <div class="col">
                            <InputComponent
                                :label="'Date of Last Promotion'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="
                                    getErrorMessages('last_promotion')
                                "
                                :model="form_model.last_promotion"
                                v-slot="{ classes }"
                            >
                                <input
                                    type="date"
                                    :class="classes"
                                    v-model="form_model.last_promotion"
                                />
                            </InputComponent>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <InputComponent
                                :label="'Rank'"
                                :is_validation_enabled="is_form_dirty"
                                :error_messages="getErrorMessages('rank_id')"
                            >
                                <select
                                    class="custom-select"
                                    v-model="form_model.rank_id"
                                >
                                    <option
                                        v-for="rank in all_ranks"
                                        :key="rank.id"
                                        :value="rank.id"
                                        >{{ rank.description }}</option
                                    >
                                </select>
                            </InputComponent>
                        </div>
                    </div>
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
                rank_id: "",
                marine_number: "",
                last_name: "",
                middle_name: "",
                first_name: "",
                suffix: "",
                birth_place: "",
                nationality: "",
                birthday: "",
                age: "",
                highest_career_course: "",
                address: "",
                gender: "",
                last_promotion: ""
            },
            endpoint: "/users",
            headers: {
                marine_number: "Marine Number",
                last_name: "Last Name",
                first_name: "First Name",
                middle_name: "Middle Name",
                rank: "Rank"
            },
            all_ranks: []
        };
    },
    computed: {
        age: function() {
            return this.form_model.birthday.length === 0
                ? ""
                : new Date(
                      new Date() - new Date(this.form_model.birthday)
                  ).getFullYear() - 1970;
        }
    },
    methods: {
        validateForm: function() {
            if (this.form_model["marine_number"].length === 0) {
                this.errors["marine_number"] = [
                    "This field is required",
                    ...(this.errors["marine_number"] || [])
                ];
            }

            if (this.form_model["first_name"].length === 0) {
                this.errors["first_name"] = [
                    "This field is required",
                    ...(this.errors["first_name"] || [])
                ];
            }

            if (this.form_model["last_name"].length === 0) {
                this.errors["last_name"] = [
                    "This field is required",
                    ...(this.errors["last_name"] || [])
                ];
            }

            if (this.form_model["rank_id"].length === 0) {
                this.errors["rank_id"] = [
                    "This field is required",
                    ...(this.errors["rank_id"] || [])
                ];
            }
        },
        getAllRanks: function() {
            axios
                .get(`/api/ranks/all`)
                .then(res => {
                    this.all_ranks = res.data;
                })
                .catch(res => {
                    alertify.error(res.response.data.message);
                });
        }
    },
    mounted: function() {
        this.getAllRanks();
    },
    components: { PagerComponent, PagerFormComponent, InputComponent }
};
</script>
