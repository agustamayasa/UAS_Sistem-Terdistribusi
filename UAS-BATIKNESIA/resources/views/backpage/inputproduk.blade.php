<x-admin-layout>
    <div>
        <div>
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Input Data Batik
            </h4>
            <div class="grid gap-6 mb-8 ">
                <div class="min-w-0 p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Masukkan Data dibawah
                    </h4>
                    <form enctype="multipart/form-data"
                        action="{{(isset($produk))?route('batik.update',$produk->id_kemeja):route('batik.store')}}"
                        method="POST">
                        @csrf
                        @if(isset($produk))@method('PUT')@endif
                        <div class="grid grid-cols-2 grid-rows-1 gap-8">
                            <div>
                                <div class="mb-6">
                                    <label for="default-input"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                        Kemeja</label>
                                    <input type="text" id="kode_kemeja" name="kode_kemeja"
                                        value="{{(isset($produk))?$produk->kode_kemeja:old('kode_kemeja')}}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @error('kode_kemeja')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div>
                                <div class="mb-6">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Deskripsi Kemeja
                                    </label>
                                    <textarea id="deskripsi_kemeja" name="deskripsi_kemeja" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        {{ trim((isset($produk)) ? $produk->deskripsi_kemeja : old('deskripsi_kemeja')) }}
                                    </textarea>
                                    @error('deskripsi_kemeja')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="default-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Produk</label>
                            <input type="text" id="nama_kemeja" name="nama_kemeja"
                                value="{{(isset($produk))?$produk->nama_kemeja:old('nama_kemeja')}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('nama_kemeja')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="gambar_kemeja"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File</label>
                            <input type="file" id="gambar_kemeja" name="gambar_kemeja"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('gambar_kemeja')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="penjual"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penjual atau
                                Seller</label>
                            <select id="seller" name="id_penjual"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($seller as $item)
                                    <option value="{{ $item->id_penjual }}"
                                        {{ (isset($produk) && $produk->id_penjual == $item->id_penjual) || old('id_toko') == $item->id_penjual ? 'selected' : '' }}>
                                        {{ $item->nama_penjual }}
                                    </option>
                                    @endforeach
                            </select>
                            @error('id_penjual')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                            <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div>
                            <div class="mb-6">
                                <label for="default-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                    Produk</label>
                                <input type="text" id="harga" name="harga"
                                    value="{{(isset($produk))?$produk->harga:old('harga')}}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('harga')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-6">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                Save Data
                            </button>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
