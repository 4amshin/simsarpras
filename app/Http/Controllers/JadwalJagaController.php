<?php

namespace App\Http\Controllers;

use App\Models\JadwalJaga;
use App\Http\Requests\StoreJadwalJagaRequest;
use App\Http\Requests\UpdateJadwalJagaRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class JadwalJagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jadwalJaga = JadwalJaga::when($request->input('search'), function ($query, $search) {
            $query->where('hari', 'like', '%' . $search . '%')
                ->orWhereHas('pengguna', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
        })->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.jadwal_jaga.daftar-jadwal', compact('jadwalJaga'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $listAdmin = Pengguna::where('role', 'admin')->get();
        return view('admin.jadwal_jaga.tambah-jadwal', compact('listAdmin', 'listHari'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJadwalJagaRequest $request)
    {
        $validatedData = $request->validated();

        JadwalJaga::create($validatedData);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalJaga $jadwalJaga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalJaga $jadwal)
    {
        $listHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $listAdmin = Pengguna::where('role', 'admin')->get();
        return view('admin.jadwal_jaga.update-jadwal', compact('jadwal', 'listAdmin', 'listHari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalJagaRequest $request, JadwalJaga $jadwal)
    {
        // Validasi data input
        $validatedData = $request->validated();

        // Perbarui data jadwal
        $jadwal->update($validatedData);

        // Redirect ke index jadwal dengan pesan sukses
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal Jaga berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalJaga $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Jaga Berhasil Dihapus');
    }
}
