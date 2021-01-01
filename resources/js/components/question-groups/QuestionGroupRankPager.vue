<template>
  <div class="container">
    <div class="row justify-content-end">
      <button class="btn btn-primary mb-3" @click="onAddGroupRankClick()">
        Add
      </button>
      <PagerComponent
        :headers="headers"
        :actions="actions"
        :endpoint="api_endpoint"
        :bus="child_bus"
      />
      <PagerFormComponent
        :show="form_visible"
        :title="'Add New Rank'"
        :disabled_save="should_save_disabled"
        @saveClick="onSaveClick"
        @closeClick="onCloseClick"
      >
        <div class="form-group">
          <InputComponent
            :label="'Rank'"
            :is_validation_enabled="is_form_dirty"
            :error_messages="getErrorMessages('rank_id')"
          >
            <select class="custom-select" v-model="form_model.rank_id">
              <option
                v-for="rank in available_ranks"
                :key="rank.id"
                :value="rank.id"
              >
                {{ rank.description }}
              </option>
            </select>
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
  mixins: [PagerMixin, PagerFormMixin, DeleteActionMixin, AddButtonMixin],
  props: ["questionGroupId"],
  data() {
    return {
      form_model: {
        rank_id: "",
      },
      headers: { description: "DESCRIPTION" },
      available_ranks: [],
    };
  },
  computed: {
    endpoint: function () {
      return `/questiongroups/${this.questionGroupId}/ranks`;
    },
  },
  methods: {
    onAddGroupRankClick: function () {
      this.getAvailableRanks();
      this.onAddClick();
    },
    getAvailableRanks: function () {
      axios
        .get(`${this.endpoint}/create`)
        .then((res) => {
          this.available_ranks = res.data;
        })
        .catch((res) => {
          alertify.error(res.response.data.message);
        });
    },
  },
  components: { PagerComponent, PagerFormComponent, InputComponent },
};
</script>
