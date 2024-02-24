{{--
    TODO добавить отображение
--}}

@foreach($documentList as $document)
    <div class="col-2 donwloadDocument">
        <div>
            <div class="btn-document">
                    <i class="fa fa-times delete-document" data-documentid="{{$document->document_id}}"></i>

            </div>
            <a href="/storage_/{{$document->document_path}}" target="_blank">
                <div class="img-document">
                    <div class="img-document-txt">@lang('messages.all.document')</div>
                </div>
                <div class="name-document">{{$document->document_name}}</div>
            </a>
        </div>
    </div>
@endforeach