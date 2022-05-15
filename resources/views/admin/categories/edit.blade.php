@extends('admin.master')
@section('title' , 'Edit Category | ' . env('APP_NAME'))
@section('content')
 <!-- Page Heading -->
 <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
    <a class="btn btn-info" href="{{ route('admin.categories.index') }}">All Categories</a>
 </div>

<div class="container">
    <form action="{{ route('admin.categories.update' , $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $category->name }}">
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input id="img-input" type="file" name="image" class="form-control mb-2">
                <img id="img-item" width="70" src="{{ asset('uploads/images/'.$category->image) }}">
            </div>
            <div class="mb-3">

                <label>Parent</label>
                <select  name="parent_id" class="form-control">
                    <option value="" selected disabled>--select--</option>
                    @foreach (  $categories as $item )
                        <option {{ $category->parent_id == $item->id ?'selected': '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                        {{-- tow --}}
                    @endforeach
                </select>
            </div>
            <button class="btn btn-info px-5" >Update</button>
        </form>

</div>
@stop
@section('scripts')
<script>
    document.querySelector('#img-item').onclick = function() {
        document.querySelector('#img-input').click();
    }

    document.getElementById('img-input').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('img-item').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }

        // Not supported
        else {
            // fallback -- perhaps submit the input to an iframe and temporarily store
            // them on the server until the user's session ends.
        }
    }
    </script>
@stop
