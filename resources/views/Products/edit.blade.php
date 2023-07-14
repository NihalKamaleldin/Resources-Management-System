@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Edit Product
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Product Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">Uplaod a photo in JPG or PNG that is no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('product_image') is-invalid @enderror" type="file"  id="image" name="product_image" accept="image/*" onchange="previewImage();">
                        @error('product_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="product_name">Product name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('product_name') is-invalid @enderror" id="product_name" name="product_name" type="text" placeholder="" value="{{ old('product_name', $product->product_name) }}" autocomplete="off"/>
                            @error('product_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
        
                             <!-- Form Group Items that belongs to this product-->
                        <div class="row gx-3 mb-3">
                        <div class="form-group">
                            <label for="items">Select Items:</label>
                            <select class="form-control" name="items[]" id= "items" multiple>
                            <option value=" ">Select Items</option>
                            @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                             @endforeach
                         </select>
                         </div>
                            <!-- Form Group (type of product unit) -->
                           
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (buying price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="buying_price">Price <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('product_price') is-invalid @enderror" id="product_price" name="product_price" type="text" placeholder="" value="{{ old('product_price', $product->product_price) }}" autocomplete="off" />
                                @error('product_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
            
                        </div>
                        <!-- Form Group (stock) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="stock">Stock <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('stock') is-invalid @enderror" id="stock" name="stock" type="text" placeholder="" value="{{ old('stock', $product->stock) }}" autocomplete="off" />
                            @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
