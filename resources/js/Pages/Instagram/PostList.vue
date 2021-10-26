<template>
<div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
    <post-card @getCards = "getCards"></post-card>
    <post-item v-for="post in posts" :key="post" v-bind:post="post" @getCards="getCards"></post-item>
</div>
</template>
<script>
import PostItem from '@/Pages/Instagram/PostItem.vue'
import PostCard from '@/Pages/Instagram/PostCard.vue'
export default {
    components: {
        PostItem,
        PostCard
    },
        data(){
            return {
                posts:[],
            }
        },
        methods:{
            getCards(){
                axios.post("/cards")
                .then(response =>{
                    this.posts = response.data
                    console.log(response.data)
                })
                .catch(err =>{
                    console.log(err)
                })

            },
        },
        mounted(){
            this.getCards()
        }
}
</script>
