<?php

namespace App\Http\Controllers;

use App\Models\ClothingItem;
use Illuminate\Http\Request;

class ClothingItemController extends Controller
{
    public function index()
    {
        $items = ClothingItem::all();
        return response()->json($items);
    }

    public function create()
    {
        return view('clothing-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
        ]);

        ClothingItem::create($request->all());

        return response()->json(['message' => 'Clothing item created successfully.']);
    }

    public function show(ClothingItem $clothingItem)
    {
        return response()->json($clothingItem);
    }

    public function edit(ClothingItem $clothingItem)
    {
        return view('clothing-items.edit', compact('clothingItem'));
    }

    public function update(Request $request, ClothingItem $clothingItem)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
        ]);

        $clothingItem->update($request->all());

        return response()->json(['message' => 'Clothing item updated successfully.']);
    }

    public function destroy(ClothingItem $clothingItem)
    {
        $clothingItem->delete();

        return response()->json(['message' => 'Clothing item deleted successfully.']);
    }
}
