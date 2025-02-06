
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
const toast = useToast();
export const useListStore = defineStore('list', {
    state: () => {
        return {
            module:"",
            loading:false,
            list_data:[],
            columns:[],
            columns_header:[],
            filter_data:[],
            search:"",
            page:{
                total:0,
                current:1,
                per_page:0
            }
        }
    },
    actions: {
        clear(){
            this.list_data = [];
            this.columns = [];
            this.columns_header=[];
        },
        async get_column(){
            try {
                this.loading = true;
                const response = await this.axios.get("list/columns",{
                    params:{
                        module:this.module
                    }
                });
                const data = response.data;
                this.columns_header = data.data;
                data.data.map(item=>{
                    this.columns.push(item.name);
                })
                this.columns_header.push({field:"action",label:"Action"});
                this.columns.push("id");
                this.loading = false;
                this.list_function();
            } catch (error) {
                
            }
        },
        async list_function(){
            try {
                this.loading = true;
                const response = await this.axios.get("list?page="+this.page.current,{
                    params:{
                        module:this.module,
                        columns:this.columns,
                        filter:this.filter_data,
                        search:this.search
                    }
                });
                const data = response.data.data;
                this.page.total = data.total;
                this.page.per_page = data.per_page;
                this.list_data = data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async delete(module,id,index){
            try {
                this.loading = true;
                const response = await this.axios.delete("module/"+id,{
                    params:{
                        module:module
                    }
                });
                if(response.data.data == 1){
                    this.list_data.splice(index,1);
                }
                this.loading = false;
            } catch (error) {
                
            }
        }
    },
    persist: true,
})