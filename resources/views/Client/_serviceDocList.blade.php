
                <form class="form-horizontal" method="post" action="{{route('Client.StepDocument.add',$serviceStepId)}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="serviceStepId" value="{{$serviceStepId}}"/>
                    <input type="hidden" name="serviceJournalId" value="{{$serviceJournalId}}"/>
                    <div class="form-row">
                        <label for="doc" class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.client.path')</label>
                        <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3">
                            <input type="file" name="doc" />
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="docName" class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.all.name')</label>
                        <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3 modalDocName">
                            <select name="docName" id="docName" class="select2">
                                @foreach($serviceStepRequiredDocumentList->sortBy('document_number')->all() as $serviceStepRequiredDocument)
                                    <option value="{{$serviceStepRequiredDocument->serviceRequiredDocument->description}}">
                                        {{$serviceStepRequiredDocument->serviceRequiredDocument->description}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <button type="submit" class="btn btn-success">
                                @lang('messages.client.upload')
                            </button>
                        </div>
                    </div>
                </form>
