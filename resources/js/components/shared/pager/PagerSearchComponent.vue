<template>
  <div>
    <div class="input-group mb-3">
      <span style="align-self: center">Search By: </span>
      <select class="form-control ml-2" v-model="field">
        <option
          v-for="(field, index) in fields"
          :key="index"
          :value="field.name"
        >
          {{ field.description }}
        </option>
      </select>
      <input type="text" class="form-control ml-1" v-model="searchText" />
      <div class="input-group-append">
        <span class="input-group-text">
          <button
            @click="onSearchClick"
            style="border: none; background-color: #e9ecef"
          >
            <i class="fas fa-search"></i>
          </button>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    fields: Array,
  },
  data: () => ({
    field: "",
    searchText: "",
  }),
  methods: {
    onSearchClick() {
      const { field, searchText } = this;
      this.$emit("search", field, searchText);
    },
  },
};
</script>

<style>
</style>