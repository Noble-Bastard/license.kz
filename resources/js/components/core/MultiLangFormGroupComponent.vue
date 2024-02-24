<template>
    <div class="form-group">
        <label :for="pFieldName">{{pCaption}}</label>
        <div v-if="pType === componentType.Input">
            <input-bootstrap-multi-lang
                    v-for="(lang, index) in langList"
                    :key="index"
                    :p-lang="lang"
                    :p-form="pForm"
                    :p-field-name="pFieldName"
            ></input-bootstrap-multi-lang>
        </div>
        <div v-else-if="pType === componentType.Textarea">
            <textarea-bootstrap-multi-lang
                    v-for="(lang, index) in langList"
                    :key="index"
                    :p-lang="lang"
                    :p-form="pForm"
                    :p-field-name="pFieldName"
            ></textarea-bootstrap-multi-lang>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MultiLangFormGroupComponent",
        props: {
            pCaption: String,
            pFieldName: String,
            pType: Number,
            pForm: Object,
            pDictList: Array
        },
        data() {
            return {
                langList: ['ru', 'en'],
                componentType: formComponentType,
            }
        }
    }
</script>

<style scoped>

</style>