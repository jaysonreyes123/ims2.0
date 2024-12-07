import { defineStore } from "pinia";
export const useUserStore = defineStore('users',{
    state:()=>{
        return{
            assigned_to:[],
            id:"",
            form:{
                name:"",
                email:"",
                password:"",
                incident:true,
                resources:true
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
            if(user_id == undefined){

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
            const keys = Object.keys(this.form);
            keys.map(item=>{
                this.form[item] = this.form[item];
            })
            this.id = "";
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
        }
    },
    persist:true
})