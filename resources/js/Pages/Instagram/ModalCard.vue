<template>
    <div class="min-w-full ">
           <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    게시판 작성
                </label>

                <input v-model="cardcontent" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" type="text">
            </div>
            <div class="flex items-center justify-between">
                <button v-on:click="store" class = "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    글쓰기
                </button>
                <input  type ="file" class="inputfile" @change="upload"/>
                <button @click="close" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    나가기
                </button>
            </div>
            <img :src="this.url"/>

    </div>

</template>

<script>
export default {
    data(){
        return{
            file:[],
            imagePath:[],
            url:"",
            cardcontent:"",
        }
    },
    methods:{
        PostCard($imagePath){
            console.log("post 작동")
            axios.post('/post/card',{
                cardcontent:this.cardcontent,
                imagename:$imagePath
            })
            .then(
                this.$emit("close")
            )
        },
        upload(event){
            // 미리보기
            this.imagePath=event.target.files[0]
            this.url = URL.createObjectURL(this.imagePath);
            console.log(this.imagePath)

        },
        store(){
            console.log("store 작동")
            const formData = new FormData()
            if(this.imagePath !=""){
                formData.append('file',this.imagePath)
                axios.post('/post/store',
                    formData,
                    {
                        headers:{
                            'Content-type':'multipart/form-data'
                        }
                    }
                ).then(response=>{
                    console.log(response)
                    this.PostCard(response.data)
                })
            }
            else
                this.PostCard("*/*/null.jpg")

        },
        close(){
            // 모달 종료
            this.$emit("close")
        }
    }

}
</script>
