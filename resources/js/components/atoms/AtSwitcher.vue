<template>
    <b-form-checkbox @change="onChange" size="size" :checked="checked" switch> </b-form-checkbox>
</template>

<script>
export default {
    props: {
        size: {
            type: String
        }
    },
    methods: {
        onChange(event) {
            this.checked = !this.checked;
            this.$emit('input', this.checked);
        }
    },
    data() {
        return {
            checked: false
        };
    }
};
</script>
