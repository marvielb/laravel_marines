<template>
  <div class="container">
    <div class="row justify-content-end">
      <button class="btn btn-primary mb-3" @click="onAddClick()">Add</button>
      <PagerComponent
        :headers="headers"
        :actions="actions"
        :endpoint="api_endpoint"
      />
      <PagerFormComponent
        :show="form_visible"
        :title="'Rank Form'"
        :disabled_save="should_save_disabled"
        @saveClick="onSaveClick"
        @closeClick="onCloseClick"
      >
        <div class="form-group">
          <InputComponent
            :label="'Description'"
            :is_validation_enabled="is_form_dirty"
            :error_messages="getErrorMessages('description')"
            :model="form_model.description"
            v-slot="{ classes }"
          >
            <input
              type="text"
              :class="classes"
              v-model="form_model.description"
            />
          </InputComponent>
        </div>
      </PagerFormComponent>
    </div>
  </div>
</template>

<script>
import PagerComponent from "../shared/pager/PagerComponent.vue";
import PagerFormComponent from "../shared/pager/PagerFormComponent";
import InputComponent from "../shared/forms/InputComponent";
import PagerFormMixin from "../../mixins/PagerFormMixin";
import EditActionMixin from "../../mixins/EditActionMixin";
import PagerMixin from "../../mixins/PagerMixin";
import AddButtonMixin from "../../mixins/AddButtonMixin";
import DeleteActionMixin from "../../mixins/DeleteActionMixin";

export default {
  mixins: [
    PagerMixin,
    PagerFormMixin,
    EditActionMixin,
    DeleteActionMixin,
    AddButtonMixin,
  ],
  data() {
    return {
      form_model: {
        description: "",
      },
      endpoint: "/ranks",
      headers: { description: "DESCRIPTION" },
    };
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
  components: { PagerComponent, PagerFormComponent, InputComponent },
};
</script>
