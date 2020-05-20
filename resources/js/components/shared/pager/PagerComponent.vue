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
                <PaginationComponent
                    :pagination_info="pagination_info"
                    @onPageSwitch="onPageSwitch"
                />
            </div>
        </div>
    </div>
</template>

<script>
import TableComponent from "./TableComponent.vue";
import PaginationComponent from "./PaginationComponent";

export default {
    props: {
        headers: Object,
        endpoint: String,
        actions: Array,
        bus: Vue
    },
    computed: {
        contents: function() {
            return this.endpoint_response.data;
        },
        pagination_info: function() {
            return {
                prev_page_url: this.endpoint_response.prev_page_url,
                next_page_url: this.endpoint_response.next_page_url,
                from: this.endpoint_response.from,
                to: this.endpoint_response.to,
                total: this.endpoint_response.total
            };
        }
    },
    data() {
        return {
            endpoint_response: Object
        };
    },
    methods: {
        load: function(url) {
            axios.get(url).then(res => {
                this.endpoint_response = res.data;
            });
        },
        reload: function() {
            this.load(this.endpoint);
        },
        onPageSwitch: function(url) {
            this.load(url);
        }
    },
    created: function() {
        this.load(this.endpoint);
    },
    mounted: function() {
        if (this.bus) {
            this.bus.$on("reload", this.reload);
        }
    },
    components: {
        TableComponent,
        PaginationComponent
    }
};
</script>

<style scoped>
.pagination-container {
    width: 100%;
    display: flex;
    justify-content: flex-end;
}
</style>
