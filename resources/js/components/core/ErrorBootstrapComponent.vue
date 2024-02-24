<template>
    <span v-if="pForm.errors.has(pFieldName)" :class="pLightSchema ? ['help-block invalid-feedback light-error-text'] : ['help-block invalid-feedback']">
        <strong v-text="pForm.errors.get(pFieldName)"></strong>
    </span>

</template>

<script>
    export default {
        name: "ErrorBootstrap",
        props: {
            pFieldName: String,
            pForm: Object,
            pLightSchema: {
                type: Boolean,
                default: false
            },
        }
    }
</script>

<style scoped>

</style>