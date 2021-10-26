<template>
    <div class="rounded overflow-hidden shadow-lg">
      <img class="w-full" :src="'storage/images/'+`${post.photo}`" alt="Mountain">
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">
            <a v-bind:href="'/show/'+post.id">
                {{post.user_name}}
            </a>
            </div>

        <p class="text-gray-700 text-base">
               {{ post.comment }}
        </p>

      </div>
      <div class="px-6 pt-4 pb-2">

        <span @click="showModal=true"  class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">수정</span>
        <span v-on:click="deleteCard" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#삭제</span>
      </div>

        <dialog-modal :show="showModal">
                <template #content>
                    <modify-card @close = "close" v-bind:post="post"></modify-card>
                </template>
        </dialog-modal>

    </div>
</template>

<script>
import DialogModal from '../../Jetstream/DialogModal.vue'
import ModifyCard from './ModifyCard.vue'

export default {
    components:{
        DialogModal,
        ModifyCard
    },
    props:[
        'post',
    ],
    data(){
        return{
            post_id : this.post.id,
            showModal:false
        }
    },
    methods:{
        close(){
            this.showModal=false
            this.$emit("getCards")
        },
        deleteCard(){
            if (confirm("정말 삭제하시겠습니까??") == true){    //확인
                axios.post("delete/"+this.post.id)
                .then(response=>{
                    this.close()
                })
            }else{   //취소
                return;
            }
        }
    }
}
</script>
