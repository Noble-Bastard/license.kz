<template>
    <div class="custom-form-control">
        <textarea :class="['form-control', pForm.errors.has(fieldName) ? 'is-invalid' : '']"
                  v-model="pForm[fieldName]" :id="fieldName" :name="fieldName"
        ></textarea>

        <error-bootstrap :p-field-name="pFieldName" :p-form="pForm"/>
    </div>
</template>

<script>
    export default {
        name: "TextareaBootstrap",
        props: {
            pFieldName: String,
            pForm: Object
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