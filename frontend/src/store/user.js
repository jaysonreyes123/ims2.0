import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useUserStore = defineStore("user",{
    state:() =>{
        return{
            moduleName:"User",
            loading:false,
            modal:false,
            action:'Add',
            userListData:[],
            userForm:{
                name:"",
                email:"",
                password:"",
                id:null,
                role:""

            }
        }
    },
    getters:{
        getUserlist(state){
            return state.userListData;
        }
    },
    actions:{
        openModal(){
            this.modal = true;
        },
        closeModal(){
            this.modal = false;
        },
        resetForm(){
            this.userForm.name = "";
            this.userForm.email = "";
            this.userForm.password = "";
            this.userForm.id = null;
            this.userForm.role = "";
        },
        async load(){
            try {

                this.loading = true;
                let response = await this.axios.get("/users");
                this.userListData = response.data.data;
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
                if(this.userForm.id != null){
                     await this.axios.put("/users/"+this.userForm.id,this.userForm);
                }
                else{
                     await this.axios.post("/users",this.userForm);
                }
                
                this.loading = false;
                this.modal = false;
                this.load();
                toast.success("Successfully saved!", {
                    timeout: 3000,
                });
                
            } catch (err) { 
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.errors), {
                    timeout: 3000,
                }); 
            }
        },
        async savePassword(id , new_password){
            try {   
                await this.axios.post("/changePass",{
                    new_password : new_password,
                    id: id
                }); 
                this.loading = false;  
                toast.success("Successfully saved!", {
                    timeout: 3000,
                }); 
            } catch (err) { 
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.message), {
                    timeout: 3000,
                }); 
            }
        },
        async checkPassword(id, password, new_password){
            try {
                this.loading = true;
                const response = await this.axios.post("/checkPass",{
                    current_password : password,
                    id: id
                });  
                this.savePassword(id, new_password);
            } catch (err) {  
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.message), {
                    timeout: 3000,
                });
            }
        },
        async deleteUser(id){
            try {
                this.loading = true;
                await this.axios.delete("/users/"+id);
                this.loading = false;
                this.load();
                toast.success("Successfully deleted!", { timeout: 3000 });
            } catch (err) { 
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.errors), {
                    timeout: 3000,
                }); 
            }
        }

    },
    persist:true
})