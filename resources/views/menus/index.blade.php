@extends('layouts.master')
@section('title', 'List Menu')
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

    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-10">
                        <h2>Menu List</h2>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{ route('menus.create') }}" class="btn btn-success">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                            <span>Add New Menu</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Rekomendasi</th>
                        <th>Harga</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $menu)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $menu->id }}</td>
                            <td><a href="{{ route('menus.show', $menu->id) }}"> {{ $menu->nama }}</a></td>
                            <td>{{ $menu->rekomendasi }}</td>
                            <td>{{ $menu->harga }}</td>
                            <td><a href="{{ route('menus.edit', $menu->id) }}">
                                <button type="submit" class="btn btn-light ml-3"  >
                                . . .
                            </button></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">No data yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


@endsection
