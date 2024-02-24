@if(!is_null($n))
    <div class="row border pt-2 pb-2 mt-2 {{$default ? 'd-none panel-default' : ''}}">
        @if($n > 0)
            <div class="col-12">
                <button type="button" class="btn btn-danger btn-sm float-right deleteBlock">@lang('messages.all.delete')</button>
            </div>
        @endif
        <div class="col-6">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_lang_knowledge.lang_name'), ['class' => '']) !!}
            {!! Form::text('lang_knowledge_lang_name['.$n.']', null, array_merge(['class' => $errors->has('lang_knowledge_lang_name.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('lang_knowledge_lang_name.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('lang_knowledge_lang_name.'.$n) }}</strong>
                </span>
            @endif
        </div>
        <div class="col-6">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_lang_knowledge.lang_level'), ['class' => '']) !!}
            {!! Form::text('lang_knowledge_lang_level['.$n.']', null, array_merge(['class' => $errors->has('lang_knowledge_lang_level.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('lang_knowledge_lang_level.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('lang_knowledge_lang_level.'.$n) }}</strong>
                </span>
            @endif
        </div>
    </div>
@else
    <div class="row border pt-2 pb-2 mt-2 {{$default ? 'd-none panel-default' : ''}}">
        @if($default)
            <div class="col-12">
                <button type="button" class="btn btn-danger btn-sm float-right deleteBlock">@lang('messages.all.delete')</button>
            </div>
        @endif
        <div class="col-6">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_lang_knowledge.lang_name'), ['class' => '']) !!}
            <input type="text" name="lang_knowledge_lang_name[]" class="form-control"/>
        </div>
        <div class="col-6">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_lang_knowledge.lang_level'), ['class' => '']) !!}
            <input type="text" name="lang_knowledge_lang_level[]" class="form-control"/>
        </div>
    </div>
@endif