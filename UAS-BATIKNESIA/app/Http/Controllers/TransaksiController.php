<?php

namespace App\Http\Controllers;

use App\Models\Kemeja;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Transaksi Management';
        $transaksis = Transaksi::paginate(10); // You can adjust the pagination as needed
        $produk = Kemeja::all(); // You can adjust the pagination as needed
        return view('backpage.transaksi', compact('title', 'transaksis', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = 'Add New Transaksi';
        return view('backpage.inputTransaksi', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validasi = $request->validate([
            'id_kemeja' => 'required',
            'nama_pelanggan' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);
    
        try {
            Transaksi::create($validasi);
            return redirect('transaksi')->with('success', 'transaksi added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add seller: ' . $e->getMessage());
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
        $title = 'Edit Transaksi';
        $transaksi = Transaksi::findOrFail($id);
        $kemejas = Kemeja::all();
        return view('backpage.inputTransaksi', compact('title', 'transaksi', 'kemejas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validasi = $request->validate([
            'id_kemeja' => 'required',
            'nama_pelanggan' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);
        try {
            Transaksi::find($id)->update($validasi);
            return redirect('transaksi')->with('success', 'Transaksi updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $transaksi=Transaksi::find($id);
            $transaksi->delete();
            return redirect('transaksi');
        }   catch (\Throwable $e) {
                echo $e->getMessage();
            }
    }
}
