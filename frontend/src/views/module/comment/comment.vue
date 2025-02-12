<template lang="">
    <div>
        <article :class="[commentClass,commentItem.comment_id == 0 && commentItem.reply.length > 0 ? 'comment_parent' : '' ]" >
            <footer class="flex justify-between commentItem.s-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                        {{commentItem.comment_by}}
                    </p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        {{commentItem.timestamp}}
                    </p>
                </div>
            </footer>
            <p class="text-gray-500 dark:text-gray-400">
                {{commentItem.comment}}
            </p>
            <div>
                <div class="flex items-center mt-3 space-x-4">
                    <button
                        @click="reply(commentItem.id)"
                        type="button"
                        class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-medium">
                        <Icon icon="heroicons-outline:chat-bubble-left-ellipsis" class="mr-1"/>
                        Reply
                    </button>

                    <button
                        @click="show_replies(commentItem.id)"
                        v-if="commentItem.reply_count != 0"
                        type="button"
                        class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-medium">
                        {{commentItem.reply_count}} Replies
                    </button>
                </div>
            </div>
            <div v-if="commentItem.reply && commentItem.reply.length > 0" >
                <comment :key="reply.id" v-for="(reply,reply_index) in commentItem.reply" commentClass="comment" :comment-item="reply" />
            </div>
            <button
                @click="view_more_replies(commentItem.id)"
                v-if="commentItem.reply.length != 0 && commentItem.reply.length < commentItem.reply_count "
                type="button"
                class="comment flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-medium">
                View more replies
            </button>
            <div>
                <commentReply @save_reply="save_reply" :comment-to="commentItem.comment_by" v-if="comment_store.comment_reply_id == commentItem.id" />
            </div>
        </article>
    </div>
</template>
<script>
import { ref } from "vue";
import Icon from "@/components/Icon"
import { useCommentStore } from "@/store/comment";
import commentReply from "./comment-reply.vue";
const comment_store = useCommentStore();
export default {
    name: 'comment',
    props:{
        commentItem:{
            type:Object,
            default:{}
        },
        commentClass:{
            type:String,
            default:""
        },
    },
    components:{
        Icon,
        commentReply
    },
    data(){
        return{
            comment_store
        }
    },
    methods:{
        findcomment(comment_id,comment_reply_){
            for (let comment_reply of comment_reply_) {
                if (comment_reply.id == comment_id) {
                    return comment_reply
                }
                else{
                    const found = this.findcomment(comment_id,comment_reply.reply)
                    if(found != null){
                        return found;
                    }
                }
            }
            return null;
        },
        reply(comment_id){
            comment_store.form.comment_id = comment_id;
            comment_store.comment_reply_id = comment_id;
        },
        save_reply(reply){
            comment_store.form.comment = reply;
            const reply_container = this.findcomment(comment_store.form.comment_id,comment_store.comment_list);
            comment_store.save(reply_container);
        },
        view_more_replies(comment_id){
            this.show_replies(comment_id,'view_more');
        },
        async show_replies(comment_id,option = ""){
            try {
                comment_store.loading = true;
                comment_store.comment_reply_id = 0;
                const reply_container = this.findcomment(comment_id,comment_store.comment_list);
                let current_page;
                if(option == "view_more"){
                     current_page = parseInt(reply_container.current_page)+1;
                }
                else{
                     reply_container.reply = [];
                     current_page = parseInt(reply_container.current_page);
                }
                const response = await this.$axios.get("comments/get_comment_replies/"+comment_id+"?page="+current_page);
                reply_container.current_page = current_page;
                reply_container.reply.push(...response.data.data);
                comment_store.loading = false;
        
            } catch (error) {
                
            }
        },
    }
}
</script>
<style>
    .border-image::after{
        content: "";
        position: absolute;
        width: 200px;
        border: 1px solid #ccc;
        top: 0;
    }
</style>