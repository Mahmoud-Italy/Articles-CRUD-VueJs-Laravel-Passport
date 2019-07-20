<template>
    <div>
        <nav class="colorlib-nav" role="navigation">
            <div class="top-menu">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-2">
                            <div id="colorlib-logo"><router-link to="/">Article</router-link></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li><router-link :to="{ name: 'articles' }">Articles</router-link></li>
                                <li v-if="!loggedIn"><router-link :to="{ name: 'login' }">Login</router-link></li>
                                <li v-if="!loggedIn"><router-link :to="{ name: 'register' }">Register</router-link></li>
                                <li v-if="loggedIn"><router-link :to="{ name: 'articles' }">{{name}}</router-link></li>
                                <li v-if="loggedIn"><router-link :to="{ name: 'logout' }">Logout</router-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>


<script>
export default {
    data() {
        return {
          name: ''
        }
    },
    created() {
        this.$store.dispatch('retrieveName')
          .then(response => {
            this.name = response.data.name
          })
    },
    computed: {
        loggedIn() {
        return this.$store.getters.loggedIn
    },
  }
}
</script>
