<script>
export default {
  data: function () {
    return {
      actions: [],
    };
  },
  methods: {
    reloadPager: function () {
      this.$store.dispatch("pager/setEndPoint", this.api_endpoint);
      this.clearForm();
      this.hideForm();
    },
  },
  computed: {
    api_endpoint: function () {
      return "/api" + this.endpoint;
    },
  },
};
</script>
