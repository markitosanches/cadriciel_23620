@extends('layouts.app')
@section('title', 'Reset password')
@section('content')
<h1>Reset password</h1>
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
                <h5 class="card-title">Reset password</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="password" class="form-label">@lang('Password')</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="c_password" class="form-label">Confirm @lang('Password')</label>
                        <input type="password" id="c_password" name="password_confirmation" class="form-control">
                    </div>
                    <input type="submit" value="Reset password" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection