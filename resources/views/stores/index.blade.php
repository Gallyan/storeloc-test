@extends('layout')
@section('content')
    <div>
        {{ __('Liste des stores:') }}
        <ul>
        @forelse( $stores as $store )
            <li><a href="{{ route('stores.show',$store->id) }}">{{ __($store->name) }}</a></li>
        @empty
            {{ __('Aucun store') }}
        @endforelse
        </ul>
    </div>
@endsection