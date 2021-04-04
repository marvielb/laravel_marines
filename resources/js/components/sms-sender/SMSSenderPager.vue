<template>
  <div class="container">
    <div class="row justify-content-end">
      <PagerComponent
        :headers="headers"
        :actions="actions"
        :endpoint="api_endpoint"
      />
    </div>
  </div>
</template>

<script>
import PagerComponent from "../shared/pager/PagerComponent.vue";
import PagerMixin from "../../mixins/PagerMixin";

export default {
  mixins: [PagerMixin],
  data() {
    return {
      form_model: {
        description: "",
      },
      endpoint: "/smssender",
      headers: {
        firstName: "First Name",
        middleName: "Middle Name",
        lastName: "Last Name",
        mobileNumber: "Mobile Number",
      },
    };
  },
  computed: {
    searchFields: function () {
      return Object.keys(this.headers).map((v) => ({
        name: v,
        description: this.headers[v],
      }));
    },
  },
  methods: {
    validateForm: function () {
      if (this.form_model["description"].length === 0) {
        this.errors["description"] = [
          "This field is required",
          ...(this.errors["description"] || []),
        ];
      }
    },
  },
  components: {
    PagerComponent,
  },
};
</script>
