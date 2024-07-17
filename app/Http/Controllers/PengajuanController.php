<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil role pengguna yang sedang login
        $user = auth()->user();
        $pengguna = Pengguna::where('email', $user->email)->first();

        // Query untuk daftar pengajuan
        $query = Pengajuan::where('status_pengajuan', 'diproses');

        // Jika pengguna adalah admin, batasi pengajuan berdasarkan id_pengguna yang sedang login
        if ($user->role == 'admin') {
            $query->where('pengguna_id', $pengguna->id);
        }

        // Query untuk pencarian
        $query->when($request->input('search'), function ($query, $search) {
            $query->where('jenis_pengajuan', 'like', '%' . $search . '%')
                ->orWhereHas('barang', function ($query) use ($search) {
                    $query->where('kode_barang', 'like', '%' . $search . '%')
                        ->orWhere('nama_barang', 'like', '%' . $search . '%');
                })
                ->orWhereHas('pengguna', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
        });

        // Urutkan berdasarkan tanggal pengajuan terbaru
        $query->orderBy('created_at', 'desc');

        // Ambil data dengan paginasi
        $daftarPengajuan = $query->paginate(5);

        return view('admin.pengajuan.daftar-pengajuan', compact('daftarPengajuan'));
    }


    public function riwayat(Request $request)
    {
        // Ambil role pengguna yang sedang login
        $user = auth()->user();
        $pengguna = Pengguna::where('email', $user->email)->first();

        // Query untuk daftar pengajuan
        $query = Pengajuan::query();

        // Tambahkan kondisi untuk status 'disetujui' dan 'ditolak'
        $query->whereIn('status_pengajuan', ['disetujui', 'ditolak']);

        // Jika pengguna adalah admin, batasi pengajuan berdasarkan id_pengguna yang sedang login
        if ($user->role == 'admin') {
            $query->where('pengguna_id', $pengguna->id);
        }

        // Query untuk pencarian
        $query->when($request->input('search'), function ($query, $search) {
            $query->where('jenis_pengajuan', 'like', '%' . $search . '%')
                ->orWhere('status_pengajuan', 'like', '%' . $search . '%')
                ->orWhereHas('barang', function ($query) use ($search) {
                    $query->where('kode_barang', 'like', '%' . $search . '%')
                        ->orWhere('nama_barang', 'like', '%' . $search . '%');
                })
                ->orWhereHas('pengguna', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });

        // Urutkan berdasarkan tanggal pengajuan terbaru
        $query->orderBy('created_at', 'desc');

        // Ambil data dengan paginasi
        $riwayatPengajuan = $query->paginate(5);

        return view('admin.pengajuan.riwayat-pengajuan', compact('riwayatPengajuan'));
    }

    public function terimaPengajuan(Pengajuan $pengajuan) {
        $pengajuan->status_pengajuan = 'disetujui';
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan Telah Disetujui');
    }

    public function tolakPengajuan(Pengajuan $pengajuan) {
        $pengajuan->status_pengajuan = 'ditolak';
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('error', 'Pengajuan Telah Ditolak');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengajuanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengajuanRequest $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
