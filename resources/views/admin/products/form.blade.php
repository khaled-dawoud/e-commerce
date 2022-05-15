<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $product->name }}">
</div>
<div class="mb-3">
    <label>Image</label>
    <input id="img-input" type="file" name="image" class="form-control mb-2">
    @if ($product->image)
    <img id="img-item" width="70" src="{{ asset('uploads/images/products/'.$product->image) }}">
    @endif
</div>
<div class="mb-3">

    <div class="mb-3">
        <label>Description</label>
        <textarea class="tinytext" class="form-control" placeholder="Description" name="description" >{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}">
    </div>

    <div class="mb-3">
        <label>Sale Price</label>
        <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" value="{{ $product->sale_price }}">
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="{{ $product->quantity }}">
    </div>


    <label>Parent</label>
    <select  name="category_id" class="form-control">
        <option value="" selected disabled>--select--</option>
        @foreach (  $categories as $item )
            <option {{ $product->category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
            {{-- tow --}}
        @endforeach
    </select>
</div>
