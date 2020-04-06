@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">My Profile</div>

        <div class="card-body">
            @include('partials.errors')
            <form action="{{route('users.update-profile')}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" class="form-control" cols="5" rows="5">{{$user->about}}</textarea>
                
                </div>

                <div class="form-group">
                    <button  class="btn btn-success" type="submit">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection
