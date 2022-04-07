<template>
<div>
  <h4 class="text-center">Add Product</h4>
  <div class="row">
    <div class="col-md-6">
      <el-form label-width="100px" style="max-width: 460px">
        <ProductForm :product="product"></ProductForm>
        <el-button type="primary" @click="addProduct">Add Product</el-button>
      </el-form>
    </div>
  </div>
</div>
</template>

<script>
import ProductForm from './ProductForm.vue';
export default {
  components: {
    ProductForm,
  },
  data() {
    return {
      product: {}
    }
  },
  methods: {
    addProduct() {
      this.$axios.get('/sanctum/csrf-cookie').then(response => {
        this.$axios.post('/api/products/add', this.product)
          .then(response => {
            this.$router.push({
              name: 'products'
            })
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
