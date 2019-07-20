<template>
    <div>
        <aside class="colorlib-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 breadcrumbs text-center">
                        <h2>Articles</h2>
                    </div>
                </div>
            </div>
        </aside>
        <div class="container">
            <div class="col-lg-8">
            <br/>

            <button v-if="loggedIn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#articleModal">
                <i class="icon-pencil"></i> Add New Article</button><br/>

            <div id="articleModal" ref="vuemodal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="addArticle" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h3 class="">Add New Article</h3>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" class="form-control" 
                                        v-model="article.title" required>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea rows="5" id="body" class="form-control"
                                        v-model="article.body" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" class="form-control" ref="fileInput"
                                        v-on:change="onImageChange" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-auth">
                                    <div class="lds-ring-container" v-if="btnLoading" :disabled="btnLoading" v-bind:style="{'left':'62%'}">
                                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                    </div>
                                Submit</button>
                                <button type="button" class="btn btn-default  btn-auth dismiss" data-dismiss="modal" v-bind:style="{'margin-top':'-2px'}">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



             <button id="updateArt" type="button" data-toggle="modal" data-target="#updateArticleModal" 
             v-bind:style="{'display':'none'}"></button>
            <div id="updateArticleModal" ref="vuemodal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="addArticle" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h3 class="">Update Article</h3>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" class="form-control" 
                                        v-model="article.title" required>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea rows="5" id="body" class="form-control"
                                        v-model="article.body" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" class="form-control" ref="fileInput"
                                        v-on:change="onImageChange">
                                    <img :src="article.image" v-bind:style="{'height':'100px'}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-auth">
                                    <div class="lds-ring-container" v-if="btnLoading" :disabled="btnLoading" v-bind:style="{'left':'62%'}">
                                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                    </div>
                                Submit</button>
                                <button type="button" class="btn btn-default  btn-auth dismis" data-dismiss="modal" v-bind:style="{'margin-top':'-2px'}">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                

            <div class="lds-ring-art-container" v-if="loading" :disabled="loading">
                <div class="lds-ring-art"><div></div><div></div><div></div><div></div></div>
            </div>



            



            <article class="blog-entry" v-for="article in articles" v-bind:key="article.id">
                <div class="blog-wrap">
                    <div class="row pull-right" v-if="article.user_id === user_id" v-bind:style="{'margin-top':'-25px'}">
                        <button @click="editArticle(article)" class="btn btn-success"><i class="icon-pencil22"></i></button>
                        <button @click="deleteArticle(article.id)" class="btn btn-danger"><i class="icon-trash2"></i></button>
                    </div>
                    <div class="clearfix"></div>
                    <h2 class="text-center"><a href="javascript:" v-on:click="showArticle(article.id)">{{ article.title }}</a></h2>
                    <div class="blog-image">
                        <a href="javascript:" v-on:click="showArticle(article.id)">
                            <img :src="article.image" v-bind:style="{'width':'100%', 'height':'500px'}">
                        </a>
                    </div>
                    <span class="category text-center" v-bind:style="{'margin-top':'50px'}">
                        <a href="javascript:"><i class="icon-calendar3"></i> {{ article.created_at }}</a> | 
                        <a href="javascript:" class="posted-by"><i class="icon-user2"></i> by  {{ article.name }}</a>
                    </span>
                </div>
                <p class="text-center"><a href="javascript:" v-on:click="showArticle(article.id)" 
                    class="btn btn-primary btn-subscribe">Continue Reading</a></p>
            </article>




            <nav  v-if="!loading" aria-label="Page navigation example" v-bind:style="{'margin-top':'20px'}">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="javascript:" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <a class="page-link" href="javascript:" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
                </ul>
                <p><i>Page {{ pagination.current_page }} or {{ pagination.last_page }}</i></p>
            </nav>


            </div>
                <aside class="sidebar" v-bind:style="{'margin-top':'35px'}">
                     <h3>Search</h3>
                        <div class="side">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" v-model="search" placeholder="Enter any key to search...">
                                <button type="submit" class="btn btn-primary" @click="fetchArticles()"><i class="icon-search3"></i></button>
                            </div>
                        </div>
                </aside>
            
        </div>
    </div>
</template>


<script>
 export default {
    mounted() {},
    data() {
        return {
            name: '',
            user_id: '',
            articles: [],
            article: {
                id: '',
                user_id: '',
                image: '',
                title: '',
                body: ''
            }, 
            article_id: '',
            pagination: {},
            search: '',
            loading: true,
            btnLoading: false,
            edit: false,
            modalCreate: false
        }
    },
    computed: {
        loggedIn() {
          return this.$store.getters.loggedIn
        }
    },
    created() {
        this.fetchArticles();
        this.$store.dispatch('retrieveName')
            .then(response => {
                this.user_id = response.data.id;
                this.article.user_id = response.data.id;
                this.name = response.data.name;
            })
    },
    methods: {
        fetchArticles(page_url) {
            this.loading = true;
            let vm = this;
            page_url = page_url || 'api/articles?search='+this.search
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.loading = false;
                    this.articles = res.data;
                    vm.makePagination(res.meta, res.links)
                })
                .catch(err => this.loading = false);
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination;
        },
        deleteArticle(id) {
            if(confirm('Are You Sure?')) {
                fetch(`api/article/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    this.loading = true;
                    this.fetchArticles();
                })
                .catch(err => console.log(err));
            }
        },
        onImageChange(e){
            this.article.image = e.target.files[0];
        },
        addArticle() {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            if(this.edit === false) {
                 // Add
                this.btnLoading = true;
                let formData = new FormData();
                formData.append('user_id', this.article.user_id);
                formData.append('image', this.article.image);
                formData.append('title', this.article.title);
                formData.append('body', this.article.body);
                
                axios.post('article', formData, config)
                .then(data => {
                    this.loading = true;
                    this.article.title = '';
                    this.article.body = '';
                    this.article.image = '';
                    this.$refs.fileInput.value = '';
                    this.fetchArticles();
                    this.btnLoading = false;
                    $('.dismiss').click();
                })
                .catch(err => console.log(err));
            } else {
                // Update
                this.loading = true;
                let formData = new FormData();
                formData.append('article_id', this.article.id);
                formData.append('user_id', this.article.user_id);
                formData.append('image', this.article.image);
                formData.append('title', this.article.title);
                formData.append('body', this.article.body);
                formData.append('_method', 'PUT');

                axios.post('article', formData, config)
                .then(data => {
                    this.loading = true;
                    this.article.title = '';
                    this.article.body = '';
                    this.article.image = '';
                    this.$refs.fileInput.value = '';
                    this.fetchArticles();
                    this.btnLoading = false;
                    $('.dismis').click();
                })
                .catch(err => console.log(err));
            }
        },
        editArticle(article) {
            this.edit = true;
            this.article.id = article.id;
            this.article.image = article.image;
            this.article.title = article.title;
            this.article.body = article.body;
            $('#updateArt').click();
        },
        showArticle(article) {
            this.$router.push({ name: 'article', params: {id:article} })
        }
    }
 }
</script>

<style scoped>
    .colorlib-breadcrumbs {margin-bottom: 50px}
</style>
