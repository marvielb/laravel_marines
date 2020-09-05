<script>
export default {
    created: function() {
        if (!this.actions) return;
        this.actions = [
            ...(this.actions || []),
            {
                caption: "Edit",
                class_name: "btn-marines-edit",
                callback: row => {
                    this.onEditClick(row);
                }
            }
        ];
    },
    methods: {
        onEditClick: function(row) {
            axios.get(`${this.api_endpoint}/${row.id}`).then(result => {
                this.is_edit = true;
                this.edit_id = row.id;
                this.form_model = result.data;
                this.is_form_dirty = true;
                this.showForm();
            });
        }
    }
};
</script>
