<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::search(request('search'))
            ->paginate(10)
            ->withQueryString();

        return view('pages.item.index', compact('items'));
    }

    public function create()
    {
        // Menampilkan form tambah
    }

    public function store(Request $request)
    {
        // Menyimpan Item
    }

    public function edit(Item $item)
    {
        // Menampilkan form edit
    }

    public function update(Request $request, Item $item)
    {
        // Mengupdate Item
    }

    public function destroy(Item $item)
    {
        // Menghapus Item
    }
}
