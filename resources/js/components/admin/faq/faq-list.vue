<template>
  <div class="mt-3">
    <div class="row">
      <div class="col-12">
        <div class="title-main">
          {{ trans.get('messages.admin.faq.list') }}
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div>
              <div class="row mb-3">
                <div class="col-3 d-inline">
                  <button class="btn btn-primary"
                          @click="initCreate()">
                    <i class="fa fa-plus-square"></i>
                    {{ trans.get('messages.all.add') }}
                  </button>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-12">
                  <table id="faqs" class="table table-striped table-responsive-sm">
                    <thead>
                    <tr>
                      <th>{{ trans.get('messages.admin.faq.question') }}</th>
                      <th>{{ trans.get('messages.admin.faq.answer') }}</th>
                      <th>{{ trans.get('messages.admin.faq.name') }}</th>
                      <th>{{ trans.get('messages.admin.faq.email') }}</th>
                      <th>{{ trans.get('messages.admin.faq.phone') }}</th>
                      <th>{{ trans.get('messages.admin.faq.activity') }}</th>
                      <th>{{ trans.get('messages.all.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(faq, index) in faqList.data">
                      <td>{{ faq.question }}</td>
                      <td>{{ faq.answer ? faq.answer.substring(0, 150) : '' }}</td>
                      <td>{{ faq.name }}</td>
                      <td>{{ faq.email }}</td>
                      <td>{{ faq.phone }}</td>
                      <td>{{ isActive(faq) }}
                      </td>
                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button"
                                  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                            <i class="fa fa-bars"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item cursor-pointer"
                               @click="initUpdate(index)">{{ trans.get('messages.all.edit') }}</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row padding-t-15">
                <div class="col-12">
                    <pagination class="float-right" :data="faqList"
                                @pagination-change-page="getFaqList"></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="set-model">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="form.id === 0">
              {{ trans.get('messages.admin.system.modal.create') }}</h4>
            <h4 class="modal-title" v-else>{{ trans.get('messages.admin.system.modal.update') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" @change="form.errors.clear($event.target.name)"
               @keydown="form.errors.clear($event.target.name)">
            <div class="row">
              <div class="col-12">


                <div class="form-group">
                  <label for="question">{{ trans.get('messages.admin.faq.question') }}</label>

                  <textarea :class="['form-control', form.errors.has('question') ? 'is-invalid' : '']"
                            v-model="form.question" id="question" name="question">
              </textarea>
                  <span v-if="form.errors.has('question')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('user_name')"></strong>
                            </span>
                </div>
                <div class="form-group">
                  <label for="answer">{{ trans.get('messages.admin.faq.answer') }}</label>

                  <textarea :class="['form-control', form.errors.has('answer') ? 'is-invalid' : '']"
                            v-model="form.answer" id="answer" name="answer">
              </textarea>
                  <span v-if="form.errors.has('answer')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('answer')"></strong>
                            </span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="question_en">{{trans.get('messages.admin.faq.question_en')}}</label>

                  <input :class="['form-control', form.errors.has('question_en') ? 'is-invalid' : '']"
                         id="question_en"
                         name="question_en" v-model="form.question_en"/>

                  <span v-if="form.errors.has('question_en')"
                        :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('question_en')"></strong>
                                        </span>
                </div>
                <div class="form-group">
                  <label for="answer_en">{{trans.get('messages.admin.faq.answer_en')}}</label>

                  <input :class="['form-control', form.errors.has('answer_en') ? 'is-invalid' : '']"
                         id="answer_en"
                         name="answer_en" v-model="form.answer_en"/>

                  <span v-if="form.errors.has('answer_en')"
                        :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('answer_en')"></strong>
                                        </span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox"
                           :class="['custom-control-input', form.errors.has('is_moderate') ? 'is-invalid' : '']"
                           id="is_moderate" v-model="form.is_moderate">
                    <label class="custom-control-label" for="is_moderate">{{trans.get('messages.admin.faq.activity')}}</label>
                  </div>

                  <span v-if="form.errors.has('is_moderate')"
                        :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('is_moderate')"></strong>
                                                </span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                {{ trans.get('messages.all.cancel') }}
              </button>
              <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
                {{ trans.get('messages.all.submit') }}
              </button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
  </div>
</template>

<script>
export default {
  name: "faq-list",
  data() {
    return {
      url: '/admin/vue/faq',
      faqList: {},
      currentPage: 1,
      defaultFaq: {
        id: 0,
        question: null,
        question_en: null,
        answer: null,
        answer_en: null,
        user_name: null,
        phone: null,
        email: null,
        is_moderate: false
      },
      form: new Form(this.defaultFaq),
    }
  },
  mounted() {
    this.getFaqList();
  },
  methods: {
    getFaqList(page = 1) {
      this.currentPage = page;
      let requestUrl = this.url + '?page=' + page;

      axios.get(requestUrl).then(response => {
        this.faqList = response.data;
      });
    },
    isActive(faq) {
      return faq.is_moderate * 1 === 1 ? this.trans.get('messages.all.yes') :
          this.trans.get('messages.all.no')
    },
    initCreate() {
      this.form = new Form(this.defaultFaq);

      $('#set-model').modal('show');
    },
    initUpdate(index){
      this.form = new Form(this.faqList.data[index]);
      // this.form.is_moderate = this.form.is_moderate === 1;

      $('#set-model').modal('show');
    },
    set() {
      let self = this;
      let _url = this.url + "/store";
      let _message = this.trans.get('messages.admin.system.success.store');
      if (self.form.id !== 0) {
        _url = this.url + "/update";
        _message = this.trans.get('messages.admin.system.success.update');
      }

      self.form.post(_url)
          .then(request => {
            self.getFaqList(self.currentPage);
            $('#set-model').modal('hide');

            self.$notify({
              group: 'all',
              position: 'top right',
              text: _message,
              type: 'success'
            });
          });
    },
  }
}
</script>

<style scoped>

</style>
