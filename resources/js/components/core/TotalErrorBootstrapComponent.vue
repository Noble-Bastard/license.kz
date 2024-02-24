<template>

    <div v-if="Object.keys(pForm.errors.errors).length !== 0" class="row">
        <div class="form-group">
            <div>
                <div class="form-control is-invalid" hidden="hidden"></div>
                <span v-for="(key, index) in Object.keys(pForm.errors.errors)" :class="pLightSchema ? ['help-block invalid-feedback light-error-text'] : ['help-block invalid-feedback']">
                    <strong v-text="pForm.errors.errors[key][0]"></strong>
                </span>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "TotalErrorBootstrap",
        props: {
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