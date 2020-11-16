<template>
  <div>
    <div v-if="is_exam_code_empty || is_code_valid === false">
      <ConfirmationComponent @onProceedClick="onProceedClick" />
    </div>
    <div v-else>
      <ExamQuestionComponent
        :pagination="pagination"
        :exam_questions="exam_questions"
        :examinee="examinee"
        :remaining_questions="remaining_questions"
        :created_at="created_at"
        @done="onDoneClick"
        @next="onNextClick"
        @back="onBackClick"
      />
    </div>
  </div>
</template>

<script>
import ConfirmationComponent from "./Confirmation";
import ExamQuestionComponent from "./ExamQuestion";
import ResultComponent from "./Result";

export default {
  components: {
    ConfirmationComponent,
    ExamQuestionComponent,
    ResultComponent,
  },
  props: {
    session_exam_code: "",
  },
  data() {
    return {
      exam_code: "",
      exam_questions: [],
      examinee: {},
      remaining_questions: 0,
      created_at: "",
      is_done: false,
      pagination: {},
    };
  },
  mounted: function () {
    if (this.session_exam_code) {
      this.onProceedClick(this.session_exam_code);
    }
  },
  computed: {
    is_exam_code_empty() {
      return this.exam_code.length === 0;
    },
  },
  methods: {
    onDoneClick(answers) {
      console.log("Done");
    },
    onNextClick(answers) {
      axios
        .post("/api/exam/answerquestion", { answers })
        .then((res) => {
          this.getExamQuestions(this.pagination.next_page_url);
        })
        .catch((res) => {
          alertify.error("Internal Server Error");
        });
    },
    onBackClick() {
      this.getExamQuestions(this.pagination.prev_page_url);
    },
    onProceedClick(code) {
      axios
        .post("/api/exam/proceed", { code })
        .then((res) => {
          this.exam_code = res.data.code;
          this.is_code_valid = true;
          this.examinee = res.data.examinee;
          this.remaining_questions = res.data.remaining_questions;
          this.created_at = res.data.created_at;
          this.getExamQuestions("/api/exam/getquestion");
        })
        .catch((res) => alertify.error("Exam Code does not exists"));
    },
    getExamQuestions(url) {
      const code = this.exam_code;
      axios
        .post(url, { code })
        .then((res) => {
          this.exam_questions = res.data.questions.data;
          this.remaining_questions = res.data.remaining_questions;
          this.pagination = res.data.questions;
        })
        .catch((res) => {
          alertify.error("Internal Error");
        });
    },
  },
};
</script>

<style></style>
