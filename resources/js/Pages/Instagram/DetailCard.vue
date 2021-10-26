<template>
    <div class="text-center md:w-auto">
        <div>
           <div class="mb-6" >
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    게시판 자세히 보기
                </label>
                <h1>게시글</h1>
                <textarea name="" id="" cols="50" rows="1" v-model="post.comment" readonly></textarea>
                <h1>작성자</h1>
                    <textarea name="" id="" cols="50" rows="1" v-model="post.user_name" readonly></textarea>
                <h1>작성일자</h1>
                    <textarea name="" id="" cols="50" rows="1" v-model="post.created_at" readonly></textarea>
                <h1>사진</h1>

                <img :src="'/storage/images/'+`${post.photo}`" alt="picture" >

                <button @click="close" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    나가기
                </button>
            </div>

            <img :src="this.url"/>
        </div>
    </div>
</template>

<script>

export default {
    props:['post'],
    data(){
        return{
            posts:[]
        }
    },
    methods:{
       close(){
           history.back()
       }
    },

}
</script>
