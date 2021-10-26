<template>
    <div class="min-w-full ">
           <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    게시판 수정하기
                </label>
                <input v-model="post.comment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" type="text">
            </div>
            <div class="flex items-center justify-between">
                <button v-on:click="update" class = "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    수정하기
                </button>
                <input  type ="file" class="inputfile" @change="upload"/>
                <button @click="close" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    나가기
                </button>
            </div>
            <img :src='`${url}`'/>
    </div>

</template>

<script>
export default {
    props:[
        'post'
    ],
    data(){
        return{
            file:[],
            imagePath:[],
            url:"/storage/images/" + this.post.photo,
            cardcontent:"",
        }
    },
    methods:{
        updateCard($imagePath){
            console.log("updateCard 작동")
            axios.post('/post/updatecard/'+this.post.id,{
                cardcontent:this.post.comment,
                imagename:$imagePath,
            })
            .then(response=>{
                console.log(response)
                this.$emit("close")
            })
        },
        upload(event){
            // 미리보기
            this.imagePath=event.target.files[0]
            this.url = URL.createObjectURL(this.imagePath);
            console.log(this.imagePath)

        },
        update(){
            const formData = new FormData()
            if(this.imagePath!=""){
                formData.append('file',this.imagePath)
                console.log("update 작동")
                axios.post('/post/update',
                    formData,
                    {
                        headers:{
                            'Content-type':'multipart/form-data'
                        }
                    }
                ).then(response=>{
                    console.log(response)
                    this.updateCard(response.data)
                })
            }
            else
                this.updateCard("")

        },
        close(){
            // 모달 종료
            this.$emit("close")
        }
    }

}
</script>
