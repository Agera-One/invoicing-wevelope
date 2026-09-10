<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Services\GenerateCodeServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest('id')->paginate(10);

        return view('pages.customer.index', compact('customers'));
    }

    public function create(GenerateCodeServices $codeGenerator)
    {
        $code = $codeGenerator->generate(
            Customer::class,
            'customer_code',
            'CUST'
        );

        return view('pages.customer.add', compact('code'));
    }

    public function store(Request $request, GenerateCodeServices $codeGenerator)
    {
        $code = $codeGenerator->generate(
            Customer::class,
            'customer_code',
            'CUST'
        );

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|string|max:320|unique:customers,email',
            'phone'     => 'required|string|max:20|unique:customers,phone',
            'address'   => 'required'
        ], [
            'email.unique' => 'Email already exists.',
            'phone.unique' => 'Phone number already exists.',
        ]);

        Customer::create([
            'customer_code' => $code,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'company_id'    => Auth::user()->company_id,
        ]);

        return redirect()->route('customer.index');
    }

    public function edit(Customer $customer)
    {
        return view('pages.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => [
                'required',
                'email',
                'string',
                'max:320',
                Rule::unique('customers', 'email')->ignore($customer->id),
            ],
            'phone'     => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers', 'phone')->ignore($customer->id),
            ],
            'address'   => 'required'
        ], [
            'email.unique' => 'Email already exists.',
            'phone.unique' => 'Phone number already exists.',
        ]);

        $customer->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        return redirect()->route('customer.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index');
    }
}
