<template>
    <div class="form-group">
        <label :for="pFieldName" v-if="showCaption">{{pCaption}}</label>
        <div v-if="pType === componentType.Input">
            <input-bootstrap
                    :p-form="pForm"
                    :p-field-name="pFieldName"
                    :p-input-type="pInputType"
                    :p-read-only="pReadOnly"
            ></input-bootstrap>
        </div>
        <div v-if="pType === componentType.InputWithDatalist">
            <input-with-datalist-bootstrap
                    :p-form="pForm"
                    :p-field-name="pFieldName"
                    :p-input-type="pInputType"
                    :p-dict-list="pDictList"
                    :p-dict-val-name="pDictValName"
            ></input-with-datalist-bootstrap>
        </div>
        <div v-else-if="pType === componentType.Select">
            <select-bootstrap
                    :p-form="pForm"
                    :p-field-name="pFieldName"
                    :p-dict-list="pDictList"
                    :p-dict-val-name="pDictValName"
                    :p-is-empty-choice-available="pIsEmptyChoiceAvailable"
            ></select-bootstrap>
        </div>
        <div v-else-if="pType === componentType.Textarea">
            <textarea-bootstrap
                    :p-form="pForm"
                    :p-field-name="pFieldName"
            ></textarea-bootstrap>
        </div>
        <div v-else-if="pType === componentType.CheckBox">
            <checkbox-bootstrap
                    :p-form="pForm"
                    :p-field-name="pFieldName"
                    :p-caption="pCaption"
            ></checkbox-bootstrap>
        </div>
        <div v-else-if="pType === componentType.Select2">
            <select2-bootstrap
                :p-form="pForm"
                :p-field-name="pFieldName"
                :p-dict-list="pDictList"
                :p-dict-val-name="pDictValName"
                :p-is-empty-choice-available="pIsEmptyChoiceAvailable"
            ></select2-bootstrap>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MultiLangFormGroupComponent",
        props: {
            pCaption: String,
            pFieldName: String,
            pInputType: String,
            pInputMaxValue: {
                type: Number,
                default: null
            },
            pType: Number,
            pForm: Object,
            pDictList: Array,
            pDictValName: {
                type: String,
                default: 'name'
            },
            pReadOnly:{
                type: Boolean,
                default: false
            },
            pIsEmptyChoiceAvailable:{
                type: Boolean,
                default: true
            },
        },
        data() {
            return {
                componentType: formComponentType,
            }
        },
        computed:{
            showCaption(){
                return this.pType !== this.componentType.CheckBox;
            }
        }
    }
</script>

<style scoped>

</style>
