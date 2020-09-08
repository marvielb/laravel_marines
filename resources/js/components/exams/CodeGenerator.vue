<template>
    <div class="card">
        <div class="card-header">
            Code Generator
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="marines_number">Marine's Serial No.</label>
                <input
                    type="text"
                    class="form-control"
                    id="marines_number"
                    v-model="form.marine_number"
                />
            </div>
            <div class="form-group">
                <label for="marines_number">Examination Code</label>
                <input
                    type="text"
                    readonly
                    class="form-control"
                    id="marines_number"
                    v-model="form.code"
                />
            </div>
            <div class="row">
                <button
                    type="button"
                    class="btn btn-primary mx-auto"
                    @click="onGenerateClick"
                >
                    Generate
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                marine_number: "",
                code: ""
            }
        };
    },
    methods: {
        onGenerateClick() {
            console.log(this.form);
            axios
                .post("/api/codegenerator", this.form)
                .then(res => {
                    this.form.code = res.data.code;
                    alertify.success("Successfully generated exam code");
                })
                .catch(res => {
                    alertify.error("Marine's Serial No. does not exists");
                });
        }
    }
};
</script>

<style></style>
