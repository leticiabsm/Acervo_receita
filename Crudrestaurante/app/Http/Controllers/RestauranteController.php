<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;

class RestauranteController extends Controller
{
    public function index()
    {
        $restaurantes = Restaurante::all();
        return view('restaurantes.index', compact('restaurantes'));
    }

    public function create()
    {
        return view('restaurantes.create');
    }

    public function store(Request $request)
    {
        Restaurante::create($request->all());
        return redirect()->route('restaurantes.index');
    }

    public function show($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('restaurantes.show', compact('restaurante'));
    }

    public function edit($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('restaurantes.edit', compact('restaurante'));
    }

    public function update(Request $request, $id)
    {
        $restaurante = Restaurante::findOrFail($id);
        $restaurante->update($request->all());
        return redirect()->route('restaurantes.index');
    }

    public function destroy($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        $restaurante->delete();
        return redirect()->route('restaurantes.index');
    }
}
