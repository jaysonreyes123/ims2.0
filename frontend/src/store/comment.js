
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
const toast = useToast();
export const useCommentStore = defineStore('comment', {
    state: () => {
        return {
            loading:false,
            comment_list:[],
            comment_reply_list:[],
            current_page:1,
            last_page:0,
            comment_reply_id:0,
            form:{
                module:"",
                module_id:0,
                comment:"",
                comment_id:0,
            },
        }
    },
    getters:{

    },
    actions: {
        clear(){
            this.form.comment = "";
            this.comment_reply_id = 0;
        },
        async get(){
            this.loading = true;
            const response = await this.axios.get("comments/get_comments/"+this.form.module+"/"+this.form.module_id+"?page="+this.current_page);
            this.last_page = response.data.meta.last_page;
            this.comment_list.push(...response.data.data); 
            this.loading = false;
        },
        async get_reply(commentid){
            this.loading = true;
            const response = await this.axios.get("comments/get_comment_replies/"+commentid);
            this.loading = false;
        },
        async save(reply_container = ""){
           try {
            this.loading = true;
            const response = await this.axios.post("comments/save",this.form);
            if(reply_container == ""){
                this.comment_list.unshift(response.data.data);
            }
            else{
                const get_reply_count = reply_container.reply_count + 1;
                reply_container.reply_count = get_reply_count
                reply_container.reply.unshift(response.data.data);
            }
            this.clear();
            this.loading = false;
           } catch (error) {
            
           }
        },
    },
    persist: true,
})