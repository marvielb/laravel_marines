<script>
export default {
    data: function() {
        return {
            child_bus: new Vue(),
            actions: []
        };
    },
    methods: {
        reloadPager: function() {
            this.child_bus.$emit("reload");
            this.clearForm();
            this.hideForm();
        }
    },
    computed: {
        api_endpoint: function() {
            return "/api" + this.endpoint;
        }
    }
};
</script>
