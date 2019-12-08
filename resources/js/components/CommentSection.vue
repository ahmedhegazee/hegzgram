<template>
    <div>


    </div>
</template>

<script>
    export default {
        name: "CommentSection",
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
                if(this.editContent.length>8) {
                    this.comment['content'] = this.content;
                    this.comment['image'] = this.image;
                    this.comment['route'] = this.route;
                    this.comment['username'] = this.username;
                    this.comment['liked'] = false;
                    this.comment['liked_count'] = 0;
                    axios.post("/comments/" + this.postId, {params: {content: this.content}})
                        .then(response => {
                            this.comment['id'] = response.data;
                        }).catch(errors => {
                    });
                    this.comments.push(this.comment);
                    this.content = "";
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
                        }).catch(errors => {
                    });
                    comment.replies.push(this.reply);
                    this.replyContent = "";
                    comment.add_reply = false;
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

</style>
