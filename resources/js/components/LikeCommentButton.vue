<template>
    <div id="likebtn">
<!--        <button  class="btn btn-primary ml-4" @click="likePost" v-text="buttonText"> </button>-->
        <i class="fas fa-heart" @click="likeComment"  v-bind:class="{like:isLiked,unlike:isUnLiked}"></i>
    <span  v-text="likesCount"></span>
    </div>
</template>

<script>
    export default {
        props: ['commentId', 'likes','count'],
        mounted() {
            //console.log('Component mounted.')
        },
        data: function () {
            return {
                status: this.likes,
                isLiked:this.likes,
                isUnLiked:!this.likes,
                likesCount:this.count,

            }
        },
        name:'like-button',

        methods: {
            likeComment() {
                //alert('inside');
                axios.post('/likec/' + this.commentId)
                    .then(response => {

                         this.status = !this.status;

                        this.isLiked=this.status;

                        this.isUnLiked=!this.status;

                        if(this.status){
                            this.likesCount++
                        }
                        else{
                            this.likesCount--;
                        }
                        //console.log("Date: "+response.data);
                        //console.log("isLiked: "+this.isLiked);
                    }).catch(errors =>{
                        if(errors.response.status == 401){
                            window.location ='/login';
                        }
                });
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'Unlike' : 'Like';
            },

        }
    }
</script>
<style>
#likebtn{
    display: inline;
}
    .like{
        color:red;
    }
    .unlike{
        color:#888;
    }
</style>
