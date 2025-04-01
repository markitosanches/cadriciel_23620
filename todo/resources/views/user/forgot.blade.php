@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
<h1>Forgot Password</h1>
<div class="row justify-content-center">
    <div class="col-md-6">
        @if(!$errors->isEmpty())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Forgot Password</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">@lang('Username')</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email')}}">
                    </div>
                    <input type="submit" value="Forgot Password" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection