@extends('layouts.app')
@section('title', 'Users')
@section('content')
<h1>Users</h1>
<div class="row justify-content-center my-5">
    <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>email</th>
                        <th>Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th>{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <ol>
                                @forelse($user->tasks as $task)
                                <li>{{$task->title}}</li>
                                @empty
                                <li class="text-danger">There are no tasks to list!</li>
                                @endforelse
                            </ol>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users}}
    </div>
</div>

@endsection