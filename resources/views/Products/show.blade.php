@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Details Product
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Product Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        
                        <img class="img-account-profile mb-2" src="{{ asset('public/products/'.$product->image) }}" alt="" id="image-preview" />
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Code -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Product code</label>
                                <div class="form-control form-control-solid">{{ $product->product_code  }}</div>
                            </div>
                            <!-- Form Group (type of product unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Product Code -->

                <!-- BEGIN: Product Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Information
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1">Product name</label>
                            <div class="form-control form-control-solid">{{ $product->product_name }}</div>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                        
                      <!-- Items for this product  -->
                       <div class="col-md-6">
                       <label class="small mb-1">Product Items</label>
                        <!-- Assuming $items is the variable representing the items related to the product -->
                        <div class="form-control form-control-solid" id="items">
                        @foreach($product->items as $item)
                         {{ $item->item_name }}
                        @endforeach
                      </div>
                    </div>

                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
        
                            <!-- Form Group (product price) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Product price</label>
                                <div class="form-control form-control-solid">{{ $product->product_price  }}</div>
                            </div>
                        </div>
                        <!-- Form Group (stock) -->
                        <div class="mb-3">
                            <label class="small mb-1">Stock</label>
                            <div class="form-control form-control-solid">{{ $product->stock  }}</div>
                        </div>

                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
