@extends('layouts.app')

@section('content')
    @include('_partials.messages')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Posts</h4>
                   <div>
                       @if(request()->has('archive'))
                           <a class="btn btn-dark btn-sm" href="{{route('posts')
                    }}">View all posts</a>
                           <a class="btn btn-success btn-sm" href="{{route('posts.restore_all')
                    }}">Restore all </a>
                       @else
                           <a class="text-dark" href="{{route('posts', ['archive'])
                    }}">View archived posts
                           </a>
                       @endif
                   </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
{{--                            <th scope="col">Description</th>--}}
                            <th scope="col">Author</th>
                            <th scope="col">Email</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{ $post->title  }} </td>
{{--                                <td>{{  Str::limit($post->description, 5)   }}</td>--}}
                                @if(isset($post->user))
                                    <td>{{  $post->user->name   }}</td>
                                    <td>{{  $post->user->email   }}</td>
                                    @else
                                    <td class="light">Author of this post is deleted.</td>
                                    <td class="light">Author of this post is deleted.</td>
                                @endif
                                <td class="d-flex">
                                    @if($post->trashed())
                                        <a class="btn btn-success" href="{{route('posts.restore',
                                        $post->id)
                                        }}">Restore</a>

                                        <form  action="{{route('posts.force_delete', $post->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-dark mx-1"
                                                    onclick="return confirm('Are you sure ?')">
                                                Delete forever
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{route('posts.delete', $post->id)}}" method="post">
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
                                No posts yet!
                            </td>
                        @endforelse

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection
