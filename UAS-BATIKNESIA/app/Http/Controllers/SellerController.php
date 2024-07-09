<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Seller Management';
        $sellers = Penjual::paginate(10); // You can adjust the pagination as needed
        return view('backpage.seller', compact('title', 'sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = 'Add New Seller';
        return view('backpage.inputseller', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'nama_penjual' => 'required',
        'deskripsi_penjual' => 'required',
        'kontak' => 'required',
        'alamat' => 'required',
        'logo_penjual' => 'required|image|mimes:png,jpg|max:2048',
    ]);

    try {
        $file = $request->file('logo_penjual');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('photos/logo', $fileName, 'public');

        $validasi = $request->except('logo_penjual');
        $validasi['logo_penjual'] = $path;

        Penjual::create($validasi);

        return redirect('seller')->with('success', 'Seller added successfully!');
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
        $title = 'Edit Seller';
        $seller = Penjual::findOrFail($id);
        return view('backpage.inputseller', compact('title', 'seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validasi = $request->validate([
            'nama_penjual' => 'required',
            'deskripsi_penjual' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'logo_penjual' => '',
        ]);

        try {
            if ($request->hasFile('logo_penjual')) {
                $file = $request->file('logo_penjual');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('photos/logo', $fileName, 'public');
                $validasi['logo_penjual'] = $path;
            }
            Penjual::find($id)->update($validasi);
            return redirect('seller');
    
        } catch (\Exception $e) {
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
            $sellers=Penjual::find($id);
            $sellers->delete();
            return redirect('seller');
        }   catch (\Throwable $e) {
                echo $e->getMessage();
            }
    }
}
