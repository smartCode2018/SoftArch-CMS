@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{route('posts.create')}}" class="btn btn-success mb-2">Add Post</a> 
    </div>

    <div class="card card-default">
            <div class="card-header">
                Posts
            </div>
            <div class="card-body">
                @if($posts->count() > 0)
                <table class="table">
                        <thead>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <img src="{{asset('storage/'.$post->image)}}" style="height:60px; width:100px;">
                                    </td>
                                    <td>{{$post->name}}</td>
                                    <td>
                                            <a href="{{route('categories.edit', $post->category_id)}}">
                                                {{$post->category->name}}
                                            </a>
                                        
                                    </td>
                                    <td>
                                        @if($post->trashed())
                                            <form action="{{route('post.restore', $post->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                            </form>
                                            
                                        @else
                                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        @endif
                                        
                                    </td>
                                    
                                    <td>
                                        <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            
                                            {{$post->trashed() ? 'Delete' : 'Trash'}}
    
                                        </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <h3 class="text-center">No post to display at the moment</h3>
                @endif
            </div>
        </div>
@endsection