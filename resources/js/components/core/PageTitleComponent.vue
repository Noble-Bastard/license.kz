<template>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{pageTitle}}</h4>
                <div class="d-flex align-items-center" v-if="breadcrumbArray != null">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" v-bind:class="isLastBreadcrumb(index)"
                                v-for="(breadcrumb, index) in breadcrumbArray">
                                <a :href="breadcrumb.key" v-if="index != breadcrumbArray.length - 1">{{breadcrumb.value}}</a>
                                <span v-else>{{breadcrumb.value}}</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PageTitleComponent",
        // data() {
        //     return {
        //         pageTitle: "",
        //         breadcrumbArray: []
        //     }
        // },
        props: {
            pageTitle: String,
            breadcrumbArray: Array
        },
        methods: {
            isLastBreadcrumb: function (breadcrumbArrayIndex) {
                return breadcrumbArrayIndex == this.breadcrumbArray.length - 1 ? 'active' : '';
            }
        }
    }
</script>

<style scoped>

</style>