@extends('layouts.master')

@section('content')
    <h1 class="mt-4">Edit Country</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/employees">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('countries.index') }}">All Countries</a></li>
        <li class="breadcrumb-item active">Edit Country</li>
    </ol>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Country') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('countries.update', $country->id) }}">
                            @csrf
                            @method('PATCh')
                            <div class="row mb-3">
                                <label for="country_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Country Code') }}</label>

                                <div class="col-md-6">
                                    <input id="country_code" type="text"
                                        class="form-control @error('country_code') is-invalid @enderror" name="country_code"
                                        value="{{ old('country_code', $country->country_code) }}" required autofocus>

                                    @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Country Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $country->name) }}" required>

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
                                        {{ __('Update Country') }}
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
