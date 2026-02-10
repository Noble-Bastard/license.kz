@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">@lang('messages.manager.mail')

                </div>

                <div class="card-body">
                    <div>
                        <table class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr class="">
                                <th class="w-10">@lang('messages.manager.number')</th>
                                <th class="w-15">@lang('messages.all.service_number')</th>
                                <th class="w-50">@lang('messages.manager.name')</th>
                                <th class="w-15">@lang('messages.manager.last_message')</th>
                                <th class="w-10"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($serviceMessageList as $message)
                                <tr>
                                    <td class="text-center">
                                        @if($message->is_read)
                                            <span class="badge badge-secondary">&nbsp;</span>
                                        @else
                                            <span class="badge badge-success">&nbsp;</span>
                                        @endif
                                    </td>
                                    <td class="text-center">№{{$message->service_no}}</td>
                                    <td class="text-center">{{$message->service_name}}</td>
                                    <td class="text-center">{{$message->last_date != null ? \App\Data\Helper\Assistant::formatDateTime($message->last_date) : ''}}</td>
                                    <td class="text-center">
                                        <a class="messageWindowLink" href="{{route('Manager.message.list', ['serviceJournalId' => $message->id])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-2">
                        {{ $serviceMessageList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('news._shortNewsPart')

    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="messageModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('profile');

        $(function () {
            $(document).on('click', '.messageWindowLink', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: $(this).attr('href'),
                    success: function(data){
                        $('#messageModal .modal-content').html(data);
                        $('#messageModal').modal('show');

                        var scrolToElm = $('.msg_container_base .message.unread').first();
                        if(scrolToElm.length === 0){
                            scrolToElm = $('.msg_container_base .message').last();
                        }
                        $('.msg_container_base').scrollTo(scrolToElm);
                    }
                });
            });

            $(document).on('click', '#sendMessage', function(e){
                $.ajax({
                    type: 'POST',
                    url: '{{route('Manager.service.message.create')}}',
                    data: {
                        '_token' : "{{ csrf_token() }}",
                        'serviceJournalId' : $(this).data('servicejournalid'),
                        'messageContent' : $('#messageContent').val()
                    },
                    success: function(data){
                        $('.msg_container_base')
                            .html(data)
                            .scrollTo($('.msg_container_base .message').last());

                        $('#messageContent')
                            .val('')
                            .focus();
                    }
                });
            });

            //$this.parents('.panel').find('.card-body').slideDown();
            //https://stackoverflow.com/questions/4006520/using-html5-file-uploads-with-ajax-and-jquery
        });
    </script>
@endsection