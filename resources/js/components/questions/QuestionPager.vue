<template>
  <div class="container">
    <div class="row justify-content-end">
      <button class="btn btn-primary mb-3" @click="onAddClick()">Add</button>
      <PagerComponent
        :headers="headers"
        :actions="actions"
        :endpoint="api_endpoint"
        :bus="child_bus"
      />
      <PagerFormComponent
        :show="form_visible"
        :title="'Question Form'"
        :disabled_save="is_form_valid === false"
        @saveClick="onSaveClick"
        @closeClick="onCloseClick"
      >
        <div class="form-group">
          <InputComponent
            :label="'Question'"
            :is_validation_enabled="is_form_dirty"
            :error_messages="getErrorMessages('body')"
            v-slot="{ classes }"
          >
            <textarea :class="classes" v-model="form_model.body" />
          </InputComponent>
        </div>
        <div class="form-group">
          <InputComponent
            :label="'Classification'"
            :is_validation_enabled="is_form_dirty"
            :error_messages="getErrorMessages('body')"
            v-slot="{ classes }"
          >
            <select
              :class="['custom-select', classes]"
              v-model="form_model.classification_id"
            >
              <option
                v-for="classification in question_classifications"
                :key="classification.id"
                :value="classification.id"
              >
                {{ classification.description }}
              </option>
            </select>
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
    AddButtonMixin,
  ],
  data() {
    return {
      question_classifications: [],
      form_model: {
        body: "",
        classification_id: 0,
      },
      endpoint: "/questions",
      headers: { body: "QUESTION" },
      actions: [
        {
          caption: "Choices",
          class_name: "btn-marines-primary",
          callback: (row) => {
            window.location.href = `${this.endpoint}/${row.id}/choices`;
          },
        },
      ],
    };
  },
  mounted: async function () {
    await this.getQuestionClassifications();
  },
  methods: {
    validateForm: function () {
      if (this.form_model["body"].length === 0) {
        this.errors["body"] = [
          "This field is required",
          ...(this.errors["body"] || []),
        ];
      }
    },
    getQuestionClassifications: async function () {
      try {
        const res = await axios.get(`${this.endpoint}/create`);
        this.question_classifications = res.data;
      } catch (response) {
        alertify.error(response.data.message);
      }
    },
  },
  components: { PagerComponent, PagerFormComponent, InputComponent },
};
</script>
