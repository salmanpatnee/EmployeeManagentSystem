@extends('layouts.master')

@section('content')
    <h1 class="mt-4">States</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/employees">Dashboard</a></li>
        <li class="breadcrumb-item active">States</li>
    </ol>
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <form class="row row-cols-lg-auto g-3 align-items-center mb-3" action="{{ route('states.index') }}">
                    <div class="col-12">
                        <input type="search" name="search" class="form-control" placeholder="Search states">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('create', App\Models\State::class)
                    <a class="btn btn-primary float-end" href="{{ route('states.create') }}">Add state</a>
                @endcan
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('States') }}
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
                                        <th scope="col">Country Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($states as $state)
                                        <tr>
                                            <th scope="row">{{ $state->id }}</th>
                                            <td>{{ $state->country->country_code }}</td>
                                            <td>{{ $state->name }}</td>
                                            <td>
                                                @can('update', $state)
                                                    <a href="{{ route('states.edit', $state->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endcan

                                                @can('delete', $state)
                                                    <form method="POST" action="{{ route('states.destroy', $state->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button href="{{ route('states.destroy', $state->id) }}"
                                                            class="btn btn-link text-danger">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-primary" role="alert">
                                            No states!
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                {{ $states->links() }}
            </div>
        </div>
    </div>
@endsection
