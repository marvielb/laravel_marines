<template>
    <div>
        <label>{{ label }}</label>
        <input
            type="text"
            :class="[
                'form-control',
                is_validation_enabled == false
                    ? ''
                    : is_valid
                    ? 'is-valid'
                    : 'is-invalid'
            ]"
            v-model="modelLocal"
        />
        <div v-if="is_valid == false" class="invalid-feedback">
            <ul>
                <li v-for="(error, index) in error_messages" :key="index">
                    {{ error }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        is_valid: function() {
            return this.error_messages
                ? this.error_messages.length === 0
                : true;
        },
        modelLocal: {
            get: function() {
                return this.model;
            },
            set: function(value) {
                this.$emit("update:model", value);
            }
        }
    },
    props: {
        label: String,
        is_validation_enabled: Boolean,
        error_messages: Array,
        model: String
    }
};
</script>
