<template>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <img :src="flagName">
            </span>
        </div>
        <textarea-bootstrap
                :p-form="pForm"
                :p-field-name="fieldName"
        ></textarea-bootstrap>
    </div>
</template>

<script>
    export default {
        name: "InputBootstrapMultiLang",
        props: {
            pLang: String,
            pFieldName: String,
            pForm: Object
        },
        computed: {
            flagName() {
                return '/images/flag-' + this.pLang + '.png'
            },
            fieldName() {
                return this.pLang === 'ru' ? this.pFieldName : this.pFieldName + '_' + this.pLang;
            }
        }
    }
</script>

<style scoped>

</style>