@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-main">@lang('messages.manager.performers')

                </div>
            </div>

            <div class="col-12">
                <div class="card">


                    <div class="card-body">
                        <div class="col-12 flex-align-left pb-3">
                            <span class="badge badge-primary">@lang('messages.manager.total_tasks'){{$taskCnt}}</span>
                            <span class="badge badge-primary">@lang('messages.manager.distributed_tasks'){{$taskOnExecutors}} </span>
                            <span class="badge badge-primary">@lang('messages.manager.total_execution_time'){{$taskExecutionTime}}</span>
                        </div>
                        {{--<div class="row pb-3">--}}
                        {{--<div class="col-12">--}}
                        {{----}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-12">
                            <table id="executors" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.all.full_name')</th>
                                    <th>@lang('messages.all.email')</th>
                                    <th>@lang('messages.manager.hourly_rate')</th>
                                    <th>@lang('messages.manager.active')</th>
                                    <th>@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($executorList as $executor)
                                    <tr>
                                        <td>{{$executor->full_name }}</td>
                                        <td>{{$executor->email }}</td>
                                        <td class="text-center hourlyRate_{!! $executor->id !!}">{{($executor->hourlyRate)}}</td>
                                        <td class="text-center">{{($executor->is_active  == 1) ? trans('messages.all.yes') : trans('messages.all.no')}}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <button class="dropdown-item hourlyRateEdit"
                                                            data-executorid="{{$executor->id}}"
                                                            data-hourlyrate="{{$executor->hourlyRate}}"
                                                    >
                                                        @lang('messages.manager.hourly_rate')
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $executorList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hourlyRateModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal" id="hourlyRateForm" method="post"
                          action="{{route('Manager.executor.setHourlyRate')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="executorId" value=""/>
                        <div class="form-group">
                            <label for="hourlyRate">@lang('messages.manager.hourly_rate')</label>
                            <input class="form-control" type="number" name="hourlyRate"/>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <button type="submit" class="btn btn-success float-right">
                                    @lang('messages.manager.set_rate')
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $(document).on('click', '.hourlyRateEdit', function (e) {
                var modal = $('#hourlyRateModal');
                $('input[name="executorId"]', modal).val($(this).data('executorid'));
                $('input[name="hourlyRate"]', modal).val($(this).data('hourlyrate') * 1);
                modal.modal('show');
            });

            $('#hourlyRateForm').submit(function () {
                var executorId = $('input[name="executorId"]', this).val();
                var hourlyRate = $('input[name="hourlyRate"]', this).val();

                $(this).ajaxSubmit({
                    success: function () {
                        $('.hourlyRate_' + executorId).html(hourlyRate);

                        $('#hourlyRateModal').modal('hide');
                    }
                });

                return false;
            });
        })
    </script>
@endsection