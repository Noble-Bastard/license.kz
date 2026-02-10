@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <user-list
                :initial-role-type-list="{{$roleTypeList}}"
                :role-list-prop="{{$roleList}}"
                :manager-list-prop="{{$managerList}}"
                :company-profile-address-list-prop="{{$companyProfileAddressList}}"
                :city-list-prop="{{$cityList}}"
        ></user-list>
    </div>
@endsection


@section('js')
    <script>
        //activeTab('user-list');
    </script>
@endsection