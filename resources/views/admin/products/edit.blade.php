@extends('admin.master')
@section('title' , 'Edit Product | ' . env('APP_NAME'))
@section('content')
 <!-- Page Heading -->
 <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Products</h1>
    <a class="btn btn-info" href="{{ route('admin.products.index') }}">All Products</a>
 </div>

<div class="container">
    <form action="{{ route('admin.products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.products.form')
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
