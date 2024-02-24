<template>
    <div class="custom-form-control">
        <input :class="['form-control', pForm.errors.has(fieldName) ? 'is-invalid' : '']"
               v-model="pForm[fieldName]" :id="fieldName" :name="fieldName" :type="pInputType" :list="datalistName"/>

        <datalist :id="datalistName">
            <option :value="getValue(dictItem)" v-for="dictItem in pDictList"></option>
        </datalist>

        <error-bootstrap :p-field-name="pFieldName" :p-form="pForm"/>
    </div>
</template>

<script>
    export default {
        name: "InputWithDatalistBootstrap",
        props: {
            pFieldName: String,
            pInputType: String,
            pForm: Object,
            pDictList: Array,
            pDictValName: String
        },
        computed: {
            fieldName() {
                return this.pFieldName;
            },
            datalistName() {
                return this.pFieldName + '_list';
            }
        },
        methods:{
            getValue(dictItem){
                return dictItem[this.pDictValName];
            }
        }
    }
</script>

<style scoped>

</style>