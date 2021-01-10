<script>
export default {
  data: function () {
    return {
      form_model: {},
      is_form_dirty: false,
      is_edit: false,
      edit_id: 0,
      errors: {},
      form_visible: false,
    };
  },
  methods: {
    validateForm: function () {},
    showForm: function () {
      this.form_visible = true;
    },
    hideForm: function () {
      this.form_visible = false;
    },
    clearForm: function () {
      this.is_form_dirty = false;
      Object.keys(this.form_model).forEach((v) => {
        this.form_model[v] = "";
      });
    },
    getErrorMessages: function (name) {
      return this.errors[name];
    },
    onSaveClick: async function () {
      let saveOperation = () => {};
      if (this.is_edit) {
        saveOperation = axios.patch(
          this.endpoint + "/" + this.edit_id,
          this.form_model
        );
      } else {
        saveOperation = axios.post(this.endpoint, this.form_model);
      }
      saveOperation
        .then(() => {
          this.reloadPager();
          alertify.success("Successfully Saved!", 3);
        })
        .catch((result) => {
          console.log(result);
          if (result.response.data.errors) {
            this.errors = result.response.data.errors;
          } else {
            alertify.error(result.response.data.message);
          }
        });
    },
    onCloseClick: function () {
      this.clearForm();
      this.hideForm();
    },
  },
  computed: {
    is_form_valid: function () {
      return Object.keys(this.errors).length === 0;
    },
    should_save_disabled: function () {
      return this.is_form_valid === false || this.is_form_dirty == false;
    },
  },
  watch: {
    form_model: {
      handler: function (val, oldVal) {
        this.is_form_dirty = true;
        this.errors = {};
        this.validateForm();
      },
      deep: true,
    },
  },
};
</script>
