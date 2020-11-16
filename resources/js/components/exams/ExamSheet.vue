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
  mounted: async function () {
    if (this.session_exam_code) {
      await this.onProceedClick(this.session_exam_code);
    }
  },
  computed: {
    is_exam_code_empty() {
      return this.exam_code.length === 0;
    },
  },
  methods: {
    async onDoneClick(answers) {
      console.log("Done");
    },
    async onNextClick(answers) {
      try {
        const res = await axios.post("/api/exam/answerquestion", { answers });
        await this.getExamQuestions(this.pagination.next_page_url);
      } catch {
        alertify.error("Internal Server Error");
      }
    },
    async onBackClick() {
      await this.getExamQuestions(this.pagination.prev_page_url);
    },
    async onProceedClick(code) {
      try {
        const res = await axios.post("/api/exam/proceed", { code });
        this.exam_code = res.data.code;
        this.is_code_valid = true;
        this.examinee = res.data.examinee;
        this.remaining_questions = res.data.remaining_questions;
        this.created_at = res.data.created_at;
        await this.getExamQuestions("/api/exam/getquestion");
      } catch (err) {
        alertify.error("Exam Code does not exists");
      }
    },
    async getExamQuestions(url) {
      const code = this.exam_code;
      try {
        const res = await axios.post(url, { code });
        this.exam_questions = res.data.questions.data;
        this.remaining_questions = res.data.remaining_questions;
        this.pagination = res.data.questions;
      } catch (err) {
        alertify.error("Internal Error");
      }
    },
  },
};
</script>

<style></style>
