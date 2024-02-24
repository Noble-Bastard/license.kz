<template>
    <div>
        <vue-select
            :id="fieldName"
            :name="fieldName"
            :options="dictList"
            v-model="pForm[fieldName]"
            :searchable="needSearch"
            :reduce="dict => dict.code"
            :class="[pForm.errors.has(fieldName) ? 'is-invalid' : '']"
        />

        <error-bootstrap :p-field-name="pFieldName" :p-form="pForm"/>
    </div>
</template>

<script>
    import 'vue-select/dist/vue-select.css';

    export default {
        name: "Select2BootstrapComponent",
        mounted() {
            this.prepareDict();
        },
        watch:{
            pDictList: function(){
                this.prepareDict();
            }
        },
        props: {
            pFieldName: String,
            pForm: Object,
            pDictList: Array,
            pDictValName: String,
            pIsEmptyChoiceAvailable: Boolean
        },
        data() {
            return {
                dictList: [],
            }
        },
        computed: {
            fieldName() {
                return this.pFieldName;
            },
            needSearch() {
                return this.dictList.length > 3;
            }
        },
        methods: {
            prepareDict() {
                this.dictList = [];
                if (this.pIsEmptyChoiceAvailable) {
                    this.dictList.push({label: '', code: ''});
                }
                let self = this;
                this.pDictList.forEach(function (element) {
                    self.dictList.push({label: element[self.pDictValName], code: element.id});
                });
            }
        }
    }
</script>

<style scoped>
    .invalid-feedback {
        display: block !important;
    }

    .v-select.is-invalid >>> .vs__dropdown-toggle {
        border: 1px solid #e3342f !important;
    }
</style>
