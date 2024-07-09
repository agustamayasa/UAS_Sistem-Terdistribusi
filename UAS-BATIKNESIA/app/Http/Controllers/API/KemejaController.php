<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kemeja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KemejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Kemeja::getKemeja()->get();
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
            'kode_kemeja' => 'required|max:255',
            'nama_kemeja' => 'required|max:255',
            'deskripsi_kemeja' => 'required',
            'harga' => 'required|numeric',
            'gambar_kemeja' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'id_penjual' => 'required|exists:penjual,id_penjual'
        ]);
    
        DB::beginTransaction();
    
        try {
            $file = $request->file('gambar_kemeja');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('photos/kemeja', $fileName, 'public');
            $validasi['gambar_kemeja'] = $path;
    
            $kemeja = Kemeja::create($validasi);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Data Kemeja Batik berhasil ditambahkan.',
                'data' => $kemeja
            ], 200);
        } 
        catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan kemeja.',
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
            'kode_kemeja' => 'required|max:255',
            'nama_kemeja' => 'required|max:255',
            'deskripsi_kemeja' => 'required',
            'harga' => 'required|numeric',
            'gambar_kemeja' => 'file|mimes:png,jpg,jpeg|max:2048',
            'id_penjual' => 'required|exists:penjual,id_penjual'
        ]);
    
        DB::beginTransaction();
    
        try {
            $kemeja = Kemeja::where('id_kemeja', $id)->firstOrFail();
    
            if ($request->hasFile('gambar_kemeja')) {
                // Delete the old image if it exists
                if ($kemeja->gambar_kemeja) {
                    Storage::disk('public')->delete($kemeja->gambar_kemeja);
                }
    
                // Store the new image
                $file = $request->file('gambar_kemeja');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('photos/kemeja', $fileName, 'public');
                $validasi['gambar_kemeja'] = $path;
            }
    
            $kemeja->update($validasi);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Data Kemeja berhasil diperbarui.',
                'data' => $kemeja
            ]);
        } 
        catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui kemeja.',
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
            $kemeja = Kemeja::find($id);
            $kemeja->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Kemeja Berhasil Dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ]);
        }
    }
}
