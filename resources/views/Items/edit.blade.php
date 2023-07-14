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
                        Add Items
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Item</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->


<!-- BEGIN: Main Page Content -->
<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Item image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Item Image</div>
                    <div class="card-body text-center">
                        <!-- Item image -->
                        <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Item image help block -->
                        <div class="small font-italic text-muted mb-2">Uplaod a photo in JPG or PNG that is no larger than 2 MB</div>
                        <!-- Item image input -->
                        <input class="form-control form-control-solid mb-2 @error('item_image') is-invalid @enderror" type="file"  id="image" name="item_image" accept="image/*" onchange="previewImage();">
                        @error('item_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Item Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Item Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (Item name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="item_name">Item name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('item_name') is-invalid @enderror" id="item_name" name="item_name" type="text" placeholder="" value="{{ old('item_name') }}" autocomplete="off"/>
                            @error('item_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End -- Form Group name of the item-->
                        <!-- Form Row -->
                        <!-- Form Group description of the item-->
                        <div class="row gx-3 mb-3">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="item_description">Description</label>
                           <textarea id="item_description" name="item_description" class="form-control" required></textarea>
                           </div>      
                         </div>  
                         </div>
                         <!-- End -- Form Group description of the item-->
                        <!-- Form Row  -->
                        <div class="row gx-3 mb-3">
                            <!-- Form row Item  Price-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="item_price">Item Price <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('item_price') is-invalid @enderror" id="item_price" name="item_price" type="text" placeholder="" value="{{ old('item_price') }}" autocomplete="off" />
                                @error('item_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (stock) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="item_stock_quantity">Item Stock Quantity <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('item_stock_quantity') is-invalid @enderror" id="item_stock_quantity" name="item_stock_quantity" type="text" placeholder="" value="{{ old('item_stock_quantity') }}" autocomplete="off" />
                            @error('item_stock_quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('items.index') }}">Cancel</a>
                    </div>
                <!-- END: Items Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection