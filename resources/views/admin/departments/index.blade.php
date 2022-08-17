@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Department</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Departments</li>
    </ol>
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <form class="row row-cols-lg-auto g-3 align-items-center mb-3" action="{{ route('departments.index') }}">
                    <div class="col-12">
                        <input type="search" name="search" class="form-control" placeholder="Search departments">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @can('create', App\Models\Department::class)
                    <a class="btn btn-primary float-end" href="{{ route('departments.create') }}">Add Department</a>
                @endcan
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Departments') }}
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($departments as $department)
                                        <tr>
                                            <th scope="row">{{ $department->id }}</th>
                                            <td>{{ $department->name }}</td>
                                            <td>
                                                @can('update', $department)
                                                    <a href="{{ route('departments.edit', $department->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endcan

                                                @can('delete', $department)
                                                    <form method="POST"
                                                        action="{{ route('departments.destroy', $department->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button href="{{ route('departments.destroy', $department->id) }}"
                                                            class="btn btn-link text-danger">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-primary" role="alert">
                                            No departments!
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                {{ $departments->links() }}
            </div>
        </div>
    </div>
@endsection
