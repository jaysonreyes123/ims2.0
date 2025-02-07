import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
import { useDropdownStore } from "./dropdown";
const dropdown_store = useDropdownStore();
const toast = useToast(); 
export const useRelatedStore = defineStore('related',{
    state:()=>{
        return{
            modal:false,
            loading:false,
            id:"",
            module:"",
            related_module:"",
            related_menu:[],
            columns:[],
            columns_header:[],
            filter_data:[],
            list_data:[],
            search:"",
            page:{
                total:0,
                current:1,
                per_page:0
            },
            data:[],
            required_field:{},
            form:{}
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
            try {
                this.loading = true;
                const response = await this.axios.get("list/columns",{
                    params:{
                        module:related_modules
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
                this.get_related_list(module_id,modules,related_modules);
            } catch (error) {
                
            }
        },
        async get_related_list(module_id,modules,related_modules){
            try {
                this.loading = true;
                const response = await this.axios.get('get_related_list/'+module_id+"/"+modules+"/"+related_modules+"?page="+this.page.current);
                const data = response.data.data;
                this.list_data = data.data;
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
                const response = await this.axios.get("module/edit/form/"+this.related_module);
                const data = response.data.data;
                this.id = id;
                this.set_form(data.blocks)
                this.data = response.data.data;
                if(related_id != ""){
                    this.get(id,related_id)
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
        }
    },
    persist:true
})