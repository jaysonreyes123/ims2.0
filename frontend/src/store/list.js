import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 

export const useListStore = defineStore('list',{
    state:()=>{
        return{
            loading:false,
            list:[],
            list_relation:[],
            total:0,
            current:1,
            per_page:0,
            filter_data:[],
            search:"",
            fields:[
                {
                    field:"",
                    value:""
                },
            ]
        }
    },
    actions:{
        async List_Relation(modules,modules_id){
            try {
                this.loading = true;
                this.list = [];
                const response = await this.axios.get(modules+"/"+modules_id+"?page="+this.current,{
                    params:{
                        module:modules,
                        module_id:modules_id,
                        search:this.search,
                    }
                });
                const data = response.data;
                this.list_relation = data.data;
                this.total = data.meta.total;
                this.current = data.meta.current_page;
                this.per_page = data.meta.per_page;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async List(modules){
            try {
                this.loading = true;
                this.list = [];
                const response = await this.axios.get(modules+"?page="+this.current,{
                    params:{
                        module:modules,
                        filter:this.filter_data,
                        search:this.search,
                    }
                });
                const data = response.data;
                this.list = data.data;
                this.total = data.meta.total;
                this.current = data.meta.current_page;
                this.per_page = data.meta.per_page;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async Delete(modules,id){
            try {
                this.loading = true;
                const response = await this.axios.delete(modules+"/"+id);
                if(response.data.status == 200){
                    this.List(modules);
                }
            } catch (error) {
                
            }
        },
        async Delete_Relation(modules,module_id,id){
            try {
                this.loading = true;
                const response = await this.axios.delete(modules+"/"+id);
                if(response.data.status == 200){
                    this.List_Relation(modules,module_id);
                }
            } catch (error) {
                
            }
        }
    },
})