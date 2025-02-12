<template lang="">
    <div class="mt-6">
        <Loading v-model:active="comment_store.loading"/>
        <div>
            <Card>
                <form @submit.prevent="comment_store.save()">
                    <Textarea v-model="comment_store.form.comment" placeholder="Write a comments..." :rows="6"/>
                    <div class="flex justify-end mt-4">
                        <Button text="Comment" icon="heroicons-outline:chat-bubble-bottom-center-text" btnClass="btn-success btn-sm"  />
                    </div>
                </form>
            </Card>
            <Card title="Comments" class="mt-4">
                <div v-if="comment_store.comment_list.length > 0">
                    <div class="comment-border-top p-3 text-base bg-white relative"  :key="index" v-for="(item,index) in comment_store.comment_list">
                        <comment :comment-item="item"/>
                    </div>
                </div>
                <div v-else>
                    <div class="p-6 border rounded mt-4">
                        <p class="text-center">No Comments</p>
                    </div>
                </div>
            </Card> 
        </div>
    </div>
</template>
<script>
import Textarea from "@/components/Textarea";
import Icon from "@/components/Icon"
import Button from "@/components/Button";
import Card from "@/components/Card";
import { useCommentStore } from "@/store/comment";
import comment from "./comment.vue";
import { ref } from "vue";
const comment_store = useCommentStore();
const comment_reply = ref("");
export default {
    components:{
        Card,
        comment,
        Button,
        Textarea,
        Icon
    },
    created(){
        comment_store.loading = false;
        comment_store.comment_list = [];
        comment_store.comment_reply_list = [];
        comment_store.current_page = 1;
        comment_store.form.comment_id = 0;
    },
    mounted(){
        comment_store.clear();
        comment_store.form.module_id = this.$route.params.id;
        comment_store.form.module = this.$route.params.module;
        comment_store.get();
        window.addEventListener("scroll",function(){
            const current_scrollheight = window.scrollY + document.body.clientHeight;
            const total_scrollheight = document.body.scrollHeight;
            if(current_scrollheight == total_scrollheight){
                if(comment_store.current_page < comment_store.last_page){
                    comment_store.current_page++;
                    comment_store.get();
                }
            }
        })
    },
    data(){
        return{
            comment_store,
            comment_reply
        }
    },
}
</script>
<style>
    .comment{
      @apply border-l border-gray-200 ml-12 pl-4 mt-4
    }
    .comment-border-top:not(:first-child){
       @apply border-t border-gray-200
    }
    .comment_parent {
        @apply border-l border-gray-200 pl-4
    }
</style>