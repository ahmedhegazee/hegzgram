<template>

</template>

<script>
    export default {
        name: "Post",
        mounted() {
            axios.get('/posts')
                .then(response=>this.posts=response.data)
                .catch(error => {});
            // console.log(this.posts);
        },
        data:function(){
            return{
                posts:[],
            }
        },
        methods:{

        }
    }

</script>

<style scoped>

</style>
