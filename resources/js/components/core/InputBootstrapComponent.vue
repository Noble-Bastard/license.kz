<template>
    <div class="custom-form-control">
        <input v-if="pReadOnly" :class="['form-control', pForm.errors.has(fieldName) ? 'is-invalid' : '']"
               readonly="readonly"
               v-model="pForm[fieldName]" :id="fieldName" :name="fieldName" :type="pInputType"/>
        <input v-else :class="['form-control', pForm.errors.has(fieldName) ? 'is-invalid' : '']"
               v-model="pForm[fieldName]" :id="fieldName" :name="fieldName" :type="pInputType"/>
        <error-bootstrap :p-field-name="pFieldName" :p-form="pForm"/>
    </div>
</template>

<script>
    export default {
        name: "InputBootstrap",
        props: {
            pFieldName: String,
            pInputType: String,
            pForm: Object,
            pReadOnly: Boolean
        },
        computed: {
            fieldName() {
                return this.pFieldName;
            }
        }
    }
</script>

<style scoped>

</style>