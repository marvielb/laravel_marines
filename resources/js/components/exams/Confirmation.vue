<template>
    <div class="card">
        <div class="card-header">
            Confirmation
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="marines_number">Examination Code</label>
                <input
                    type="text"
                    class="form-control"
                    id="marines_number"
                    style="text-align: center;"
                    v-model="code"
                />
            </div>
            <div class="row">
                <button
                    type="button"
                    class="btn btn-primary mx-auto"
                    @click="onProceedClick"
                >
                    Proceed
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            code: ""
        };
    },
    methods: {
        onProceedClick() {
            this.$emit("onProceedClick", this.code);
        }
    }
};
</script>

<style></style>
