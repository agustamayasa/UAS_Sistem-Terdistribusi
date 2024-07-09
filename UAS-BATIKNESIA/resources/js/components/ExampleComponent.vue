<template>

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
    // Ganti URL sesuai dengan endpoint API produk Anda
    const response = await axios.get('/api/kemeja');
    this.products = response.data.data; // Sesuaikan dengan struktur respons API

    // Tambahkan log untuk memeriksa data yang diterima
    console.log('Data Produk:', this.products);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
},

    },
  };
  </script>
  