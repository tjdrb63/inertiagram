
<template>
<!-- 게시판 작성 -->
    <div class="text-center">
        <button @click="showModal=true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center">글쓰기</button>
            <dialog-modal :show="showModal">
                <template #content>
                    <modal-card @close = "closeModal"></modal-card>
                </template>
        </dialog-modal>

    </div>
</template>
<script>

import DialogModal from '../../Jetstream/DialogModal.vue'
import ModalCard from './ModalCard.vue'

export default {
    components:{
        DialogModal,
        ModalCard
    },
    data(){
        return{
            showModal:false
        }
    },
    methods:{
        closeModal(){
            console.log(this.showModal)
            this.showModal = false
            console.log(this.showModal)
            this.$emit("getCards")

        },

    }

}
</script>
