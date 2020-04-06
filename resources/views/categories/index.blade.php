@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
    <a href="{{route('categories.create')}}" class="btn btn-success mb-2">Add Category</a> 
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
            <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{$category->name}}
                                </td>

                                <td>
                                    {{$category->posts->count()}}
                                </td>
                                
                                <td>
                                    <button onclick="handleDelete({{$category->id}})" class="btn btn-danger btn-sm float-right">Delete</button>
                                    <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm float-right mr-2">View</a>  
                                    
                                </td>
                            
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No categories to display</h3>
            @endif

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" id="deleteForm" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center"><strong>Are you sure you want to delete this category?</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
    
        const handleDelete = (id)=>{

            $('#deleteModal').modal('show');

            let form = document.querySelector("#deleteForm")
            form.action = '/categories/'+id

            console.log(form);
        }

    </script>
@endsection