@extends('layouts.app')
@section('title', 'Registartion')
@section('content')
<h1>New User</h1>
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
                <h5 class="card-title">Registration</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection