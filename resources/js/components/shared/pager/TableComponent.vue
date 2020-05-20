<template>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th
                    v-for="(headerKey, index) in Object.keys(headers)"
                    :key="index"
                >
                    {{ headers[headerKey] }}
                </th>
                <th v-if="isActionsEmpty == false">
                    ACTIONS
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(content, index) in contents" :key="index">
                <td
                    v-for="(headerkey, index) in Object.keys(headers)"
                    :key="index"
                >
                    {{ content[headerkey] }}
                </td>
                <td class="action" v-if="isActionsEmpty == false">
                    <button
                        v-for="(action, index) in actions"
                        :key="index"
                        v-on:click="action.callback(content)"
                        v-bind:class="['btn', action.className]"
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
        isActionsEmpty: function () {
            return this.actions.length === 0;
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
