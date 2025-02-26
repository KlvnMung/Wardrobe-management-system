<?php

namespace App\Http\Controllers;

use App\Models\Stylist;
use Illuminate\Http\Request;

class StylistController extends Controller
{
    public function index()
    {
        $stylists = Stylist::all();
        return response()->json($stylists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:stylists',
        ]);

        $stylist = Stylist::create($request->all());
        return response()->json($stylist, 201);
    }

    public function show(Stylist $stylist)
    {
        return response()->json($stylist);
    }

    public function update(Request $request, Stylist $stylist)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:stylists,email,' . $stylist->id,
        ]);

        $stylist->update($request->all());
        return response()->json($stylist);
    }

    public function destroy(Stylist $stylist)
    {
        $stylist->delete();
        return response()->json(null, 204);
    }
}
