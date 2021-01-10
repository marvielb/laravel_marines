<template>
  <nav aria-label="...">
    <ul class="pagination">
      <li :class="['page-item', is_prev_page_null ? 'disabled' : '']">
        <button
          class="page-link"
          @click="onPageSwitch(pagination_info.prev_page_url)"
        >
          Previous
        </button>
      </li>
      <li class="page-item" style="display: flex">
        <span style="margin-left: 10px; margin-right: 10px; align-self: center"
          >{{ pagination_info.from }} - {{ pagination_info.to }} of
          {{ pagination_info.total }}
        </span>
      </li>
      <li :class="['page-item', is_next_page_null ? 'disabled' : '']">
        <button
          class="page-link"
          @click="onPageSwitch(pagination_info.next_page_url)"
        >
          Next
        </button>
      </li>
    </ul>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters("pager", {
      pagination_info: "pagination_info",
    }),
    is_prev_page_null: function () {
      return this.pagination_info.prev_page_url == null;
    },
    is_next_page_null: function () {
      return this.pagination_info.next_page_url == null;
    },
  },
  methods: {
    async onPageSwitch(url) {
      await this.$store.dispatch("pager/setEndPoint", url);
    },
  },
};
</script>
