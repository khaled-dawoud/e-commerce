@extends('admin.master')
@section('title' , 'Create Products | ' . env('APP_NAME'))
@section('content')
 <!-- Page Heading -->
 <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    <a class="btn btn-info" href="{{ route('admin.products.index') }}">All Products</a>

 </div>
 @include('admin.parts.errors')
<div class="container">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.products.form')
            <button class="btn btn-success px-5" >Save</button>
    </form>

</div>
@stop
