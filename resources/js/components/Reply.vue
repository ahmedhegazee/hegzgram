<template>
    <div>
        <div v-for="reply in repliesList" class="row reply mb-2">

            <div class="offset-1 col-12" >
                <img v-bind:src="reply.image" class="rounded-circle w-100"
                     style="max-width: 30px">
                <span class="font-weight-bold">
                            <a v-bind:href="reply.route">
                                <span class="text-dark">{{reply.username}}</span>
                            </a>
                        </span>
                <span  v-if="!reply.edit">{{reply.content}}</span>
                <div v-if="reply.edit" class="col-12 justify-content-end mb-2" >
                    <input type="text" v-model="editContent" class="form-control mb-2">
                    <i @click="closeEditing(reply)" id="close1" class="fas fa-times"></i>

                    <button class="btn btn-primary "@click="endEditing(reply)">Done</button>
                </div>

                <like-button  v-if="!reply.edit&&username.length!=0" v-bind:like-id="reply.id" v-bind:likes="reply.liked" v-bind:count="reply.liked_count" v-bind:store-route="/liker/"></like-button>
                <div class="ml-2 settings" v-if="!edit">
                    <i v-if="username===reply.username" class="far fa-edit" @click="editReply(reply)"></i>
                    <i v-if="username===reply.username||username===postOwner" class="fas fa-trash " @click="showDeleteDialog(reply)"></i>
                </div>
            </div>

            <div v-if="show" class="overlay">
                <div class="content">
                    <i @click="closeMessage()"  class="fas fa-times"></i>
                    <div class="alert alert-danger mt-4">{{message}}</div>
                    <div v-if="showDelete" class="row justify-content-center">
                        <button @click="deleteReply(deletedReply)" class="btn btn-danger mr-3">Delete</button>
                        <button @click="closeMessage()" class="btn btn-success">Cancel</button>
                    </div>                </div>
        </div>

    </div>
    </div>
</template>

<script>
    export default {
        name: "Reply",
        props:['commentId','username','image','route','replies','postOwner'],
        data:function(){
            return{
                repliesList:this.replies,
                content:'',
                reply:[],
                editContent:"",
                edit:false,
                show:false,
                message:'',
                showDelete:false,
                deletedReply:0,

            }
        },
        mounted() {
        },
        methods:{
            editReply(reply) {
                reply.edit = true;
                this.edit=true;
                this.editContent=reply.content;
            },
            endEditing(reply){

                if(this.editContent.length>8)
                {
                    reply.content=this.editContent;
                    axios.patch('/replies/'+reply.id,{content:reply.content})
                        .then(response=>{
                            console.log(response.data);
                        })
                        .catch(errors=>{});
                    this.closeEditing(reply);

                }

                else{
                    this.showMessage('The length of the reply must be more than 8 characters')
                }
            },
            deleteReply(reply){
                this.closeMessage();
                axios.delete('/replies/'+reply.id)
                    .then(response=>{
                        console.log(response.data);
                    })
                    .catch(errors=>{});
                this.repliesList.splice(this.repliesList.indexOf(reply),1);
            },
            closeMessage(){
                this.show=false;
                this.message='';
                this.showDelete=false;
                this.deletedReply=null;
            },
            closeEditing(reply){
                reply.edit = false;
                this.edit=false;
                this.editContent='';
            },
            showMessage(content){
                this.show=true;
                this.message=content;
            },
            showDeleteDialog(reply){
                this.deletedReply=reply;
                this.showMessage('Do you want to delete this comment');
                this.showDelete=true;
            }
        }
    }

</script>

<style scoped>
#close1{
    font-size: 15pt;
    right: 8%;
    top: 11%;
}
</style>
