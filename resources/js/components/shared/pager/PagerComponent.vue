<template>
  <div class="container">
    <div class="row">
      <TableComponent
        :headers="headers"
        :contents="contents"
        :actions="actions"
      />
    </div>
    <div class="row">
      <div class="pagination-container">
        <PaginationComponent />
      </div>
    </div>
  </div>
</template>

<script>
import TableComponent from "./TableComponent.vue";
import PaginationComponent from "./PaginationComponent";
import { mapGetters } from "vuex";

export default {
  props: {
    headers: Object,
    endpoint: String,
    actions: Array,
  },
  computed: {
    ...mapGetters("pager", {
      contents: "contents",
    }),
  },
  mounted: function () {
    this.$store.dispatch("pager/setEndPoint", this.endpoint);
  },
  components: {
    TableComponent,
    PaginationComponent,
  },
};
</script>

<style scoped>
.pagination-container {
  width: 100%;
  display: flex;
  justify-content: flex-end;
}
</style>
