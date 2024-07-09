<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data = Transaksi::all();
        // return response()->json($data);
        $data = Transaksi::getTransaksi();
        return response()->json($data);
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
    public function store(Request $request)
    {
        //
        $validasi = $request->validate([
            'id_kemeja' => 'required|exists:kemeja,id_kemeja',
            'nama_pelanggan' => 'required|max:255',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|',
        ]);

        DB::beginTransaction();

        try {
            $transaksi = Transaksi::create($validasi);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil ditambahkan.',
                'data' => $transaksi
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan transaksi.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validasi = $request->validate([
            'id_kemeja' => 'sometimes|required|exists:kemeja,id_kemeja',
            'nama_pelanggan' => 'sometimes|required|max:255',
            'tanggal' => 'sometimes|required|date',
            'jumlah' => 'sometimes|required|numeric|min:1',
            'total_harga' => 'sometimes|required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update($validasi);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diperbarui.',
                'data' => $transaksi
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui transaksi.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $transaksi = Transaksi::find($id);
            $transaksi->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data transaksi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ]);
        }
    }
}
