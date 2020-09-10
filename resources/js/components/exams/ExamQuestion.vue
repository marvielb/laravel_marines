<template>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">Remaining Questions: 4</div>
                <div class="col">Remaining Time: 00:00:00</div>
            </div>
        </div>
        <div class="card-body">
            <!-- Examinee -->
            <div class="row mb-5">
                <div class="col-2 mr-4">
                    <img
                        src="https://image.flaticon.com/icons/svg/892/892781.svg"
                        class="rounded mx-auto d-block"
                        alt="Responsive image"
                    />
                </div>
                <div class="col-9">
                    <div class="row">
                        Name: Manuel, Arni Nickard A.
                    </div>
                    <div class="row">
                        Serial No: 123
                    </div>
                    <div class="row">
                        Rank: None
                    </div>
                    <div class="row">
                        Class: 2020
                    </div>
                </div>
            </div>

            <!-- QUESTIONS -->
            <div
                class="row mt-2"
                v-for="(exam_question, i) in exam_questions"
                :key="exam_question.id"
            >
                <div class="col">
                    <div class="row">
                        {{ i + 1 }}. {{ exam_question.question.body }}
                    </div>
                    <dir class="row">
                        <div
                            class="form-check col"
                            v-for="(choice, j) in exam_question.question
                                .choices"
                            :key="j"
                        >
                            <input
                                class="form-check-input"
                                type="radio"
                                :name="`answer[${exam_question.id}]`"
                                :value="j"
                            />
                            <label class="form-check-label">
                                {{ choice.body }}
                            </label>
                        </div>
                    </dir>
                </div>
            </div>

            <!-- DONE -->
            <div class="row">
                <div
                    class="col align-self-end"
                    style="display: flex; justify-content: flex-end;"
                >
                    <button class="btn btn-primary">DONE</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        exam_questions: Array
    }
    // data() {
    //     return {
    //         questions: [
    //             {
    //                 body: "What is biology?",
    //                 choices: [
    //                     "Study of Life",
    //                     "Study of animals",
    //                     "Secret",
    //                     "None"
    //                 ]
    //             },
    //             {
    //                 body: "Who is the first president of th Philippines?",
    //                 choices: [
    //                     "Jose P. Laurel",
    //                     "Pepito Manaloto",
    //                     "Gloria Macapagal Arroyo",
    //                     "Emilio Aguinaldo"
    //                 ]
    //             },
    //             {
    //                 body: "When did Dr. Jose Rizal Died?",
    //                 choices: [
    //                     "December 3, 2006",
    //                     "December 1, 1896",
    //                     "November 30, 1896",
    //                     "December 30, 1896"
    //                 ]
    //             },
    //             {
    //                 body: "When was Martial law declared?",
    //                 choices: [
    //                     "September 21, 1973",
    //                     "September 21, 1972",
    //                     "September 21, 1971",
    //                     "September 22, 1972"
    //                 ]
    //             }
    //         ]
    //     };
    // }
};
</script>

<style></style>
