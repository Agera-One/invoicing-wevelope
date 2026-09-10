<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Services\GenerateCodeServices;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest('id')->paginate(10);

        return view('pages.item.index', compact('items'));
    }

    public function create(GenerateCodeServices $codeGenerator)
    {
        $code = $codeGenerator->generate(
            Item::class,
            'ref_no',
            'REF'
        );

        return view('pages.item.add', compact('code'));
    }

    public function store(Request $request, GenerateCodeServices $codeGenerator)
    {
        $code = $codeGenerator->generate(
            Item::class,
            'ref_no',
            'REF'
        );

        $request->validate([
            'name'   => 'required|string|max:255',
            'price'  => 'required|numeric|min:1'
        ]);

        Item::create([
            'ref_no' => $code,
            'name' => $request->name,
            'price' => $request->price,
            'company_id' => Auth::user()->company_id,
        ]);

        return redirect()->route('item.index');
    }

    public function edit(Item $item)
    {
        return view('pages.item.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'price'  => 'required|numeric|min:1'
        ]);

        $item->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('item.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index');
    }
}
