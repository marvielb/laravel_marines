<template>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Remaining Questions:
          {{ current_remaining_questions }}
        </div>
        <div class="col">
          Remaining Time: {{ remaining_time.hours }} hours
          {{ remaining_time.minutes }} minutes
          {{ remaining_time.seconds }} seconds
        </div>
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
            Name: {{ examinee.last_name }}, {{ examinee.first_name }}
            {{ examinee.middle_name }}.
          </div>
          <div class="row">Serial No: {{ examinee.marine_number }}</div>
          <div class="row">Rank: {{ examinee.rank.description }}</div>
          <div class="row">Class: 2020</div>
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
            {{ (pagination.current_page - 1) * pagination.per_page + i + 1 }}.
            {{ exam_question.question.body }}
          </div>
          <dir class="row">
            <div
              class="form-check col"
              v-for="(choice, j) in exam_question.question.choices"
              :key="j"
            >
              <input
                class="form-check-input"
                type="radio"
                :name="`answer[${exam_question.id}]`"
                v-model="exam_question.answer_id"
                v-bind:value="choice.id"
              />
              <label class="form-check-label">
                {{ choice.body }}
              </label>
            </div>
          </dir>
        </div>
      </div>

      <div class="row">
        <div
          class="col align-self-end"
          style="display: flex; justify-content: space-between"
        >
          <button
            class="btn btn-primary"
            :disabled="!pagination.prev_page_url"
            @click="onBackClick"
          >
            Back
          </button>

          <button class="btn btn-primary" @click="onNextClick">
            {{ pagination.next_page_url ? "Next" : "Finish" }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { formatDate } from "@fullcalendar/core";
export default {
  data() {
    return {
      answered_questions: {},
      remaining_time: {},
    };
  },
  props: {
    remaining_questions: Number,
    exam_questions: Array,
    examinee: Object,
    created_at: String,
    pagination: Object,
  },
  computed: {
    current_remaining_questions: function () {
      return this.remaining_questions;
    },
  },
  methods: {
    getTimeRemaining(endtime) {
      const total = Date.parse(endtime) - Date.parse(new Date());
      const seconds = Math.floor((total / 1000) % 60);
      const minutes = Math.floor((total / 1000 / 60) % 60);
      const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
      const days = Math.floor(total / (1000 * 60 * 60 * 24));

      return {
        total,
        days,
        hours,
        minutes,
        seconds,
      };
    },
    onNextClick() {
      this.$emit(
        this.pagination.next_page_url ? "next" : "done",
        this.exam_questions.filter((v) => v.answer_id)
      );
    },
    onBackClick() {
      this.$emit("back");
    },
  },
  created: function () {
    const self = this;
    setInterval(() => {
      self.remaining_time = self.getTimeRemaining(
        new Date(self.created_at).addHours(2)
      );
    }, 500);
  },
};
</script>

<style></style>
