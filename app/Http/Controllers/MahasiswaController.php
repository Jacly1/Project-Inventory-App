<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-mahasiswa|edit-mahasiswa|show-mahasiswa|delete-mahasiswa', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-mahasiswa', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-mahasiswa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-mahasiswa', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mahasiswas.index', [
            'mahasiswas' => Mahasiswa::latest()->paginate(3)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mahasiswas.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request): RedirectResponse
    {
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswas.index')
            ->withSuccess('New mahasiswa is added successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswas.show', [
            'mahasiswa' => $mahasiswa
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswas.edit', [
            'mahasiswa' => $mahasiswa
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->update($request->all());
        return redirect()->back()
            ->withSuccess('Mahasiswa is updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')
            ->withSuccess('Mahasiswa is deleted successfully.');
    }
}
