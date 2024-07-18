<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $daftarPengguna = Pengguna::when($request->input('search'), function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('nomor_telepon', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.pengguna.daftar-pengguna', compact('daftarPengguna'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $pengguna = Pengguna::where('email', $user->email)->first();

        //Validasi Data
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nomor_telepon' => 'required|string',
            'password' => 'required|string',
        ]);

        //Perbarui data Pengugna
        $pengguna->update($validatedData);

        return redirect()->back()->with('success', 'Profil Berhasil diPerbarui');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengguna.tambah-pengguna');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenggunaRequest $request)
    {
        // Validasi data input
        $validatedData = $request->validated();

        //simpan data ke database
        Pengguna::create($validatedData);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna Baru berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        return view('admin.pengguna.update-pengguna', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenggunaRequest $request, Pengguna $pengguna)
    {
        // Validasi data input
        $validatedData = $request->validated();

        // Perbarui data pengguna
        $pengguna->update($validatedData);

        // Redirect ke index pengguna dengan pesan sukses
        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Akun Pengguna Berhasil Dihapus');
    }
}
