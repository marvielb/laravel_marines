<script>
export default {
    created: function() {
        if (!this.actions) return;
        this.actions = [
            ...(this.actions || []),
            {
                caption: "Delete",
                class_name: "btn-danger",
                callback: row => {
                    this.onDeleteClick(row);
                }
            }
        ];
    },
    methods: {
        onDeleteClick: function(row) {
            axios.delete(`${this.endpoint}/${row.id}`).then(() => {
                this.reloadPager();
            });
        }
    }
};
</script>
