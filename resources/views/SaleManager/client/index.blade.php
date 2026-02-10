@extends('new.layouts.app')

@section('content')
    <salemanager-client-list :agent-list-prop="{{$agentList}}"></salemanager-client-list>
@endsection


@section('js')
    <script>
        //activeTab('client-list');
    </script>
@endsection