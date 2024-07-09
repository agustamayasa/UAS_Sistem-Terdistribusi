<template>
  <div>
    <h2>Edit Kemeja</h2>
    <form @submit.prevent="updateKemeja">
      <label for="kode_produk">Kode Produk:</label>
      <input type="text" v-model="form.kode_produk" required />

      <label for="nama_produk">Nama Produk:</label>
      <input type="text" v-model="form.nama_produk" required />

      <label for="desk_produk">Deskripsi Produk:</label>
      <textarea v-model="form.desk_produk" required></textarea>

      <label for="img_produk">Gambar Produk:</label>
      <input type="file" @change="onFileChange" />

      <label for="id_seller">ID Seller:</label>
      <input type="text" v-model="form.id_seller" required />

      <button type="submit">Update Kemeja</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        kode_produk: '',
        nama_produk: '',
        desk_produk: '',
        img_produk: null,
        id_seller: '',
      },
    };
  },
  mounted() {
    // Fetch existing data before the component is mounted
    this.fetchKemejaData();
  },
  methods: {
    onFileChange(event) {
      this.form.img_produk = event.target.files[0];
    },
    fetchKemejaData() {
      const productId = this.$route.params.id;

      axios
        .get(`/api/kemeja/${productId}`)
        .then(response => {
          const existingData = response.data; // Assuming the API returns the existing data
          this.form = { ...this.form, ...existingData };
        })
        .catch(error => {
          console.error(error.response.data.errors);
        });
    },
    updateKemeja() {
      let formData = new FormData();
      formData.append('kode_produk', this.form.kode_produk);
      formData.append('nama_produk', this.form.nama_produk);
      formData.append('desk_produk', this.form.desk_produk);
      formData.append('img_produk', this.form.img_produk);
      formData.append('id_seller', this.form.id_seller);

      const productId = this.$route.params.id;

      axios
        .put(`/api/kemeja/${productId}`, formData) // Assuming it's a PUT request for updating
        .then(response => {
          console.log(response.data);
          // Handle success, e.g., show a success message
        })
        .catch(error => {
          console.error(error.response.data.errors);
          // Handle error, e.g., show an error message
        });
    },
  },
};
</script>