<div class="modal-header">
    <h6 class="modal-title" id="exampleModalCenterTitle">
        <div>@lang('messages.client.lawyer') {{$serviceJournal->manager_full_name}}</div>
        <div>@lang('messages.client.subject'){{$serviceJournal->service_no}} {{$serviceJournal->service_name}}</div>
    </h6>

  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
</div>

@if(!$serviceJournal->manager_full_name)
  <div class="modal-body msg_container_base">
  <h3>Дождитесь назначения менеджера</h3>
  </div>
@else
  @include('_Message._messagePanel')
  <div class="modal-footer">
    <div class="input-group mb-3">
      <input id="messageContent" type="text" class="form-control chat_input"
             placeholder="@lang('messages.client.message_text')"/>
      <div class="input-group-append">
        <button class="btn btn-success" id="sendMessage" type="button"
                data-servicejournalid="{{$serviceJournal->id}}">@lang('messages.all.send')</button>
      </div>
    </div>
  </div>
@endif



