@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Cities</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Cities</li>
    </ol>
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <form class="row row-cols-lg-auto g-3 align-items-center mb-3" action="{{ route('cities.index') }}">
                    <div class="col-12">
                        <input type="search" name="search" class="form-control" placeholder="Search cities">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('create', App\Models\City::class)
                    <a class="btn btn-primary" href="{{ route('cities.create') }}">Add City</a>
                @endcan
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Cities') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cities as $city)
                                        <tr>
                                            <th scope="row">{{ $city->id }}</th>
                                            <td>{{ $city->state->country->name }}</td>
                                            <td>{{ $city->state->name }}</td>
                                            <td>{{ $city->name }}</td>
                                            <td>
                                                @can('update', $city)
                                                    <a href="{{ route('cities.edit', $city->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endcan

                                                @can('delete', $city)
                                                    <form method="POST" action="{{ route('cities.destroy', $city->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button href="{{ route('cities.destroy', $city->id) }}"
                                                            class="btn btn-link text-danger">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-primary" role="alert">
                                            No cities!
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                {{ $cities->links() }}
            </div>
        </div>
    </div>
@endsection
