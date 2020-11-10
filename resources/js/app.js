/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "rank-pager",
    require("./components/ranks/RankPager.vue").default
);

Vue.component(
    "question-pager",
    require("./components/questions/QuestionPager.vue").default
);

Vue.component(
    "question-group-pager",
    require("./components/question-groups/QuestionGroupPager.vue").default
);

Vue.component(
    "question-group-rank-pager",
    require("./components/question-groups/QuestionGroupRankPager.vue").default
);

Vue.component(
    "question-group-question-pager",
    require("./components/question-groups/QuestionGroupQuestionPager.vue")
        .default
);

Vue.component(
    "choice-pager",
    require("./components/choices/ChoicePager.vue").default
);

Vue.component(
    "user-pager",
    require("./components/users/UserPager.vue").default
);

Vue.component(
    "code-generator",
    require("./components/exams/CodeGenerator.vue").default
);

Vue.component(
    "exam-sheet",
    require("./components/exams/ExamSheet.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

Date.prototype.addHours = function(h) {
    this.setTime(this.getTime() + h * 60 * 60 * 1000);
    return this;
};
