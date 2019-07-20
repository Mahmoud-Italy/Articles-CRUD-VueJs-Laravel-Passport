<template>
    <div>

        <aside class="colorlib-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 breadcrumbs text-center">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </aside>

        <div class="container col-lg-4 col-lg-offset-4">
            <form @submit.prevent="login">

                <div v-if="successMessage" class="success-message alert alert-success">{{ successMessage }}</div>
                <div v-if="serverError" class="server-error alert alert-danger">{{ serverError }}</div>

                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" name="username" id="username" class="form-control" v-model="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" v-model="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-auth btn-subscribe">
                        <div class="lds-ring-container" v-if="loading" :disabled="loading">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                          </div>
                        Login
                    </button>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
export default {
  name: 'login',
  props: {
    dataSuccessMessage: {
      type: String,
    }
  },
  data() {
    return {
      username: '',
      password: '',
      serverError: '',
      successMessage: this.dataSuccessMessage,
      loading: false,
    }
  },
  methods: {
    login() {
      this.loading = true
      this.$store.dispatch('retrieveToken', {
        username: this.username,
        password: this.password,
      })
        .then(response => {
          this.loading = false
          this.$router.push({ name: 'articles' })
        })
        .catch(error => {
          this.loading = false
          this.serverError = error.response.data
          this.password = ''
          this.successMessage = ''
        })
    }
  }
}
</script>

<style scoped>
    .colorlib-breadcrumbs {margin-bottom: 50px}
</style>
