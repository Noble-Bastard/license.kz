@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.client.personal_area')
                </h1>
                <div class="row mb-5 justify-content-center align-items-center">
                    <div class="col-12 col-md-10">
                        <div class="row">
                            <div class="col-12 col-md-3 mb-3 text-center text-md-left">
                                <a href="#" class="uploadphotomodalopen">
                                    @if($profile->photo_id !=null)
                                        <img src="/storage_/{{$profile->photo_path}}" class="profile-photo rounded-circle">
                                    @else
                                        <img src="{{asset('images/nophoto.png')}}" class="profile-photo rounded-circle">
                                    @endif
                                </a>
                            </div>
                            <div class="col-12 col-md-5 text-center text-md-left">
                                @include('components.descriptionWithLabel', ['label' => ($profile->profile_state_type_id  == \App\Data\Helper\ProfileStateTypeList::LegalPerson) ? trans('messages.all.company_name') : trans('messages.all.full_name'),
                                    'description' => $profile->user_name])
                                @include('components.descriptionWithLabel', ['label' => trans('messages.all.status'), 'description' => $profile->profile_state_type_name])
                                @include('components.descriptionWithLabel', ['label' => trans('messages.all.nationality'), 'description' => $profile->is_resident==1? trans('messages.all.resident'):trans('messages.all.non_resident')])
                            </div>
                            <div class="col-12 col-md-4 text-center text-md-left">
                                @include('components.descriptionWithLabel', ['label' => 'Email', 'description' => $profile->email])
                                @include('components.descriptionWithLabel', ['label' => trans('messages.all.phone'), 'description' => $profile->phone])
                                @if($profile->profile_state_type_id ==  \App\Data\Helper\ProfileStateTypeList::Idividual)
                                    @include('components.messageManagerClientBtn', ['messageCnt' => $messageCnt])
                                @endif
                            </div>
                            @if($profile->profile_state_type_id ==  \App\Data\Helper\ProfileStateTypeList::LegalPerson)
                                <div class="col-12 col-md-3 text-center text-md-left"></div>
                                <div class="col-12 col-md-5 text-center text-md-left">
                                    @include('components.descriptionWithLabel', ['label' => trans('messages.all.BIN'), 'description' => $profile->business_identification_number])
                                    @include('components.descriptionWithLabel', ['label' => $profile->profile_state_type_id == 1 ? trans("messages.all.bik") : trans("messages.all.iik"), 'description' => $profile->bank_code])
                                    @include('components.descriptionWithLabel', ['label' => trans('messages.all.director_name'), 'description' => $profile->director_name])
                                    @include('components.descriptionWithLabel', ['label' => trans('messages.all.legal_address'), 'description' => $profile->legal_address])
                                </div>
                                <div class="col-12 col-md-4 text-center text-md-left">
                                    @include('components.descriptionWithLabel', ['label' => trans('messages.all.activity'), 'description' => $profile->scope_activity])
                                    @include('components.descriptionWithLabel', ['label' => trans('messages.all.contact_person'), 'description' => $profile->contact_person])
                                    @include('components.descriptionWithLabel', ['label' => trans('messages.all.position'), 'description' => $profile->position])
                                    @include('components.messageManagerClientBtn', ['messageCnt' => $messageCnt])
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadphoto" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.client.upload_photo')</h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="{{route('profile.photo.add')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-row mb-3">
                            <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input" name="photo" id="photo"
                                       aria-describedby="fileHelp">
                                <label class="custom-file-label" for="photo">
                                    @lang('messages.client.path')
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-sm-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    @lang('messages.client.upload')
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
        //activeTab('profile');

        $(function () {
            $(document).on('click', '.uploadphotomodalopen', function (e) {
                var modal = $('#uploadphoto');
                modal.modal('show');
            });

            $(document).on('click', '.delete-document', function (e) {
                var elm = $(this);
                $.ajax({
                    type: 'get',
                    url: 'profile/deleteDocument/' + elm.data('documentid'),
                    success: function (data) {
                        $(elm.parents('.donwloadDocument')[0]).remove();
                    }
                });
            });
        });


    </script>

@endsection
