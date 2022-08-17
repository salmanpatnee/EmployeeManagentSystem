@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Countries</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/employees">Dashboard</a></li>
        <li class="breadcrumb-item active">Countries</li>
    </ol>
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <form class="row row-cols-lg-auto g-3 align-items-center mb-3" action="{{ route('countries.index') }}">
                    <div class="col-12">
                        <input type="search" name="search" class="form-control" placeholder="Search countries">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('create', App\Models\Country::class)
                    <a class="btn btn-primary float-end" href="{{ route('countries.create') }}">Add country</a>
                @endcan
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Countries') }}
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
                                        <th scope="col">Country code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($countries as $country)
                                        <tr>
                                            <th scope="row">{{ $country->id }}</th>
                                            <td>{{ $country->country_code }}</td>
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                @can('update', $country)
                                                    <a href="{{ route('countries.edit', $country->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endcan

                                                @can('delete', $country)
                                                    <form method="POST" action="{{ route('countries.destroy', $country->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button href="{{ route('countries.destroy', $country->id) }}"
                                                            class="btn btn-link text-danger">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-primary" role="alert">
                                            No countries!
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                {{ $countries->links() }}
            </div>
        </div>
    </div>
@endsection
