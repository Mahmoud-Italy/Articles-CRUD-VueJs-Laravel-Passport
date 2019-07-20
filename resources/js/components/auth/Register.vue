<template>
    <div>

        <aside class="colorlib-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 breadcrumbs text-center">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </aside>

        <div class="container col-lg-4 col-lg-offset-4">
            <form @submit.prevent="register">

                <div v-if="serverErrors" class="server-error alert alert-danger">
                    <div v-for="(value, key) in serverErrors" :key="key">
                      {{ value[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" v-model="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" v-model="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" v-model="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-auth2 btn-subscribe">
                        <div class="lds-ring2-container" v-if="loading" :disabled="loading">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                          </div>
                        Create Account
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      serverErrors: '',
      successMessage: '',
      loading: false,
    }
  },
  methods: {
    register() {
      this.loading = true
      this.$store.dispatch('register', {
        name: this.name,
        email: this.email,
        password: this.password,
      })
        .then(response => {
          this.loading = false
          this.successMessage = 'Registered Successfully!'
          this.$router.push({ name: 'login', params: { dataSuccessMessage: this.successMessage } })
        })
        .catch(error => {
          this.loading = false
          this.serverErrors = Object.values(error.response.data.errors)
        })
    }
  }
}
</script>

<style scoped>
    .colorlib-breadcrumbs {margin-bottom: 50px}
</style>
