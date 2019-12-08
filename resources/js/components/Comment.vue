<template>
    <div>
        <div v-for="comment in comments" class="row comment">

            <p>
                <img :src="comment.image" class="rounded-circle w-100"
                     style="max-width: 30px">
                <span class="font-weight-bold">
                            <a :href="comment.route">
                                <span class="text-dark">{{comment.username}}</span>
                            </a>
                        </span>
                <span v-if="!comment.edit">{{comment.content}}</span>
                <div v-if="comment.edit" class="col-12 justify-content-end mb-2" >
                <input type="text" v-model="editContent" class="form-control mb-2">
                 <i @click="closeEditing(comment)" id="close" class="fas fa-times"></i>

            <button class="btn btn-primary "@click="endEditing(comment)">Done</button>
                 </div>

                <like-button class="ml-2" v-if="!comment.edit&&username.length!=0" :like-id="comment.id" :likes="comment.liked"
                         :count="comment.liked_count" :store-route="/likec/"></like-button>
            <div class="ml-2 settings" v-if="!edit&&username.length!=0">
                <i v-if="username===comment.username" class="far fa-edit" @click="editComment(comment)"></i>
                <i v-if="username===comment.username||username===postOwner" class="fas fa-trash " @click="showDeleteDialog(comment)"></i>
                <i class="fas fa-reply" @click="replying(comment)"></i>
            </div>
            <div class="col-12">
                <reply v-if="parseInt(comment.replies_count)>0" :comment-id="comment.id"  :username="username"
                       :image="image" :replies="comment.replies" :route="route" :post-owner="postOwner"></reply>
            </div>


            <div v-if="comment.add_reply" class="row justify-content-end offset-1 col-12">
                <input type="text" v-model="replyContent" class="form-control mb-2">
                <i @click="closeReplying(comment)" id="close1" class="fas fa-times"></i>
                <button class="btn btn-primary " @click="addReply(comment)">Add Reply</button>
            </div>
            </p>

        </div>
        <div v-if="!edit&&username.length!=0" class="row justify-content-end">
            <input type="text" v-model="content" class="form-control mb-2">
            <button class="btn btn-primary " @click="addComment()">Add Comment</button>
        </div>
        <div v-if="show" class="overlay">
            <div class="content">
                <i @click="closeMessage()"  class="fas fa-times"></i>
                <div class="alert alert-danger mt-4">{{message}}</div>
           <div v-if="showDelete" class="row justify-content-center">
               <button @click="deleteComment(deletedComment)" class="btn btn-danger mr-3">Delete</button>
               <button @click="closeMessage()" class="btn btn-success">Cancel</button>
           </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props: ['postId', 'username', 'image', 'route','postOwner'],
        data: function () {
            return {
                comments: [],
                content: '',
                replyContent: '',
                editContent: '',
                comment: [],
                reply:[],
                edit:false,
                show:false,
                message:'',
                showDelete:false,
                deletedComment:0,
            }
        },
        mounted() {
            axios.get('/comments/' + this.postId)
                .then(response => {
                    this.comments = response.data;
                    // console.log(response.data);
                }).catch(errors => {

            });
        },
        methods: {
            addComment() {
                if(this.content.length>8) {
                    this.comment['content'] = this.content;
                    this.comment['image'] = this.image;
                    this.comment['route'] = this.route;
                    this.comment['username'] = this.username;
                    this.comment['liked'] = false;
                    this.comment['liked_count'] = 0;
                    axios.post("/comments/" + this.postId, {params: {content: this.content}})
                        .then(response => {
                            this.comment['id'] = response.data;
                            this.comments.push(this.comment);
                            this.content = "";
                            // console.log(this.comment['id']);
                        }).catch(errors => {
                    });

                }
                else{
                    this.showMessage('The length of the comment must be more than 8 characters');

                }
            },
            editComment(comment) {
                comment.edit = true;
                this.edit=true;
                this.editContent=comment.content;
            },
            endEditing(comment){

                if(this.editContent.length>8)
                {
                    comment.content=this.editContent;
                    axios.patch('/comments/'+comment.id,{content:comment.content})
                    .then(response=>{
                        console.log(response.data);
                    })
                    .catch(errors=>{});
                    this.closeEditing(comment);

                }

                else{
                    this.showMessage('The length of the comment must be more than 8 characters');
                }
            },
            deleteComment(comment){
                this.closeMessage();
                axios.delete('/comments/'+comment.id)
                    .then(response=>{
                        console.log(response.data);
                    })
                    .catch(errors=>{});
                this.comments.splice(this.comments.indexOf(comment),1);
            },
            closeMessage(){
                this.show=false;
                this.message='';
                this.showDelete=false;
                this.deletedComment=null;

            },
            closeEditing(comment){
                comment.edit = false;
                this.edit=false;
                this.editContent='';
            },
            replying(comment){
                comment.add_reply=true;
            },
            addReply(comment){
                if(this.replyContent.length>8) {
                    this.reply['content'] = this.replyContent;
                    this.reply['image'] = this.image;
                    this.reply['route'] = this.route;
                    this.reply['username'] = this.username;
                    this.reply['liked'] = false;
                    this.reply['liked_count'] = 0;
                    axios.post("/replies/" + comment.id, {params: {content: this.replyContent}})
                        .then(response => {
                            this.reply['id'] = response.data;
                            comment.replies.push(this.reply);
                            this.replyContent = "";
                            comment.add_reply = false;
                        }).catch(errors => {
                    });

                }
            else{
                    this.showMessage('The length of the reply must be more than 8 characters');

                }
            },
            closeReplying(comment){
                comment.add_reply=false;

            },
            showMessage(content){
                this.show=true;
                this.message=content;
            },
            showDeleteDialog(comment){
                this.deletedComment=comment;
                this.showMessage('Do you want to delete this comment');
                this.showDelete=true;
            }
        }
    }

</script>

<style scoped>
#close{
    font-size: 16pt;
    right: 6%;
    top: 10%;
}
</style>
