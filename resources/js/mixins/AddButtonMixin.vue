<script>
export default {
    methods: {
        onAddClick: function(row) {
            this.is_form_dirty = false;
            this.is_edit = false;
            this.showForm();
        }
    }
};
</script>
