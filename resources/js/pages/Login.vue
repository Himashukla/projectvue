<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="alert alert-danger" role="alert" v-if="error !== null">
        {{ error }}
      </div>

      <div class="card card-default">
        <div class="card-header">Login</div>
        <div class="card-body">
          <el-form label-width="100px" style="max-width: 460px">
            <div class="form-group row">
              <el-form-item label="Email">
                <el-input placeholder="Enter E-Mail Address" type="email" v-model="email"></el-input>
              </el-form-item>
            </div>

            <div class="form-group row mt-3">
              <el-form-item label="Password">
                <el-input placeholder="Enter Password" type="password" v-model="password"></el-input>
              </el-form-item>
            </div>

            <div class="form-group row mb-0 mt-3">
              <div class="col-md-8 offset-md-4">
                <el-button type="primary" @click="handleSubmit">Login</el-button>
              </div>
            </div>
          </el-form>

        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      error: null
    }
  },
  methods: {
    handleSubmit(e) {
      e.preventDefault()
      if (this.password.length > 0) {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
          this.$axios.post('api/login', {
              email: this.email,
              password: this.password
            })
            .then(response => {
              console.log(response.data)
              localStorage.setItem('isLoggedIn', true)
              if (response.data.success) {
                this.$router.go('/dashboard')
              } else {
                this.error = response.data.message
              }
            })
            .catch(function (error) {
              console.error(error);
            });
        })
      }
    }
  },
  beforeRouteEnter(to, from, next) {
    if (localStorage.getItem('isLoggedIn')) {
      return next('dashboard');
    }
    next();
  }
}
</script>
