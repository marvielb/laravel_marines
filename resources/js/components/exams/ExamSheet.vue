<template>
    <div>
        <div v-if="is_exam_code_empty || is_code_valid === false">
            <ConfirmationComponent @onProceedClick="onProceedClick" />
        </div>
        <div v-else>
            <ExamQuestionComponent :exam_questions="exam_questions" />
        </div>
        <!-- <ResultComponent /> -->
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
            exam_questions: []
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
                })
                .catch(res => alertify.error("Exam Code does not exists"));
        }
    }
};
</script>

<style></style>
