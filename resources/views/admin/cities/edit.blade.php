@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Edit City</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cities.index') }}">All Cities</a></li>
        <li class="breadcrumb-item active">Edit City</li>
    </ol>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit City') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cities.update', $city->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row mb-3">
                                <label for="state_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <select id="state_id" class="form-control @error('state_id') is-invalid @enderror"
                                        name="state_id" autofocus required>
                                        <option>Select State</option>
                                        @foreach ($states as $state)
                                            <option {{ old('state_id', $city->state_id) === $city->id ? 'selected' : '' }}
                                                value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('City Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $city->name) }}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update City') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
