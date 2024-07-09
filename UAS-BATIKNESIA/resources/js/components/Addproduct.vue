<template>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="kode_produk">Kode Produk:</label>
          <input v-model="formData.kode_produk" type="text" id="kode_produk" required />
        </div>
        <div>
          <label for="nama_produk">Nama Produk:</label>
          <input v-model="formData.nama_produk" type="text" id="nama_produk" required />
        </div>
        <div>
          <label for="desk_produk">Deskripsi Produk:</label>
          <textarea v-model="formData.desk_produk" id="desk_produk" required></textarea>
        </div>
        <div>
          <label for="img_produk">Gambar Produk:</label>
          <input type="file" @change="handleFileChange" id="img_produk" accept="image/png, image/jpeg" required />
        </div>
        <div>
          <label for="id_seller">ID Seller:</label>
          <input v-model="formData.id_seller" type="text" id="id_seller" required />
        </div>
        <button type="submit">Tambah Produk</button>
      </form>
    </div>
  </template>
  
  <script>
export default {
  data() {
    return {
      formData: {
        kode_produk: '',
        nama_produk: '',
        desk_produk: '',
        img_produk: null,
        id_seller: '',
      },
    };
  },
  methods: {
    handleFileChange(event) {
      this.formData.img_produk = event.target.files[0];
    },
    submitForm() {
      const formData = new FormData();
      for (const key in this.formData) {
        formData.append(key, this.formData[key]);
      }

      // You may need to adjust the URL based on your backend route
      const apiUrl = '/api/kemeja';

      axios.post(apiUrl, formData)
        .then(response => {
          console.log(response.data);
          // Handle success, e.g., show a success message to the user

          // Assuming you have a Vue Router instance in your project
          // and 'product' is the name of the route you want to navigate to
          this.$router.push({ name: 'product' });
        })
        .catch(error => {
          console.error(error.response.data);
          // Handle error, e.g., show an error message to the user
        });
    },
  },
};
</script>