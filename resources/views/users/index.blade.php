@extends('layouts.app')

@section('content')
    @include('_partials.messages')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Users</h4>
                    <div>
                        @if(request()->has('archive'))
                            <a class="btn btn-dark btn-sm" href="{{route('users.index')}}">View all users</a>
                            <a class="btn btn-success btn-sm" href="{{route('users.restore_all')}}">Restore all </a>
                        @else
                            <a class="text-dark" href="{{route('users.index', ['archive'])}}">View archived users
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th> 
                            <th scope="col">Email</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{ $user->name  }} </td>
                                <td>{{  $user->email   }}</td>
                                <td class="d-flex">
                                    @if($user->trashed())
                                        <a class="btn btn-success" href="{{route('users.restore', $user->id)
                                        }}">Restore</a>

                                        <form  action="{{route('users.force_delete', $user->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-dark mx-1"
                                                    onclick="return confirm('Are you sure ?')">
                                                Delete forever
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{route('users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <td class="alert alert-secondary" role="alert">
                                No users!
                            </td>
                        @endforelse

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection
