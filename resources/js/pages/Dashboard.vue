<template>
<div>
  Welcome {{ name }}
</div>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      name: null,
    }
  },
  created() {
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name
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
