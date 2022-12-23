@extends('layouts.master')
@section('title', 'Main Page')
@push('css_after')
    <style>
        td {
            max-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-6 col-md-4 mb-3 mx-auto">
            <div class="card card-rounded">
                <div class="card-body d-flex flex-column text-center">
                    <p class="card-text mb-auto" class="text-center">Total Menu</p>
                    <p class="card-header mt-3 mb-0">{{ $allmenu }}</p>
                    <a class="btn btn-primary" href="{{ route('menus.index') }}">List Menu</a>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 mb-3 mx-auto">
            <div class="card card-rounded">
                <div class="card-body d-flex flex-column text-center">
                    <p class="card-text mb-auto" class="text-center">Total Order</p>
                    <p class="card-header mt-3 mb-0">{{ $allorder }}</p>
                    <a class="btn btn-primary" href="{{ route('order.index') }}">List Order</a>
                </div>
            </div>
        </div>
    </div>
@endsection
