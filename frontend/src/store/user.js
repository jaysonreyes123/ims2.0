import { defineStore } from "pinia";
import Swal from 'sweetalert2';
import { user_fields } from "@/views/module/fields/user";
export const useUserStore = defineStore('users',{
    state:()=>{
        return{
            assigned_to:[],
            roles_picklist:[],
            id:"",
            form:{
                name:"",
                email:"",
                password:"",
                roles_picklist:"",
                user_privileges:{
                    incidents:false,
                    resources:true,
                    preplans:true,
                    contacts:true,
                    agencies:true,
                    responders:true,
                    incident_map:true,
                    users:true
                }
            }
        }
    },
    getters:{
        assigned_to_picklist(state){
            return state.assigned_to.map(item=>{
                return{
                    id:item.id,
                    label:item.name
                }
            })
        },
        get_single_assigned_to_picklist: (state) => (user_id)=> {
            if(user_id == undefined || user_id == ""){

            }
            else{
                const user_details = state.assigned_to.find(filter => filter.id == user_id)
                return user_details.name;
            }
            
        }
    },
    actions:{
        clearField(){
            this.loading = true;
            this.form.user_privileges = {}
            this.form.id = "";
            user_fields.map(item=>{
                item.fields.map(item2=>{
                    const split_name = item2.name.split(".");
                    if(split_name.length == 1){
                        this.form[item2.name] = item2.default;
                    }
                    else{
                        this.form['user_privileges'][split_name[1]] = item2.default;
                    }
                })
            });
            this.loading = false;
        },
        async list(){
            try {
                this.loading = true;
                const response = await this.axios.get('users');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('users/'+this.id);
            const keys = Object.keys(this.form);
            const data = response.data.data;
            keys.map(item=>{
                this.form[item] = response.data.data[item];  
            })
            console.log(this.form)
            this.loading = false;
        },
        async save(){
            try {
                this.loading = true;
                if(this.id == ""){
                    const response = await this.axios.post("users",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    this.form["id"] = this.id;
                    await this.axios.put("users/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"users"
                    }
                });
            } catch (error) {
                const error_details = error.response;
                console.log(error)
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
                    this.loading = false;
                }
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("users/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get_assigned_to(){
            try {
                const response = await this.axios.get("get_assigned_to");
                this.assigned_to = response.data.data;
            } catch (error) {
                
            }
        },
        async get_role(){
            try {
                const response = await this.axios.get("get_role");
                this.roles_picklist = response.data.data;
            } catch (error) {
                
            }
        }, 
    },
    persist:true
})