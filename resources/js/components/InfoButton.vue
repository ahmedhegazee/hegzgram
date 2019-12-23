<template>
    <div>
        <strong>{{count}}</strong>  <i :class="fontClass" @click="openView()"></i>
        <div v-if="show" class="overlay">
            <div class="content">
            <h3 class="text-center">{{message}}</h3>
                <ul class="list-group mt-4"  v-if="results.length > 0 ">
                    <li  class="list-group-item list" v-for="result in results.slice(0,10)" :key="result.id" v-if="">
                        <img v-bind:src="result.image" alt="" width="30px" height="30px" class="rounded-circle img">
                        <a :href="result.url">
                            <div v-text="result.username"></div>
                        </a>
                        <follow-button v-if="isLogin!=null&&currentUser!=result.userId&&currentUser!=null"  v-bind:user-id="result.userId" v-bind:follows="result.follows"></follow-button>
                        <friend-button v-if="isLogin!=null&&currentUser!=result.userId&&currentUser!=null" v-bind:profile-id="result.userId" v-bind:friend="result.friend"
                                       v-bind:accept="result.accept"></friend-button>
                    </li>
                </ul>
                <i id="close" @click="closeView()"  class="fas fa-times"></i>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "InfoButton",
        props:['count','fontClass','link','userId','isLogin','currentUser','message'],
        data:function () {
            return{
                // friends:this.isFriends,
                // following:this.isFollowing,
                show:false,
                results:[],
            }
        },
        methods:{
            closeView(){
                this.show=false;
            },
            openView(){
                this.show=true;
                this.getData();
            },
            getData(){
                axios.get(this.link  + this.userId)
                    .then(response => {
                        this.results=response.data;
                    }).catch(errors =>{
                    if(errors.response.status == 401){
                        window.location ='/login';
                    }
                });
            }
        }
    }
</script>

<style scoped>
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
    i,strong{
        color:#3490dc;
    }

</style>
