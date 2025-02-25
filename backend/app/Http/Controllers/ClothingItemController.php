<?php

namespace App\Http\Controllers;

use App\Models\ClothingItem;
use Illuminate\Http\Request;

class ClothingItemController extends Controller
{
    public function index()
    {
        return ClothingItem::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        $clothingItem = ClothingItem::create($validatedData);

        return response()->json($clothingItem, 201);
    }

    public function show(ClothingItem $clothingItem)
    {
        return $clothingItem;
    }

    public function update(Request $request, ClothingItem $clothingItem)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        $clothingItem->update($validatedData);

        return response()->json($clothingItem, 200);
    }

    public function destroy(ClothingItem $clothingItem)
    {
        $clothingItem->delete();

        return response()->noContent();
    }
}
