<x-admin-layout>
    <div>
        <div>
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Input Data Seller
            </h4>
            <div class="grid gap-6 mb-8">
                <div class="min-w-0 p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Masukkan Data dibawah
                    </h4>
                    <form enctype="multipart/form-data"
                        action="{{(isset($seller)) ? route('seller.update', $seller->id_penjual) : route('seller.store')}}"
                        method="POST">
                        @csrf
                        @if(isset($seller)) @method('PUT') @endif
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <div class="mb-6">
                                    <label for="nama_penjual"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Seller</label>
                                    <input type="text" id="nama_penjual" name="nama_penjual"
                                        value="{{(isset($seller)) ? $seller->nama_penjual : old('nama_penjual')}}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @error('nama_penjual')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mb-6">
                                    <label for="deskripsi_penjual"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Seller</label>
                                    <textarea id="deskripsi_penjual" name="deskripsi_penjual"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{(isset($seller)) ? $seller->deskripsi_penjual : old('deskripsi_penjual')}}</textarea>
                                    @error('deskripsi_penjual')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="kontak"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kontak Seller</label>
                            <input type="text" id="kontak" name="kontak"
                                value="{{(isset($seller)) ? $seller->kontak : old('kontak')}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('kontak')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="alamat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Seller</label>
                            <input type="text" id="alamat" name="alamat"
                                value="{{(isset($seller)) ? $seller->alamat : old('alamat')}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('alamat')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="logo_penjual"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo Seller</label>
                            <input type="file" id="logo_penjual" name="logo_penjual"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('logo_penjual')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
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
</x-admin-layout>
