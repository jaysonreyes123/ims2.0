
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
import { useDropdownStore } from "./dropdown";
import Swal from "sweetalert2";
import { useListStore } from "./list";
const list_store = useListStore();
const dropdown_store = useDropdownStore();
const toast = useToast();
export const useModuleStore = defineStore('module', {
    state: () => {
        return {
            loading:false,
            module:"",
            entityname_field:"",
            entityname:"",
            id:"",
            data:[],
            required_field:{},
            form:{},
            summary:0,
            blocks:[],
            relation_field:{},
            error:false
        }
    },
    actions: {
        clear(){
            this.form = {};
            this.data = [],
            this.required_field = {}
        },
        async generate(field){
            try {
                this.loading = true;
                const response = await this.axios.get("module/generate/"+this.module);
                this.form[field] = response.data;
                this.loading = false;
                
            } catch (error) {
                
            }
        },
        set_form(fields){
          this.required_field = [];
          this.form  = Object.assign(this.form,{module:this.module,id:"",created_at:"",updated_at:"",created_by:"",updated_by:""});
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
                else if(item2.type == 'relation'){
                    const relation_field = {};
                    relation_field[item2.name] = "";
                    this.relation_field = Object.assign(this.relation_field,relation_field);
                    this.set_single_item(item2.id,item2.name);
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
        view_set_form(fields){
            this.required_field = [];
            this.form  = Object.assign(this.form,{module:this.module,id:"",created_at:"",updated_at:"",created_by:"",updated_by:""});
            fields.map(item=>{
              item.fields.map(item2=>{
                  const fields_ = {};
                  fields_[item2.name] = item2.default_value == null ? "" : item2.default_value ;
                  this.form = Object.assign(this.form,fields_);

                  if(item2.type == 'relation'){
                    const relation_field = {};
                    relation_field[item2.name] = "";
                    this.relation_field = Object.assign(this.relation_field,relation_field);
                    this.set_single_item(item2.id,item2.name);
                }
              })
            })
          },
        async get_edit_form(id,option = 'save'){
           try {
                this.clear();
                this.loading = true;
                const response = await this.axios.get("module/edit/form/"+this.module+"/"+option);
                const data = response.data.data;
                this.blocks = data.blocks;
                this.id = id;
                this.data = response.data.data;
                this.entityname_field = response.data.data.entityname;
                if(option == 'save'){
                    this.set_form(data.blocks)
                }
                else if(option == 'detail' || option == 'summary'){
                    this.view_set_form(data.blocks);
                }
                if(id != "" && id !== undefined){
                    this.get(id);
                }
                else{
                    this.loading = false;
                }
           } catch (error) {
            
           }
        },
        async get(id){
            try {
                this.loading = true;
                let response;
                response = await this.axios.get("module/" + id, {
                    params: {
                        module: this.module
                    }
                });
                const data = response.data.data;
                const form_key = Object.keys(this.form);
                form_key.map(item=>{
                    if(item != "module"){
                        this.form[item] = data[item];
                    }
                })
                //entity
                this.entityname_func();
               this.loading = false;
           } catch (error) {
           }
        },
        entityname_func(){
            this.entityname = "";
            const entityname_field = this.entityname_field.split(",");
            entityname_field.map(item=>{
                const entity = this.form[item] == null ? "" : this.form[item];
                this.entityname+=entity+" ";
            })
        },
         async get_summary(){
            try {
                this.summary = 0;
                const response =  await this.axios.get("module/get_summary/"+this.module);
                this.summary = response.data.data;
           } catch (error) {
           }
        },
        async save(){
            try {
                this.loading = true;
                if (this.form.id == "") {
                    const response = await this.axios.post("module", this.form);
                    this.form.id = response.data.data;
                }
                else {
                    const response = await this.axios.put("module/" + this.form.id, this.form);
                }
                this.router.push({
                    name: "view",
                    params: {
                        id: this.form.id,
                        module: this.form.module,
                        action: "detail"
                    }
                });
                this.loading = false;
            }
            catch (error) {
                const error_details = error.response;
                if(error_details.status == 422){
                   const errors = Object.values(error_details.data.errors);
                   var error_value = "";
                    errors.map((item,index)=>{
                        error_value+=`<p class="text-red-500">${item[0]}</p>`;
                    })
                    Swal.fire({
                        icon: "error",
                        title: "Something wrong",
                        html:error_value,
                    });
                }
                else if(error_details.status == 500){
                    Swal.fire({
                        icon: "error",
                        title: "Something wrong",
                        html:error_details.data.message,
                    });
                }
                this.loading = false;
            }
        },
        async save_profile(){
            try {
                this.loading = true;
                if(this.id == ""){
                    const response = await this.axios.post("module",this.form);
                }
                else{
                    await this.axios.put("module/"+this.form.id,this.form);
                }  
                    this.router.push({
                        name:"profile",
                    });
                this.loading = false;
            }
            catch (error) {
                const error_details = error.response;
                if(error_details.status == 422){
                   const errors = Object.values(error_details.data.errors);
                   var error_value = "";
                    errors.map((item,index)=>{
                        error_value=`<p class="text-red-500">${item[index]}</p>`;
                    })
                    Swal.fire({
                        icon: "error",
                        title: "Something wrong",
                        html:error_value,
                    });
                }
                else if(error_details.status == 500){
                    Swal.fire({
                        icon: "error",
                        title: "Something wrong",
                        html:error_details.data.message,
                    });
                }
                console.log(error_details)
                this.loading = false;
            }
        },
        async get_single_item(module,id,field){
            try {
                this.loading = true;
                const response = await this.axios.get("module/get_single_item/"+module+"/"+id);
                const data = response.data.data;
                this.relation_field[field] = data.entityname;
                this.form[field] = id;
                this.loading = false;
                list_store.modal = false;
            } catch (error) {
                
            }
        },
        async set_single_item(fieldid,fieldname){
            try {
                const response = await this.axios.get("module/set_single_item/"+this.id+"/"+fieldid+"/"+fieldname);
                const data = response.data.data;
                this.relation_field[fieldname] = data.entityname;
            } catch (error) {
                
            }
        }
    },
    persist: true,
})