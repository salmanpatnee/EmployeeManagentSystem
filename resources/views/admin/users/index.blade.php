@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
    <div class="container">

        <form class="row row-cols-lg-auto g-3 align-items-center mb-3" action="{{ route('users.index') }}">
            <div class="col-12">
                <input type="search" name="search" class="form-control" placeholder="Search users">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Users') }}
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
                                        <th scope="col">First name</th>
                                        <th scope="col">Last name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @can('update', $user)
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endcan

                                                @can('delete', $user)
                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button href="{{ route('users.destroy', $user->id) }}"
                                                            class="btn btn-link text-danger">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-primary" role="alert">
                                            No users!
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
