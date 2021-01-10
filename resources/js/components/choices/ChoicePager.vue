<template>
  <div class="container">
    <div class="row justify-content-end">
      <div class="container">
        <div class="row justify-content-between">
          <div class="column" style="align-self: center">
            <span>Correct Answer: {{ corect_answer }}</span>
          </div>
          <div class="column">
            <button class="btn btn-primary mb-3" @click="onAddClick()">
              Add
            </button>
          </div>
        </div>
      </div>

      <PagerComponent
        :headers="headers"
        :actions="actions"
        :endpoint="api_endpoint"
      />
      <PagerFormComponent
        :show="form_visible"
        :title="'Choice Form'"
        :disabled_save="should_save_disabled"
        @saveClick="onSaveClick"
        @closeClick="onCloseClick"
      >
        <div class="form-group">
          <InputComponent
            :label="'Body'"
            :is_validation_enabled="is_form_dirty"
            :error_messages="getErrorMessages('body')"
            v-slot="{ classes }"
          >
            <textarea :class="classes" v-model="form_model.body" />
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
  props: {
    questionId: String,
  },
  data() {
    return {
      corect_answer: "",
      form_model: {
        body: "",
      },
      headers: { body: "CHOICES" },
      actions: [
        {
          caption: "Set as Correct",
          class_name: "btn-success",
          callback: (row) => {
            this.onSetAsCorrectClick(row);
          },
        },
      ],
    };
  },
  computed: {
    endpoint: function () {
      return `/questions/${this.questionId}/choices`;
    },
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
    onSetAsCorrectClick: function (row) {
      alertify.confirm(
        `Are you sure you want to set "${row.body}" as the correct answer?`,
        () => {
          axios
            .patch(
              `/api/questions/${this.questionId}/choices/${row.id}/correct`
            )
            .then(() => {
              this.getCorrectAnswer();
            })
            .catch((res) => {
              alertify.error(res.response.data.message);
            });
        }
      );
    },
    getCorrectAnswer: function () {
      axios
        .get(`/api/questions/${this.questionId}/answer`)
        .then((res) => {
          this.corect_answer = res.data.body;
        })
        .catch((res) => {
          alertify.error(res.response.data.message);
        });
    },
  },
  created: function () {
    this.getCorrectAnswer();
  },
  components: { PagerComponent, PagerFormComponent, InputComponent },
};
</script>
