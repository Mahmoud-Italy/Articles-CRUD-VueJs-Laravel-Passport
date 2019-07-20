<template>
    <div>

        <aside class="colorlib-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 breadcrumbs text-center">
                        <h2>Single Article</h2>
                    </div>
                </div>
            </div>
        </aside>

        <div class="container">
          <article class="blog-entry" v-bind:key="article_id">
                <div class="blog-wrap">
                    <div class="clearfix"></div>
                    <h2 class="text-center"><a href="javascript:">{{ article.title }}</a></h2>
                    <div class="blog-image">
                        <a href="javascript:">
                            <img :src="article.image" v-bind:style="{'width':'100%'}">
                        </a>
                    </div>
                    <span class="category text-center" v-bind:style="{'margin-top':'50px'}">
                        <a href="javascript:"><i class="icon-calendar3"></i> {{ article.created_at }}</a> | 
                        <a href="javascript:" class="posted-by"><i class="icon-user2"></i> by  {{ article.name }}</a>
                    </span>
                </div>
                <p class="text-center">{{ article.body }}</p>
            </article>
          </div>


    </div>
</template>

<script>
 export default {
    mounted() {},
    data() {
        return {
            user_id: '',
            article: {
                user_id: '',
                name: '',
                image: '',
                title: '',
                body: '',
                created_at: '',
            }, 
            article_id: this.$route.params.id,
            pagination: {},
            loading: true,
            edit: false
        }
    },
    computed: {
        loggedIn() {
          return this.$store.getters.loggedIn
        }
    },
    created() {
        this.fetchArticle();
        this.$store.dispatch('retrieveName')
            .then(response => {
                this.user_id = response.data.id
            })
    },
    methods: {
        fetchArticle(page_url) {
            let vm = this;
            page_url = page_url || 'api/article/'+this.article_id
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.loading = false;
                    this.article.user_id = res.data.user_id;
                    this.article.name = res.data.name;
                     this.article.image = res.data.image;
                    this.article.title = res.data.title;
                    this.article.body = res.data.body;
                    this.article.created_at = res.data.created_at;
                })
                .catch(err => console.log(err));
        }
    }
 }
</script>

<style scoped>
    .colorlib-breadcrumbs {margin-bottom: 50px}
</style>
