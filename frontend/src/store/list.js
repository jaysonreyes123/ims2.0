
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
const toast = useToast();
export const useListStore = defineStore('list', {
    state: () => {
        return {
            module:"",
            modal:false,
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
            },
        }
    },
    actions: {
        clear(){
            this.list_data = [];
            this.columns = [];
            this.columns_header=[];
        },
        async get_column(){
        
                const column_header_cache = JSON.parse(localStorage.getItem('column_header'));
                const check_if_exist = column_header_cache == null ? false : column_header_cache.hasOwnProperty(this.module);
                //cache column if not exist to current local storage
                if(check_if_exist){
                    column_header_cache[this.module].map(item=>{
                        this.columns.push(item.name);
                    })
                    this.columns.push("id");
                    this.columns_header = column_header_cache[this.module];
                    this.list_function()
                }
                else{
                    try {
                        this.loading = true;
                        const response = await this.axios.get("list/columns",{
                            params:{
                                module:this.module
                            }
                        });
                        const data = response.data;
                        this.columns_header = data.data;
                        this.columns_header.push({field:"action",label:"Action"});

                        var get_column_name = data.data.map(column => column.name)
                        var get_column_name_  = [...get_column_name,"id"];
                        this.columns = get_column_name_;
                        
                        // cache
                        const cache = {};
                        cache[this.module] = this.columns_header;
                        const set_column_header_cache = {...column_header_cache,...cache}
                        localStorage.setItem("column_header",JSON.stringify(set_column_header_cache))
                        // end cache
                        this.list_function()
                        //this.loading = false;
                    } catch (error) {
                        
                    }
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
        },
    },
    persist: true,
})