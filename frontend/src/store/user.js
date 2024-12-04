import { defineStore } from "pinia";
export const useUserStore = defineStore('user',{
    state:()=>{
        return{
            assigned_to:[]
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