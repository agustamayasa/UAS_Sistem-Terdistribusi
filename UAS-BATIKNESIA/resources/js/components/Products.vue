<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product List</div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    </div>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products" :key="index"
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.nama_produk }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ product.kode_produk }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ product.desk_produk }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ product.id_seller }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img :src="`/` + product.img_produk" alt="Product Image"
                                            class="w-16 h-16 object-cover rounded">
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="btn-group" role="group">
                                            <router-link :to="{name: 'product.edit', params: { id: product.id_produk }}"
                                                class="btn btn-success">Edit</router-link>
                                            <button
                                                class="px-2 py-1 text-sm rounded text-red-600 border border-red-200 hover:text-white hover:bg-red-600"
                                                @click="deleteData(product.id_produk)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                products: [],
            };
        },
        mounted() {
            this.fetchDataFromApi();
        },
        methods: {
            async fetchDataFromApi() {
                try {
                    const response = await axios.get('http://127.0.0.1:8000/api/kemeja');
                    this.products = response.data.data;
                    console.log('Data Produk:', this.products);
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            },

            deleteData(id) {
                // You may want to show a confirmation dialog here before proceeding

                let uri = `http://127.0.0.1:8000/api/kemeja/${id}`;
                axios
                    .delete(uri)
                    .then(() => {
                        console.log('Product deleted successfully');

                        // Find the index of the deleted product in the array
                        const index = this.products.findIndex(product => product.id_produk === id);

                        // Remove the product from the array using splice
                        if (index !== -1) {
                            this.products.splice(index, 1);
                        }
                    })
                    .catch((error) => {
                        console.error('Error deleting product:', error);
                    });
            },
        },
    };

</script>
