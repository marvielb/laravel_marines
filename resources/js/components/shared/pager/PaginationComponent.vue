<template>
    <nav aria-label="...">
        <ul class="pagination">
            <li :class="['page-item', isPrevPageNull ? 'disabled' : '']">
                <button
                    class="page-link"
                    @click="
                        $emit('onPageSwitch', pagination_info.prev_page_url)
                    "
                >
                    Previous
                </button>
            </li>
            <li class="page-item" style="display:flex;">
                <span
                    style="margin-left: 10px;margin-right:10px; align-self:center;"
                    >{{ pagination_info.from }} - {{ pagination_info.to }} of
                    {{ pagination_info.total }}</span
                >
            </li>
            <li :class="['page-item', isNextPageNull ? 'disabled' : '']">
                <button
                    class="page-link"
                    @click="
                        $emit('onPageSwitch', pagination_info.next_page_url)
                    "
                >
                    Next
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    computed: {
        isPrevPageNull: function() {
            return this.pagination_info.prev_page_url == null;
        },
        isNextPageNull: function() {
            return this.pagination_info.next_page_url == null;
        }
    },
    props: {
        pagination_info: {
            prev_page_url: String,
            next_page_url: String,
            from: Number,
            to: Number,
            total: Number
        }
    }
};
</script>
