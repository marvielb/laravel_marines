<template>
    <div>
        <div v-if="is_done">
            <ResultComponent />
        </div>
        <div v-else-if="is_exam_code_empty || is_code_valid === false">
            <ConfirmationComponent @onProceedClick="onProceedClick" />
        </div>
        <div v-else>
            <ExamQuestionComponent
                :exam_questions="exam_questions"
                :examinee="examinee"
                :remaining_questions="remaining_questions"
                :created_at="created_at"
                @done="is_done = true"
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
        ResultComponent
    },
    data() {
        return {
            exam_code: "",
            is_code_valid: false,
            exam_questions: [],
            examinee: {},
            remaining_questions: 0,
            created_at: "",
            is_done: false
        };
    },
    computed: {
        is_exam_code_empty() {
            return this.exam_code.length === 0;
        }
    },
    methods: {
        onProceedClick(code) {
            axios
                .post("/api/exam/proceed", { code })
                .then(res => {
                    this.exam_code = res.data.code;
                    this.is_code_valid = true;
                    this.exam_questions = res.data.exam_questions;
                    this.examinee = res.data.examinee;
                    this.remaining_questions = res.data.remaining_questions;
                    this.created_at = res.data.created_at;
                })
                .catch(res => alertify.error("Exam Code does not exists"));
        }
    }
};
</script>

<style></style>
