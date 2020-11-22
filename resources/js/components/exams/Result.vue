<template>
  <div>
    <!-- Examinee -->
    <div class="row mb-3">
      <div class="col-2 mr-4">
        <img
          src="https://image.flaticon.com/icons/svg/892/892781.svg"
          class="rounded mx-auto d-block"
          alt="Responsive image"
        />
      </div>
      <div class="col-9">
        <div class="row">Name: Manuel, Arni Nickard A.</div>
        <div class="row">Serial No: 123</div>
        <div class="row">Rank: None</div>
        <div class="row">Class: 2020</div>
        <div class="row">Examination Code: 123456789</div>
      </div>
    </div>
    <!-- Results -->
    <div class="row mb-1">
      <div class="col">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>Results</td>
              <td>%</td>
              <td>Total Items</td>
              <td>Correct</td>
              <td>Wrong</td>
              <td>Average</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Mathematics</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>History</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>Science and Technology</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>Communication Arts</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>Total</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Other Details -->
    <div class="row">
      <div class="col">
        <table class="table table-bordered table-striped">
          <thead style="text-align: center">
            <tr>
              <td colspan="2">Other Details</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Total Items</td>
              <td>{{ total_items }}</td>
            </tr>
            <tr>
              <td>Remaining Time</td>
              <td>{{ remaining_time }}</td>
            </tr>
            <tr>
              <td>Time Consumed</td>
              <td>{{ time_consumed }}</td>
            </tr>
            <tr>
              <td>Date of Examination</td>
              <td>{{ date_of_examination }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <div class="row">
          <div class="col">Total Score: {{ correct_answers }}</div>
          <div class="col">Total Average: 0%</div>
          <div class="col">Grade: Failed</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import addHours from "date-fns/addHours";
import formatDistanceStrict from "date-fns/formatDistanceStrict";
import differenceInMinutes from "date-fns/differenceInMinutes";
import differenceInHours from "date-fns/differenceInHours";
import format from "date-fns/format";

export default {
  props: {
    code: "",
  },
  data() {
    return {
      total_items: 0,
      correct_answers: 0,
      exam: {},
    };
  },
  computed: {
    remaining_time() {
      try {
        const end = addHours(new Date(this.exam.started_at), 2);
        const minutes = Math.abs(
          differenceInMinutes(end, new Date(this.exam.finished_at))
        );
        const hours = Math.abs(
          differenceInHours(end, new Date(this.exam.finished_at))
        );
        return `${hours} hour(s) ${minutes % 60} minute(s)`;
      } catch {
        return "";
      }
    },
    time_consumed() {
      try {
        return formatDistanceStrict(
          new Date(this.exam.started_at),
          new Date(this.exam.finished_at),
          { roundingMethod: "floor" }
        );
      } catch {
        return "";
      }
    },
    date_of_examination() {
      try {
        return format(new Date(this.exam.started_at), "MM/dd/yyyy");
      } catch {
        return "";
      }
    },
  },
  mounted: async function () {
    try {
      const code = this.code;
      const res = await axios.post("/api/exam/results", { code });
      this.total_items = res.data.total_items;
      this.correct_answers = res.data.correct_answers;
      this.exam = res.data.exam;
      console.log(this.exam);
    } catch {
      alertify.error("Results: Internal Server Error(1)");
    }
  },
  methods: {},
};
</script>

<style></style>
