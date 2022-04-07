<template>
<div>
  <h4 class="text-center">All Products</h4><br />
  <el-alert title="success alert title" type="success" class="success-message d-none" /><br>
  <el-button type="primary" class="mb-3" @click="this.$router.push('/products/add')">Add Product</el-button>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in products" :key="product.id">
        <td>{{ product.id }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.price }}</td>
        <td>{{ product.status }}</td>
        <td>{{ product.created_at }}</td>
        <td>{{ product.updated_at }}</td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{name: 'editproduct', params: { id: product.id }}" class="btn btn-primary">Edit
            </router-link>
            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
            <button class="btn btn-success" @click="statusProduct(product.id)">Status</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
export default {
  data() {
    return {
      products: []
    }
  },
  created() {
    this.$axios.get('/sanctum/csrf-cookie').then(response => {
      this.$axios.get('/api/products')
        .then(response => {
          this.products = response.data;
        })
        .catch(function (error) {
          console.error(error);
        });
    })
  },
  methods: {
    deleteProduct(id) {
      this.$axios.get('/sanctum/csrf-cookie').then(response => {
        this.$axios.delete(`/api/products/delete/${id}`)
          .then(response => {
            let i = this.products.map(item => item.id).indexOf(id); // find index of your object
            this.products.splice(i, 1)
          })
          .catch(function (error) {
            console.error(error);
          });
      })
    },
    statusProduct(id) {
      this.$axios.get('/sanctum/csrf-cookie').then(response => {
        this.$axios.get(`/api/products/status/${id}`)
          .then(response => {
            let i = this.products.map(item => item.id).indexOf(id); // find index of your object
            console.log(response);
          })
          .catch(function (error) {
            console.error(error);
          });
      })
    }
  },
  beforeRouteEnter(to, from, next) {
    if (!localStorage.getItem('isLoggedIn')) {
      window.location.href = "/";
    }
    next();
  }
}
</script>
