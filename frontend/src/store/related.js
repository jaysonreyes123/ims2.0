import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
import { useDropdownStore } from "./dropdown";
import { useModuleStore } from "./module";
const module_store = useModuleStore();
const dropdown_store = useDropdownStore();
const toast = useToast(); 
export const useRelatedStore = defineStore('related',{
    state:()=>{
        return{
            select_list_modal:false,
            modal:false,
            loading:false,
            id:"",
            module:"",
            related_module:"",
            method:"",
            related_menu:[],
            columns:[],
            columns_header:[],
            filter_data:[],
            list_data:[],
            list_data_remove_relation:[],
            search:"",
            page:{
                total:0,
                current:1,
                per_page:0
            },
            data:[],
            required_field:{},
            form:{},
            blocks:[]
        }
    },
    getters:{

    },
    actions:{
        async get_related_menu(module_id){
            try {
                const response = await this.axios.get('get_related_menu/'+module_id);
                this.related_menu = response.data.data;
            } catch (error) {
                
            }
        },
        async get_column(module_id,modules,related_modules){
            const column_header_cache = JSON.parse(localStorage.getItem('related_column_header'));
                const check_if_exist = column_header_cache == null ? false : column_header_cache.hasOwnProperty(related_modules);
                //cache column if not exist to current local storage
                if(check_if_exist){
                    column_header_cache[related_modules].map(item=>{
                        this.columns.push(item.name);
                    })
                    this.columns.push("id");
                    this.columns_header = column_header_cache[related_modules];
                    this.get_related_list(module_id,modules,related_modules);
                }
                else{
                    try {
                        this.loading = true;
                        const response = await this.axios.get("list/columns",{
                            params:{
                                module:related_modules
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
                        cache[related_modules] = this.columns_header;
                        const set_column_header_cache = {...column_header_cache,...cache}
                        localStorage.setItem("related_column_header",JSON.stringify(set_column_header_cache))
                        // end cache
                        this.get_related_list(module_id,modules,related_modules);
                        //this.loading = false;
                    } catch (error) {
                        
                    }
                }
        },
        async get_related_list(module_id,modules,related_modules,option = 0){
            try {
                this.loading = true;
                const response = await this.axios.get('get_related_list/'+module_id+"/"+modules+"/"+related_modules+"?page="+this.page.current,{
                    params:{
                        search:this.search,
                        option:option
                    }
                });
                const data = response.data.data;
                if(option == 1){
                    this.list_data_remove_relation = data.data;
                }
                else{
                    this.list_data = data.data;
                }
                this.page.total = data.total;
                this.page.per_page = data.per_page;
                this.loading = false;
            } catch (error) {
                
            }
        },
        claer(){
            this.form = {};
            this.data = [],
            this.required_field = {}
        },
        async generate(field){
            try {
                this.loading = true;
                const response = await this.axios.get("module/generate/"+this.related_module);
                this.form[field] = response.data;
                this.loading = false;
                
            } catch (error) {
                
            }
        },
        set_form(fields){
            this.required_field = [];
            this.form  = Object.assign(this.form,{module:this.module,id:"",related_id:"",created_at:"",updated_at:"",created_by:"",updated_by:""});
            fields.map(item=>{
              item.fields.map(item2=>{
                  const fields_ = {};
                  fields_[item2.name] = item2.default_value == null ? "" : item2.default_value ;
                  this.form = Object.assign(this.form,fields_);
                  if(item2.type == 'dropdown'){
                      dropdown_store.get_dropdown(item2.name);
                  }
                  else if(item2.type == 'generate'){
                      if(this.id == "" || this.id === undefined ){
                          this.generate(item2.name)
                      }
                  } 
                  if(item2.required == 1){
                      const required_field = {};
                      required_field[item2.name] = item2.label;
                      this.get_required_field(required_field)
                  }
              })
            })
          },
        get_required_field(field){
            this.required_field = Object.assign(this.required_field,field);
        },
        async get_edit_form(id,related_id){
           try {
                ///this.claer();
                this.loading = true;
                const response = await this.axios.get("module/edit/form/"+this.related_module+"/detail");
                const data = response.data.data;
                this.id = id;
                this.set_form(data.blocks)
                this.data = response.data.data;
                if(related_id != ""){
                    this.get(id,related_id)
                }
                else{
                    this.loading = false;
                }
           } catch (error) {
            
           }
        },
        async get(id,related_id){
            try {
                this.loading = true;
                const response = await this.axios.get("module/"+related_id,{
                    params:{
                        module:this.related_module
                    }
                });
                const data = response.data.data;
                const form_key = Object.keys(this.form);
                form_key.map(item=>{
                    if(item != "module" && item != "id"){
                        this.form[item] = data[item];
                    }
                })
                this.form.id = parseInt(id);
                this.form.related_id = related_id;
               this.loading = false;
           } catch (error) {
           }
        },
        async save(){
            try {
                this.loading = true;
                this.form.related_module = this.related_module;
                this.form.module = this.module;
                const response = await this.axios.post("save_relation",this.form);
                this.loading = false;
                this.get_column(this.form.id,this.form.module,this.form.related_module);
                this.modal = false;
            } catch (error) {
                
            }
        },
        async delete(module,related_module,id,related_id,index){
            try {
                this.loading = true;
                const response = await this.axios.get("related/delete/"+module+"/"+related_module+"/"+id+"/"+related_id);
                if(response.data.data == 1){
                    this.list_data.splice(index,1);
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
        async save_selected_row(form){
            try {
                this.loading = true;
                const response = await this.axios.post("related/save_selected_row",form);
                this.get_related_list(form.id,form.module,form.related_module);
                this.select_list_modal = false;
            } catch (error) {
                
            }
        },
        async get_related_block(){
            try {
                this.loading = true;
                const response = await this.axios.get("related/get_related_blocks/"+this.module+"/"+this.related_module);
                this.blocks = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        }
    },
    persist:true
})