<div class="modal-header">
    <h6 class="modal-title" id="exampleModalCenterTitle">
        <div>Тема: №{{$task->project_description}} {{$task->description}}</div>
    </h6>
  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
</div>

@include('_Message._messagePanel')

<div class="modal-footer">
    <div class="input-group mb-3">
        <input id="messageContent" type="text" class="form-control chat_input"
               placeholder=@lang('messages.executor.message_text')/>
        <div class="input-group-append">
            <button class="btn btn-success" id="sendMessage" type="button"
                    data-taskid="{!! $task->id !!}">@lang('messages.executor.send')</button>
        </div>
    </div>
</div>
