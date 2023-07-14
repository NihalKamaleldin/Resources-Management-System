<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    /**
     * Display a listing of the products available
     */
   
    public function index()
    {
        
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $products = Product::with(['items'])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());
      
      
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $items=Item::all();
        
        
        return view('products.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_code = IdGenerator::generate([
            'table' => 'products',
            'field' => 'product_code',
            'length' => 4,
            'prefix' => 'PC'
        ]);

        $rules = [
            'product_image' => 'image|file|max:2048',
            'product_name' => 'required|string',
            'stock' => 'required|integer',
            'product_price' => 'required|integer',
               
        ];

        $validatedData = $request->validate($rules);
        // Save product code value
        $validatedData['product_code'] = $product_code;
        /**
         * Handle upload image
         */
        

        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $validatedData['product_image'] = $fileName;
        }
       
         // Product::create($validatedData); (This was creating two products with the same values)
        //dd($request->input('items')); this line just to test that items are readable in the input form
     
        $product=Product::create($validatedData);

        $product->items()->attach($request->input('items'));
        return Redirect::route('products.index')->with('success', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();

        $barcode = $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128);

        return view('products.show', [
            'product' => $product,
            'barcode' => $barcode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'items' => Item::all(),
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'product_image' => 'image|file|max:2048',
            'product_name' => 'required|string',
            'stock' => 'required|integer',
            'product_price' => 'required|integer',
           
        ];
        $items = $request->input('items');
        $product->items()->sync($items);
        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            /**
             * Delete photo if exists.
             */
            if($product->product_image){
                Storage::delete($path . $product->product_image);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $validatedData['product_image'] = $fileName;
        }

        Product::where('id', $product->id)->update($validatedData);

        return Redirect::route('products.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified product 
     */
    public function destroy(Product $product)
    {
        /**
         * Delete photo if exists.
         */
        if($product->product_image){
            Storage::delete('public/products/' . $product->product_image);
        }

        Product::destroy($product->id);

        return Redirect::route('products.index')->with('success', 'Product has been deleted!');
    }    
        
    }

