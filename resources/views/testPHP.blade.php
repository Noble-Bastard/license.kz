{{json_encode(config('database.connections.mysql.options'))}}
{{config('database.connections.mysql.database')}}
{{extension_loaded('pdo_mysql')}}
@php
    $serviceJournal = \App\Data\ServiceJournal\Model\ServiceJournal::with('country')->find(21);
@endphp
{{dd($serviceJournal, $serviceJournal->client_id)}}
