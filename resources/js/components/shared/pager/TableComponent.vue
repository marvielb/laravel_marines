<template>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th v-for="(headerKey, index) in Object.keys(headers)" :key="index">
          {{ headers[headerKey] }}
        </th>
        <th v-if="is_actions_empty == false">ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(content, index) in contents" :key="index">
        <td v-for="(headerkey, index) in Object.keys(headers)" :key="index">
          <div
            v-if="isImage(content[headerkey])"
            style="width: 100%; display: flex; justify-content: center"
          >
            <img
              :src="content[headerkey]"
              style="width: 100%; max-width: 300px"
            />
          </div>
          <span v-else>{{ content[headerkey] }}</span>
        </td>
        <td class="action" v-if="is_actions_empty == false">
          <button
            v-for="(action, index) in actions"
            :key="index"
            v-on:click="action.callback(content)"
            v-bind:class="['btn', action.class_name]"
          >
            {{ action.caption }}
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    headers: Object,
    contents: Array,
    actions: Array,
  },
  computed: {
    is_actions_empty: function () {
      return this.actions.length === 0;
    },
  },
  methods: {
    isImage: function (text) {
      return text.startsWith("data:image");
    },
  },
};
</script>

<style scoped>
thead tr {
  text-align: center;
}

.action {
  width: 1%;
  white-space: nowrap;
}
.action button:not(:first-child) {
  margin-left: 5px;
}
</style>
