<template>
  <div>
    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <div class="title-main">
            {{ trans.get('messages.admin.employee.employee_list') }}
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row pb-3">
                <div class="col-12">
                  <button class="btn btn-primary" @click="showEmployeeCard(null)">
                    <i class="fa fa-plus-square"></i>
                    {{ trans.get('messages.all.add') }}
                  </button>
                </div>
              </div>
              <div>
                <table id="users" class="table table-striped table-responsive-sm col-12">
                  <thead>
                  <tr>
                    <th>{{ trans.get('messages.admin.employee.fio') }}</th>
                    <th>{{ trans.get('messages.admin.employee.position') }}</th>
                    <th>{{ trans.get('messages.admin.employee.phone') }}</th>
                    <th>{{ trans.get('messages.admin.employee.address') }}</th>
                    <th>{{ trans.get('messages.admin.employee.email') }}</th>
                    <th>{{ trans.get('messages.admin.employee.web_site') }}</th>
                    <th>{{ trans.get('messages.all.actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(entity, index) in entityList.data">
                    <td>{{ entity.last_name }} {{ entity.first_name }}</td>
                    <td>{{ entity.position.value }}</td>
                    <td>{{ entity.phone }}</td>
                    <td>{{ entity.address }}</td>
                    <td>{{ entity.email }}</td>
                    <td>{{ entity.web_site }}</td>
                    <td class="text-center">
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                          <i class="fa fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item"
                             @click="changePhoto(entity.id)">{{ trans.get('messages.admin.employee.changePhoto') }}</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item cursor-pointer"
                             @click="showEmployeeCard(entity.id)">{{ trans.get('messages.all.edit') }}</a>
                          <a class="dropdown-item"
                             @click="deleteEntity(entity.id, index)"
                             data-method="delete">{{ trans.get('messages.all.delete') }}</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <div class="row padding-t-15">
                  <div class="col-12">
                    <pagination class="float-right" :data="entityList"
                                @pagination-change-page="getEntityList"></pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="change-photo">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ trans.get('messages.admin.employee.changePhoto') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <div class="form-group">
                <label for="file">{{ trans.get('messages.admin.serviceCategory.name') }}</label>
                <input :class="['form-control']" accept="image/*"
                       type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" @click="uploadPhoto()" class="btn btn-primary">
              {{ trans.get('messages.all.submit') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <employee-card :key="employeeCardKey"
                   :initial-employee-id="selectedEmployee"></employee-card>
  </div>
</template>

<script>
export default {
  name: "EmployeeListComponent",
  data() {
    return {
      url: '/admin/vue/employee',
      entityList: {},
      selectedEmployee: null,
      employeeCardKey: 0,
      currentPage: 1,
      entityIdForPhoto: null,
    }
  },
  mounted() {
    this.getEntityList();
  },
  methods: {
    getEntityList(page = 1) {
      this.currentPage = page;
      axios.get(this.url + '/list?page=' + page).then(response => {
        this.entityList = response.data;
      });
    },
    showEmployeeCard(employeeId) {
      this.selectedEmployee = employeeId;
      this.employeeCardKey += 1;
    },
    deleteEntity(entityId, index) {
      let self = this;
      axios.post(this.url + "/delete", {
        entityId: entityId
      })
          .then(request => {
            self.entityList.data.splice(index, 1);

            self.$notify({
              group: 'all',
              position: 'top right',
              text: this.trans.get('messages.admin.system.success.delete'),
              type: 'success'
            });

          });
    },
    changePhoto(entityId) {
      this.entityIdForPhoto = entityId;

      $('#change-photo').modal('show');
    },
    handleFileUpload() {
      this.photo = this.$refs.file.files[0];
    },
    uploadPhoto() {
      let self = this;
      let formData = new FormData();
      formData.append('photo', this.photo);
      axios.post(this.url + "/changePhoto/" + this.entityIdForPhoto,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      ).then(function () {

        $('#change-photo').modal('hide');

        self.$notify({
          group: 'all',
          position: 'top right',
          text: self.trans.get('messages.admin.system.success.update'),
          type: 'success'
        });
      });
    },
  }
}
</script>

<style scoped>

</style>
