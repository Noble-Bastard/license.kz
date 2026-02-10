@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="title-main">@lang('messages.manager.groups')

                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a class="btn btn-success" href="{{route('Manager.groups.create')}}"><i
                                            class="fa fa-plus-square"></i> @lang('messages.all.add')</a>
                            </div>
                        </div>
                        <div>
                            <table id="executors" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.manager.name')</th>
                                    <th>@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groupList as $group)
                                    <tr>
                                        <td>{{$group->name }}</td>

                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('Manager.groups.edit', ['id' => $group->id])}}">@lang('messages.all.edit')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('Manager.groups.destroy', $group->id)}}"
                                                       data-method="delete">@lang('messages.all.delete')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('Manager.groups.bodyEdit', ['id' => $group->id])}}">@lang('messages.manager.add_executor')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $groupList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection