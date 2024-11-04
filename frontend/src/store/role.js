import { defineStore } from "pinia";
import { useToast } from "vue-toastification";

const toast = useToast();

export const useUserRoleStore = defineStore("role",{
    state:()=>{
        return {
            moduleName:"User Role",
            action:"add",
            loading:false,
            modal:false,
            roleList:[],
            roleForm:{
                id:null,
                name:"",
                dashboard:true,
                warning:true,
                database:true,
                monitoring:true,
                sensor:true,
                station:true,
                maintenance_warning:true,
                notification:true,
                recipient:true,
                user:true,
                user_role:true,
                system:true,
            }
        }   
    },
    getters:{
        getUserRole(state){
            return state.roleList.map(item => {
                return {
                    label : item.name,
                    value: item.id
                }
            })
    },
    },
    actions:{
        openModal() {
            this.modal = true;
        }, 
        closeModal(){
            this.modal = false;
        },
        resetForm(){
            this.roleForm.id = null;
            this.roleForm.name = "";
            this.roleForm.dashboard = true;
            this.roleForm.warning = true;
            this.roleForm.database = true;
            this.roleForm.monitoring = true;
            this.roleForm.sensor = true;
            this.roleForm.station = true;
            this.roleForm.maintenance_warning = true;
            this.roleForm.recipient = true;
            this.roleForm.notification = true;
            this.roleForm.user = true;
            this.roleForm.user_role = true;
        },
        async load(){
            try {

                this.loading = true;
                let response = await this.axios.get("/user-role");
                this.roleList = response.data.data;
                this.loading = false;
            } catch (err) {
                this.loading = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                }); 
            }
        },
        async save(){
            try {
                this.loading = true;
                if(this.roleForm.id != null){
                     await this.axios.put("/user-role/"+this.roleForm.id,this.roleForm);
                }
                else{
                     await this.axios.post("/user-role",this.roleForm);
                }
                
                this.loading = false;
                this.modal = false;
                this.load();
                toast.success("Successfully saved!", {
                    timeout: 3000,
                });
                
            } catch (err) {
                console.log(err.response.data.errors);
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.errors), {
                    timeout: 3000,
                }); 
            }
        }
    },
    persist:true
})