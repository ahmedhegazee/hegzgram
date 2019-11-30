<template>
    <div id="btn">
        <button class="btn btn-primary" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['profileId'],
        mounted() {
        },
        data: function () {
            return {
                status: true,
            }
        },
        methods: {
            followUser() {

                axios.post('/friend/' + this.profileId+"/accept")
                    .then(response => {

                         this.status = !this.status;
                         window.location.reload();
                    }).catch(errors =>{
                        if(errors.response.status == 401){
                            window.location ='/login';
                        }
                });
            }
        },
        computed: {
            buttonText() {

                return (this.status) ? 'Accept' : 'Friends';
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
