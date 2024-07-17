<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $daftarBarang = Barang::when($request->input('search'), function ($query, $search) {
            $query->where('kode_barang', 'like', '%' . $search . '%')
                ->orWhere('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('kondisi_barang', 'like', '%' . $search . '%')
                ->orWhere('lokasi_barang', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.barang.daftar-barang', compact('daftarBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.tambah-barang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangRequest $request)
    {
        // Validasi data input
        $validatedData = $request->validated();

        try {
            // Generate kode_barang unik
            $validatedData['kode_barang'] = $this->generateKodeBarang();

            // Simpan data ke database
            Barang::create($validatedData);

            return redirect()->route('barang.index')->with('success', 'Data Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah saat menyimpan data
            return redirect()->back()->withInput()->withErrors(['kode_barang' => 'Kode barang sudah terdaftar.'])->with('error', 'Gagal menambahakan data barang');
        }
    }

    public function pengajuan(Request $request)
{
    // Validasi request
    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jenis_pengajuan' => 'required|in:perbaikan,pergantian',
    ]);

    try {
        // Simpan data pengajuan ke dalam tabel pengajuan
        Pengajuan::create([
            'barang_id' => $request->barang_id,
            'pengguna_id' => auth()->user()->id,
            'tanggal_pengajuan' => now(),
            'jenis_pengajuan' => $request->jenis_pengajuan,
        ]);

        // Respon sukses jika diperlukan
        return response()->json(['success' => 'Pengajuan berhasil disimpan'], 200);
    } catch (\Exception $e) {
        // Tangani error jika terjadi
        return response()->json(['error' => 'Terjadi kesalahan saat menyimpan pengajuan'], 500);
    }
}


    private function generateKodeBarang()
    {
        do {
            // Generate random 5-character alphanumeric string
            $kodeBarang = strtoupper(Str::random(5));
        } while (Barang::where('kode_barang', $kodeBarang)->exists());

        return $kodeBarang;
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('admin.barang.update-barang', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        // Validasi data input
        $validatedData = $request->validated();

        // Perbarui data barang
        $barang->update($validatedData);

        // kembali ke halaman daftar barang
        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Dihapus');
    }
}
