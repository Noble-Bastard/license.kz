@extends('new.layouts.app')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.sale_manager.commercial_offer.create.title')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="createCommercialOfferForm" action="{{route('sale_manager.commercial_offer.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="idList">ID`s</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" id="idList" name="idList" placeholder="Укажите ID подвидов через `;`" aria-describedby="addById"/>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" style="padding: 0.375rem 0.75rem !important;" type="button" id="addById">Заполнить по ID</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="serviceName">Наименование разрешительного документа</label>
                                <input class="form-control" type="text" id="serviceName" name="serviceName" />
                            </div>
                            <div class="form-group">
                                <label for="serviceList">Выбранные подвиды</label>
                                <textarea class="form-control" id="serviceList" name="serviceList" placeholder="Укажите наименование подвидов через `;`"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="executiveAgency">Уполномоченный орган</label>
                                <input class="form-control" type="text" id="executiveAgency" name="executiveAgency" />
                            </div>

                            <div class="form-group">
                                <label for="serviceAdditionalRequirements">Дополнительные требования</label>
                                <textarea class="form-control" id="serviceAdditionalRequirements" name="serviceAdditionalRequirements" placeholder="Укажите перечисление групп через `||`"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="serviceRequiredDocument">Необходимые документы</label>
                                <textarea class="form-control" id="serviceRequiredDocument" name="serviceRequiredDocument" placeholder="Укажите наименование документов через `;`"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="tax">Стоимость государственной пошлины (МРП)</label>
                                        <input class="form-control" type="number" id="tax" name="tax" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="executionWorkDay">Срок оказания услуги</label>
                                        <input class="form-control" type="text" id="executionWorkDay" name="executionWorkDay" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="cost">Стоимость</label>
                                        <input class="form-control" type="number" id="cost" name="cost" step="100" min="1"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="emailToSend">Email (куда будет осуществленна отправка)</label>
                                        <input class="form-control" type="email" id="emailToSend" name="emailToSend" value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="phone">Телефон</label>
                                        <input class="form-control" type="text" id="phone" name="phone" value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Имя</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" id="submitBtn" class="btn btn-success float-right">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $(document).on('click', '#addById', function(){
                $.ajax({
                    type: 'get',
                    url: '{{route('sale_manager.commercial_offer.prepareServiceById')}}',
                    data: {
                        idList: $('#idList').val()
                    },
                    success: function (data) {
                        $('#serviceName').val(data.serviceName)
                        $('#serviceList').val(data.serviceList)
                        $('#executiveAgency').val(data.executiveAgency)
                        $('#tax').val(data.tax)
                        $('#executionWorkDay').val(data.executionWorkDay)
                        $('#serviceAdditionalRequirements').val(data.serviceAdditionalRequirements)
                        $('#serviceRequiredDocument').val(data.serviceRequiredDocument)
                        $('#cost').val(data.cost)
                    }
                });
            })

            $(document).on('click', '#submitBtn', function(){
                $(this).prop('disabled', true)
                $("#createCommercialOfferForm").submit();
            })
        })
    </script>


@endsection

