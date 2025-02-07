
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
import { useDropdownStore } from "./dropdown";
import Swal from "sweetalert2";
const dropdown_store = useDropdownStore();
const toast = useToast();
export const useModuleStore = defineStore('module', {
    state: () => {
        return {
            loading:false,
            module:"",
            id:"",
            data:[],
            required_field:{},
            form:{}
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
        async get_edit_form(id){
           try {
                this.clear();
                this.loading = true;
                const response = await this.axios.get("module/edit/form/"+this.module);
                const data = response.data.data;
                this.id = id;
                this.set_form(data.blocks)
                this.data = response.data.data;
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
               this.loading = false;
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
    },
    persist: true,
})