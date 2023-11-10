@extends('layout')
@section('content')
    <div>
        {{ __('Service :id:', [ 'id' => $service->id ]) }}
        {{ $service->name }}
    </div>
@endsection