<?php

namespace App\Http\Controllers;

use App\Models\Keluar;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKeluarRequest;
use App\Http\Requests\UpdateKeluarRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-keluar|edit-keluar|show-keluar|delete-keluar', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-keluar', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-keluar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-keluar', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('barangkeluar.index', [
            'barangkeluars' => Keluar::latest()->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('barangkeluar.create');
    }

    public function store(StoreKeluarRequest $request): RedirectResponse
    {
        Keluar::create($request->validated());
        return redirect()->route('barangkeluar.index')
            ->withSuccess('New item is added successfully.');
    }

    public function show(Keluar $barangkeluar): View
    {
        return view('barangkeluar.show', [
            'barangkeluar' => $barangkeluar
        ]);
    }

    public function edit(Keluar $barangkeluar): View
    {
        return view('barangkeluar.edit', [
            'barangkeluar' => $barangkeluar
        ]);
    }

    public function update(UpdateKeluarRequest $request, Keluar $barangkeluar): RedirectResponse
    {
        $barangkeluar->update($request->validated());
        return redirect()->back()
            ->withSuccess('Item updated successfully.');
    }

    public function destroy(Keluar $barangkeluar): RedirectResponse
    {
        $barangkeluar->delete();
        return redirect()->route('barangkeluar.index')
            ->withSuccess('Item deleted successfully.');
    }
}
