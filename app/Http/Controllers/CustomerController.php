<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $customers = Customer::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('customers.index', [
            'customers' => $customers
        ]);
    }

    
    public function create()
    {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email',
            'phone' => 'required|string|max:25|unique:customers,phone',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

      
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/customers/';

            // Store an image to Storage
            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Customer::create($validatedData);

        return Redirect::route('customers.index')->with('success', 'New customer has been created!');
    }

   
    public function show(Customer $customer)
    {
        abort(404);
    }

   
    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

   
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email,'.$customer->id,
            'phone' => 'required|string|max:25|unique:customers,phone,'.$customer->id,
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/customers/';

            /**
             * Delete an image if exists.
             */
            if($customer->photo){
                Storage::delete($path . $customer->photo);
            }

            // Store an image to Storage
            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Customer::where('id', $customer->id)->update($validatedData);

        return Redirect::route('customers.index')->with('success', 'Customer has been updated!');
    }

   
    public function destroy(Customer $customer)
    {
        /**
         * Delete photo if exists.
         */
        if($customer->photo){
            Storage::delete('public/customers/' . $customer->photo);
        }

        Customer::destroy($customer->id);

        return Redirect::route('customers.index')->with('success', 'Customer has been deleted!');
    }
}
