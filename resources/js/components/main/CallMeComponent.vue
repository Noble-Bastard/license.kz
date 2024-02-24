<template>
    <div class="col-12">
        <div class="row  align-items-end">
            <div class="col-md-6 col-xl-6">
                <input class="form-control footer-input" name="fio" type="text"
                       :placeholder="trans.get('messages.layouts.enter_name')" v-model="fio">

                <input class="form-control footer-input" name="email" type="email"  v-model="email"
                       :placeholder="trans.get('messages.layouts.enter_email')">
                <input class="form-control footer-input" name="phone" type="tel"  v-model="phone"
                       placeholder="+7 __ _______">
            </div>
            <div class="col-md-6 col-xl-6">
                <button class="btn btn-footer w-100 call_me_btn" v-on:click="callMe">{{trans.get('messages.layouts.order_call_me')}}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CallMeComponent",
        props:{
          pTest: Object
        },
        data(){
          return {
              fio: null,
              email: null,
              phone: null
          }
        },
        methods: {
            callMe(){
                if(this.phone != null) {
                    axios.post("/callMe", {
                        fio: this.fio,
                        email: this.email,
                        phone: this.phone,
                    })
                        .then(request => {
                            this.fio = null;
                            this.email = null;
                            this.phone = null;

                            this.$notify({
                                group: 'all',
                                position: 'top right',
                                text: this.trans.get('messages.layouts.order_call_me_success'),
                                type: 'success'
                            });
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>