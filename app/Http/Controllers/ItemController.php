<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    $items = Item::paginate(10); // Paginate the query results with 10 items per page

    return view('items.index', compact('items'));
    /**
     * Show the form for creating a new item.
     *
     * @return \Illuminate\Http\Response
     */
    }
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
{
    $validatedData = $request->validate([
        'item_name' => 'required|string',
        'item_description' => 'nullable|string',
        'item_price' => 'required|numeric',
        'item_stock_quantity' => 'required|numeric',
    ]);

    Item::create($validatedData);

    return redirect()->route('items.index')->with('success', 'Item has been created!');
}

    /**
     * Show the specified item.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified item.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_name' => 'required',
            'item_description' => 'nullable',
            'item_price' => 'required|numeric',
            
            'item_stock_quantity' => 'required|integer',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
