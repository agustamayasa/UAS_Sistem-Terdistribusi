<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Penjual::all();
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
            'nama_penjual' => 'required|max:255',
            'deskripsi_penjual' => 'required',
            'kontak' => 'required|max:255',
            'alamat' => 'required|max:255',
            'logo_penjual' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $file = $request->file('logo_penjual');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('photos/penjual', $fileName, 'public');
            $validasi['logo_penjual'] = $path;

            $penjual = Penjual::create($validasi);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Penjual berhasil ditambahkan.',
                'data' => $penjual
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan penjual.',
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
            'nama_penjual' => 'required|max:255',
            'deskripsi_penjual' => 'required',
            'kontak' => 'required|max:255',
            'alamat' => 'required|max:255',
            'logo_penjual' => 'file|mimes:png,jpg,jpeg|max:2048',
        ]);
    
        DB::beginTransaction();
    
        try {
            $penjual = Penjual::where('id_penjual', $id)->firstOrFail();
    
            if ($request->hasFile('logo_penjual')) {
                // Delete the old logo if it exists
                if ($penjual->logo_penjual) {
                    Storage::disk('public')->delete($penjual->logo_penjual);
                }
    
                // Store the new logo
                $file = $request->file('logo_penjual');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('photos/penjual', $fileName, 'public');
                $validasi['logo_penjual'] = $path;
            }
    
            $penjual->update($validasi);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Penjual berhasil diperbarui.',
                'data' => $penjual
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui penjual.',
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
            $penjual = Penjual::find($id);
            $penjual->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data penjual berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ]);
        }
    }
}
