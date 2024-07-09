<?php

namespace App\Http\Controllers;

use App\Models\Kemeja;
use App\Models\Penjual;
use Illuminate\Http\Request;

class BatikAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tittle = 'Admin Batik';
        $produk = Kemeja::paginate(2);
        $produk = new Kemeja;
        if (isset($_GET['s'])) {
            $s=$_GET['s'];

            $produk = $produk->where('nama_kemeja', 'like', "%$s%");
        }
        if (isset($_GET['id_penjual'])&&$_GET['id_penjual']!='') {

            $produk = $produk->where('id_penjual', 'like', $_GET['id_penjual']);
        }

        $produk = $produk->paginate(10);
        $seller = Penjual::all();
        //dd($produk);
        return view('backpage.adminBatik', compact('tittle', 'produk', 'seller'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tittle = 'input Page';
        $seller = Penjual::all();
        return view('backpage.inputproduk', compact('tittle', 'seller'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validasi = $request->validate([
            'kode_kemeja'=>'required',
            'nama_kemeja'=>'required',
            'deskripsi_kemeja'=>'required',
            'harga' => 'required|numeric',
            'gambar_kemeja'=> 'required|image|mimes:png,jpg|max:2048',
            'id_penjual'=>'required',

        ],);
        try{
            $file = $request->file('gambar_kemeja');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('photos/kemeja', $fileName, 'public');
            $validasi['gambar_kemeja'] = $path;
            Kemeja::create($validasi);
            return redirect('batik');

        } catch (\Exception $e){
            echo $e->getMessage();
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
        $tittle = 'Edit Page';
        $seller = Penjual::all();
        $produk = Kemeja::find($id);
        return view('backpage.inputproduk', compact('tittle', 'seller', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validasi = $request->validate([
            'kode_kemeja'=>'required',
            'nama_kemeja'=>'required',
            'deskripsi_kemeja'=>'required',
            'harga' => 'required',
            'gambar_kemeja'=> '',
            'id_penjual'=>'required',

        ],);
        try{
            if ($request->hasFile('gambar_kemeja')) {
                $file = $request->file('gambar_kemeja');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('photos/kemeja', $fileName, 'public');
                $validasi['gambar_kemeja'] = $path;
            }
            Kemeja::find($id)->update($validasi);
            return redirect('batik');

        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $produk=Kemeja::find($id);
            $produk->delete();
            return redirect('batik');
        }   catch (\Throwable $e) {
                echo $e->getMessage();
            }
    }
}
