@extends('new.layouts.app')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="title-main">Услуги

                    </div>

                    <div class="card-body">
                        <div class="row pb-3">
                            {{--<div class="col-12 flex-align-right">--}}
                                {{--<div class="btn-group btn-group-toggle btn-success-toggle ">--}}
                                    {{--@foreach($statusList as $status)--}}
                                        {{--<a  class="btn btn-success {{$service_status_id == $status->id ? 'active' : ''}}" href="{{route('manager.project.list_by_status', ['service_status_id' => $status->id])}}">{{$status->name}}</a>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div>
                            <table id="services" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th class="w-65">@lang('messages.all.name')</th>
                                    <th class="w-10">@lang('messages.roles.request_date')</th>
                                    <th class="w-25">@lang('messages.all.manager')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projectReviewList as $projectReview)
                                    <tr>
                                        <td>
                                            <a
                                               href="{{route('curator.review.show', ['projectReviewId'=>$projectReview->id])}}">
                                            {{$projectReview->description }}
                                            </a>
                                        </td>
                                        <td>{{\App\Data\Helper\Assistant::formatDate($projectReview->create_date) }}</td>
                                        <td class="text-center">{{$projectReview->manager_full_name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script>
        //activeTab('curator-review-list');

        $(function(){

        });
    </script>
@endsection