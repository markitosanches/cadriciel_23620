@extends('layouts.app')
@section('title', trans('lang.text_welcome'))
@section('content')
    <div class="row my-5 justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">@lang('lang.text_welcome_title')</h1>
                </div>
                <div class="card-body">
                        @lang('lang.text_welcome_paragraph')
                </div>
                <div class="card-footer text-center">
                        <a href="{{ route('task.index')}}" class="btn btn-primary">@lang('lang.text_welcome_btn')</a>
                </div>
            </div>
        </div>
    </div>
@endsection