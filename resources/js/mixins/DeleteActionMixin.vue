<script>
export default {
    created: function() {
        if (!this.actions) return;
        this.actions = [
            ...(this.actions || []),
            {
                caption: "Delete",
                class_name: "btn-marines-delete",
                callback: row => {
                    this.onDeleteClick(row);
                }
            }
        ];
    },
    methods: {
        onDeleteClick: function(row) {
            alertify.confirm(
                "Are you sure you want to delete this entry?",
                () => {
                    axios.delete(`${this.endpoint}/${row.id}`).then(() => {
                        this.reloadPager();
                    });
                }
            );
        }
    }
};
</script>
