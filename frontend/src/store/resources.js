import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useResourcesStore = defineStore("resources",{
    state:()=>{
        return{
            loading:false,
            ResourceList:[],
            ResourceType:[],
            ResourceCondition:[],
            ResourceDispatch:[],
            ResourceStatus:[],
            id:"",
            form:{
                resources_name:"",
                resources_type:"",
                resources_status:"",
                coordinates:"",
                dispatch:"",
                condition:"",
                quantity:1,
                contact_info:"",
                date_acquired:"",
                remarks:""
            }
        }
    },
    getters:{
        getResourceType(state){
            return state.ResourceType.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },
        getResourceStatus(state){
            return state.ResourceStatus.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },
        getResourceCondition(state){
            return state.ResourceCondition.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },
        getResourceDispatch(state){
            return state.ResourceDispatch.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },

        getSingleResourceType(state){
            return (id) => state.ResourceType.find((value) => value.id == id );
        },
        getSingleResourceStatus(state){
            return (id) => state.ResourceStatus.find((value) => value.id == id );
        },
        getSingleResourceDispatch(state){
            return (id) => state.ResourceDispatch.find((value) => value.id == id );
        },
        getSingleResourceCondition(state){
            return (id) => state.ResourceCondition.find((value) => value.id == id );
        },
 
    },
    actions:{
        clearField(){
            this.loading = true;
            const keys = Object.keys(this.form);
            keys.map(item=>{
                if(item == "quantity"){
                    this.form[item] = 1;
                }
                else{
                    this.form[item] = "";
                }
            })
            this.id = "";
            this.loading = false;
        },
        async list(){
            try {
                this.loading = true;
                const response = await this.axios.get('resources');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('resources/'+this.id);
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
                    const response = await this.axios.post("resources",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("resources/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"resources"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("resources/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get_resources_type(){
            try {
                const response = await this.axios.get("resources_type");
                this.ResourceType = response.data.data;
            } catch (error) {
                
            }
        },
        async get_resources_status(){
            try {
                const response = await this.axios.get("resources_status");
                this.ResourceStatus = response.data.data;
            } catch (error) {
                
            }
        },
        async get_resources_condition(){
            try {
                const response = await this.axios.get("resources_condition");
                this.ResourceCondition = response.data.data;
            } catch (error) {
                
            }
        },
        async get_resources_dispatch(){
            try {
                const response = await this.axios.get("resources_dispatch");
                this.ResourceDispatch = response.data.data;
            } catch (error) {
                
            }
        },
    },
    persist:true
})