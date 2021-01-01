<template>
  <div class="container">
    <div class="row justify-content-end">
      <button class="btn btn-primary mb-3" @click="onAddGroupQuestionClick()">
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
        :title="'Tag New Question'"
        :disabled_save="should_save_disabled"
        @saveClick="onSaveClick"
        @closeClick="onCloseClick"
      >
        <div class="form-group">
          <InputComponent
            :label="'Question'"
            :is_validation_enabled="is_form_dirty"
            :error_messages="getErrorMessages('question_id')"
          >
            <select class="custom-select" v-model="form_model.question_id">
              <option
                v-for="question in available_questions"
                :key="question.id"
                :value="question.id"
              >
                {{ question.body }}
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
  mixins: [PagerMixin, PagerFormMixin, DeleteActionMixin, AddButtonMixin],
  props: ["questionGroupId"],
  data() {
    return {
      form_model: {
        question_id: "",
      },
      headers: { body: "Question" },
      available_questions: [],
    };
  },
  computed: {
    endpoint: function () {
      return `/questiongroups/${this.questionGroupId}/questions`;
    },
  },
  methods: {
    onAddGroupQuestionClick: function () {
      this.getAvailableQuestions();
      this.onAddClick();
    },
    getAvailableQuestions: function () {
      axios
        .get(`${this.endpoint}/create`)
        .then((res) => {
          this.available_questions = res.data;
        })
        .catch((res) => {
          alertify.error(res.response.data.message);
        });
    },
  },
  components: { PagerComponent, PagerFormComponent, InputComponent },
};
</script>
