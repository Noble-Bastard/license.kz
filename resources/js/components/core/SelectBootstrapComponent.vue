<template>
    <div>
        <select
                :id="fieldName"
                :name="fieldName"
                v-model="pForm[fieldName]"
                :class="['form-control', pForm.errors.has(fieldName) ? 'is-invalid' : '']"
        >
            <option v-if="pIsEmptyChoiceAvailable"></option>
            <option :value="dictItem.id" v-for="(dictItem, index) in pDictList">
                {{getValue(dictItem)}}
            </option>
        </select>

        <error-bootstrap :p-field-name="pFieldName" :p-form="pForm"/>
    </div>
</template>

<script>
    export default {
        name: "SelectBootstrapComponent",
        props: {
            pFieldName: String,
            pForm: Object,
            pDictList: Array,
            pDictValName: String,
            pIsEmptyChoiceAvailable: Boolean
        },
        computed: {
            fieldName() {
                return this.pFieldName;
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