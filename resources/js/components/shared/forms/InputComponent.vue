<template>
    <div>
        <label>{{ label }}</label>
        <!-- <input type="text" :class="classes" v-model="modelLocal" /> -->
        <slot v-bind:classes="classes"></slot>
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
        classes: function() {
            return [
                "form-control",
                this.is_validation_enabled == false || this.is_dirty == false
                    ? ""
                    : this.is_valid
                    ? ""
                    : "is-invalid"
            ];
        }
    },
    watch: {
        model: {
            handler: function(val, oldVal) {
                this.is_dirty = true;
            },
            deep: true
        }
    },
    props: {
        label: String,
        is_validation_enabled: Boolean,
        error_messages: Array,
        model: String
    },
    data: function() {
        return {
            is_dirty: false
        };
    }
};
</script>
