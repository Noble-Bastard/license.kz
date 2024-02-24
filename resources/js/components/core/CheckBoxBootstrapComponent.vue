<template>
    <div class="custom-form-control">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" :class="['custom-control-input', pForm.errors.has('fieldName') ? 'is-invalid' : '']"
                   :id="uniqueFieldName" :name="fieldName" v-model="pForm[fieldName]"/>
            <label class="custom-control-label" :for="uniqueFieldName">{{pCaption}}</label>
        </div>

        <error-bootstrap :p-field-name="fieldName" :p-form="pForm"/>
    </div>
</template>

<script>
    export default {
        name: "CheckBoxBootstrap",
        props: {
            pFieldName: String,
            pCaption: String,
            pForm: Object
        },
        computed: {
            fieldName() {
                return this.pFieldName;
            },
            uniqueFieldName() {
                return "_" + this.pFieldName;
            }
        }
    }
</script>

<style scoped>

</style>