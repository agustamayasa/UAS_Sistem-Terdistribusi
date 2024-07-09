<x-admin-layout>
    <div>
        <div>
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Input Data transaksi
            </h4>
            <div class="grid gap-6 mb-8">
                <div class="min-w-0 p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Masukkan Data dibawah
                    </h4>
                    <form enctype="multipart/form-data"
                        action="{{(isset($transaksi)) ? route('transaksi.update', $transaksi->id_transaksi) : route('transaksi.store')}}"
                        method="POST">
                        @csrf
                        @if(isset($transaksi)) @method('PUT') @endif
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <div class="mb-6">
                                    <label for="id_kemeja"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id Kemeja</label>
                                    <input type="text" id="id_kemeja" name="id_kemeja"
                                        value="{{(isset($transaksi)) ? $transaksi->id_kemeja : old('id_kemeja')}}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @error('id_kemeja')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mb-6">
                                    <label for="nama_pelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nama Pelanggan
                                    </label>
                                    <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ isset($transaksi) ? $transaksi->nama_pelanggan : old('nama_pelanggan') }}">
                                    @error('nama_pelanggan')
                                        <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="tanggal"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tanggal transaksi</label>
                            <input type="date" id="tanggal" name="tanggal"
                                value="{{(isset($transaksi)) ? $transaksi->tanggal : old('tanggal')}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('tanggal')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="jumlah"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Jumlah Kemeja</label>
                            <input type="text" id="jumlah" name="jumlah"
                                value="{{(isset($transaksi)) ? $transaksi->jumlah : old('jumlah')}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('jumlah')
                            <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="total_harga"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">harga transaksi</label>
                            <input type="text" id="total_harga" name="total_harga"
                                value="{{(isset($transaksi)) ? $transaksi->total_harga : old('total_harga')}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('total_harga')
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
