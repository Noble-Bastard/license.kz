 <template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="title-main">
                        {{trans.get('messages.admin.users.user_list')}}

                    </div>

                    <div class="card-body">
                        <div>

                            <div class="input-group pr-0 pb-3 col-4 float-right">
                                <input type="text" class="form-control" v-model="searchText" :placeholder="trans.get('messages.all.search')">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" @click="searchUser()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <table id="users" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>{{trans.get('messages.admin.users.user_name_name')}}</th>
                                    <th>{{trans.get('messages.admin.users.email')}}</th>
                                    <th>{{trans.get('messages.admin.users.agent')}}</th>
                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user, index) in clientList.data">
                                    <td>{{user.user_name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.agent_name}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item cursor-pointer"
                                                   @click="initSetAgent(index)">{{trans.get('messages.admin.users.agent')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col-12">
                                    <pagination class="float-right" :data="clientList"
                                                @pagination-change-page="getClientList"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="set-agent">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)" @keydown="form.errors.clear($event.target.name)">
                        <div class="form-group">
                            <label for="agent_id">{{trans.get('messages.admin.users.agent')}}</label>

                            <select :class="['form-control', form.errors.has('agent_id') ? 'is-invalid' : '']" id="agent_id" name="agent_id" v-model="form.agent_id">
                                <option :value="item.id" v-for="(item, index) in agentList">
                                    {{item.full_name}}
                                </option>
                            </select>
                            <span v-if="form.errors.has('agent_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('agent_id')"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{trans.get('messages.all.cancel')}}</button>
                        <button type="button" @click="setAgent()" :disabled="form.errorsOrSend()" class="btn btn-primary">{{trans.get('messages.all.submit')}}</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>

<script>
    export default {
        name: 'salemanager-client-list',
        data() {
            return {
                url: '/salemanager/vue/clientList',
                clientList: {},
                defaultClient: {
                    client_id: 0,
                    profile_id: null,
                    agent_id: null,
                },
                form: new Form(this.defaultClient),
                agentList: this.agentListProp,
                currentPage: 1,
                searchText: null,
            }
        },
        props: {
            "agentListProp": Array
        },
        mounted() {
            this.getClientList();
        },
        methods: {
            getClientList(page = 1) {
                this.currentPage = page;
                let requestUrl = this.url + '?page=' + page;
                if(this.searchText !== null)
                {
                    requestUrl = requestUrl + '&searchText=' + this.searchText;
                }

                axios.get(requestUrl).then(response => {
                    this.clientList = response.data;
                });
            },
            searchUser(){
                this.getClientList();
            },
            initSetAgent(index){
                this.form = new Form(this.clientList.data[index]);
                $('#set-agent').modal('show');
            },
            setAgent(){
                let _url = this.url + '/setAgent';
                let self = this;
                let _message = this.trans.get('messages.admin.system.success.update');

                self.form.post(_url)
                    .then(request => {
                        self.getClientList(self.currentPage);
                        $('#set-agent').modal('hide');

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });
                    });
            }
        }
    }
</script>

<style scoped>

</style>
