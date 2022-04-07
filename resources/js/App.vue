<template>
<div class="container">

  <nav class="navbar navbar-expand-lg navbar-light bg-light lead">
    <div class="collapse navbar-collapse">
      <div class="navbar-nav">
        <div style="margin: 20px 0px 20px 0px;">
          <h2 class="text-secondary mt-3">
            <img src="https://laravel.com/img/logomark.min.svg">
          </h2>
        </div>
      </div>
      <!-- for logged-in user-->
      <div class="navbar-nav" v-if="isLoggedIn">
        <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
        <router-link to="/products" class="nav-item nav-link">Products</router-link>
        <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
      </div>
      <!-- for non-logged user-->
      <div class="navbar-nav" v-else>
        <router-link to="/" class="nav-item nav-link">Home</router-link>
        <router-link to="/login" class="nav-item nav-link">login</router-link>
        <router-link to="/register" class="nav-item nav-link">Register
        </router-link>
        <router-link to="/about" class="nav-item nav-link">About</router-link>
      </div>
    </div>
  </nav>
  <br />
  <router-view />
  <Test :test="'testing'" />
</div>
</template>

<script>
import Test from './components/Test.vue'
export default {
  name: "App",
  components: {
    Test,
  },
  data() {
    return {
      isLoggedIn: false,
    }
  },
  created() {
    if (localStorage.getItem('isLoggedIn')) {
      this.isLoggedIn = true
    }
  },
  methods: {
    logout(e) {
      e.preventDefault()
      this.$axios.get('/sanctum/csrf-cookie').then(response => {
        this.$axios.post('/api/logout')
          .then(response => {
            if (response.data.success) {
              localStorage.removeItem('isLoggedIn')
              window.location.href = "/"
            } else {
              console.log(response)
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      })
    }
  },
}
</script>

<style lang="scss" scoped>
.nav-link {
  font-size: 25px;
  margin-left: 10px !important;
}
</style>
