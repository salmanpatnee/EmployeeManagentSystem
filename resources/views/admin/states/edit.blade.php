@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Edit State</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/employees">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('states.index') }}">All States</a></li>
        <li class="breadcrumb-item active">Edit State</li>
    </ol>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit State') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('states.update', $state->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row mb-3">
                                <label for="country_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <select id="country_id" class="form-control @error('country_id') is-invalid @enderror"
                                        name="country_id" autofocus required>
                                        <option>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option
                                                {{ old('country_id', $state->country_id) === $country->id ? 'selected' : '' }}
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('State Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $state->name) }}" required>

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
                                        {{ __('Update State') }}
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
