<template>
    <div id="btn">
        <button class="btn btn-primary" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['profileId', 'friend','accept'],
        mounted() {
        },
        data: function () {
            return {
                status: this.friend,
                acceptStatus:this.accept,
            }
        },
        methods: {
            followUser() {
                if(this.acceptStatus)
                    this.acceptStatus= !this.acceptStatus;
                axios.post('/friend/' + this.profileId)
                    .then(response => {
                         this.status = !this.status;
                    }).catch(errors =>{
                        if(errors.response.status == 401){
                            window.location ='/login';
                        }
                });
            }
        },
        computed: {
            buttonText() {
                if(this.acceptStatus==1)
                    return 'Friends';
                else
                return (this.status) ? 'Waiting' : 'Send Request';
            }
        }
    }
</script>
<style>

    #btn{
        display: inline;
        margin-left:10px;
    }
</style>
