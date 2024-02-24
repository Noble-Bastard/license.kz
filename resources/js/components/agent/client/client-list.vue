 <template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="title-main">
                        {{trans.get('messages.agent.client_list')}}

                    </div>

                    <div class="card-body">
                        <div>
                            <table id="users" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>{{trans.get('messages.agent.client_name')}}</th>
                                    <th>{{trans.get('messages.agent.client_email')}}</th>
                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user, index) in clientList.data">
                                    <td>{{user.user_name}}</td>
                                    <td>{{user.email}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item cursor-pointer"
                                                   @click="getServiceJournalList(user.id, user.user_name)">{{trans.get('messages.agent.client_service_list')}}</a>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="serviceJournalList-modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{currentClientName}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th>{{trans.get('messages.agent.service_no')}}</th>
                                <th>{{trans.get('messages.agent.service_name')}}</th>
                                <th>{{trans.get('messages.agent.service_date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in serviceJournalList">
                                <td>{{item.service_no}}</td>
                                <td>{{item.service_name}}</td>
                                <td>{{item.create_date | moment("DD.MM.YYYY")}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
    export default {
        name: 'agent-client-list',
        data() {
            return {
                url: '/agent/vue/agent',
                clientList: {},
                serviceJournalList: {},
                currentPage: 1,
                currentClientName: '',
                searchText: null,
            }
        },
        mounted() {
            this.getClientList();
        },
        methods: {
            getClientList(page = 1) {
                this.currentPage = page;
                let requestUrl = this.url + '/clientList?page=' + page;

                axios.get(requestUrl).then(response => {
                    this.clientList = response.data;
                });
            },
            getServiceJournalList(clientId, clientName){
                let requestUrl = this.url + '/getServiceJournalList' + '/' + clientId;
                this.currentClientName = clientName;

                axios.get(requestUrl).then(response => {
                    this.serviceJournalList = response.data;

                    $('#serviceJournalList-modal').modal('show');
                });
            }
        }
    }
</script>

<style scoped>

</style>