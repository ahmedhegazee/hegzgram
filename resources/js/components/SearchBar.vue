<template>
    <div id="search">
        <input type="text" placeholder="Write username" v-model="query">
        <div id="searchList">
            <ul class="list-group"  v-if="results.length > 0 && query">
                <li  class="list-group-item list" v-for="result in results.slice(0,10)" :key="result.id" v-if="userId!=result.userId">
                    <img v-bind:src="result.image" alt="" width="30px" height="30px" class="rounded-circle img">
                    <a :href="result.url">
                        <div v-text="result.title"></div>
                    </a>
                    <follow-button v-if="userId!=0"  v-bind:user-id="result.userId" v-bind:follows="result.follows"></follow-button>
                    <friend-button v-if="userId!=0" v-bind:profile-id="result.userId" v-bind:friend="result.friend"
                                   v-bind:accept="result.accept"></friend-button>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
    export default {
    props:['userId'],
        mounted() {
              // console.log(this.userId);
        },
        data: function () {
            return {
                query: null,
                results: []

            }
        },watch: {
            query(after, before) {
                this.searchMembers();
            }
        },
        name:'search-bar',

        methods: {
            searchMembers() {
                axios.get('/search', { params: { query: this.query } })
                    .then(response => this.results = response.data)
                    .catch(error => {});
                // console.log(this.results);
            }
        },

    }
</script>

<style>
    input[type="text"]{
       border:none;
        border-radius :10px;
        background-color: #ddd;
        width:100%;
        padding-left:20px;
    }
   .list {position: relative;
        padding-left: 9%;}
    .img{
        position: absolute;
        left: 2%;
        top: 25%;
    }
    .list #btn{
        position: absolute;
        right: 3%;
        bottom: 10%;
    }
    .list #btn:nth-of-type(2){
        position: absolute;
        right: 17%;
        bottom: 10%;
    }
</style>
