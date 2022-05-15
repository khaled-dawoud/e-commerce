@extends('admin.master')
@section('title' , 'Create Category | ' . env('APP_NAME'))
@section('content')
 <!-- Page Heading -->
 <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
    <a class="btn btn-info" href="{{ route('admin.categories.index') }}">All Categories</a>
 </div>

@include('admin.parts.errors')

<div class="container">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label>Parent</label>
                <select  name="parent_id" class="form-control">
                    <option value="" selected disabled>--select--</option>
                    @foreach (  $categories as $item )
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success px-5" >Save</button>
        </form>

</div>
@stop