import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
import { useListStore } from "./list";
import { useRelatedStore } from "./related";
import router from '@/router';
const related_store = useRelatedStore();
const list = useListStore();
const toast = useToast(); 
export const useMediaStore = defineStore('media',{
    state:()=>{
        return{
            loading:false,
            modal:false,
            title:"",
            id:"",
            total:0,
            current:1,
            per_page:0,
            form:{
                filetitle:"",
                assigned_to:"",
                note:"",
                files:[]
            },
            mediaList:[],
        }
    },
    actions:{
        async save(formData){
            try {
                this.loading = true;
                const response = await this.axios.post('media',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                      }
                });
                const router_ = router.currentRoute.value.params;
                related_store.get_column(router_.id,router_.module,router_.related_module)
                //list.List_Relation('media',this.id);
                this.loading = false;
                this.clearFile();

            } catch (error) {
                
            }
        },
        async del(ids){
            try {   
                this.loading = true;
                const response = await this.axios.delete("media/"+ids);
                if(response.data.status == 200){
                    this.list();
                }
            } catch (error) {
                
            }
        },
        async download(filename,extension,path){
            try {   
                this.loading = true;
                const response = await this.axios.get("media",{
                    params:{
                        filename:filename,
                        extension:extension,
                        path:path
                    },
                    responseType:"blob"
                });
                const href = URL.createObjectURL(response.data);
                const link = document.createElement('a');
                link.href = href;
                link.setAttribute('download',filename+"."+extension); //or any other extension
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(href);
                this.loading = false;
            } catch (error) {
                
            }
        },
        clearFile(){
            this.form.files = [];
            this.form.assigned_to = "";
            this.form.filetitle = "";
            this.form.note = "";
            this.modal = false;
        }
    },
})