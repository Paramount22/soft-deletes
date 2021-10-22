@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8">
            @include('_partials.errors')
            <div class="card">
                <div class="card-header">
                    New post
                </div>
                <div class="card-body">
                    <form action="{{route('posts.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" value="{{old('title')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Title</label>
                            <textarea class="form-control" name="description" id="body" rows="3">{{old('description')}}</textarea>
                        </div>

                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
