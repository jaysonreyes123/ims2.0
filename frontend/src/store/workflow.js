import { defineStore } from "pinia";
import { useAuthStore } from "./auth";
import { useDropdownStore } from "./dropdown";
import { useReportStore } from "./report";
const dropdown_store = useDropdownStore();
const auth_store = useAuthStore();
const report_store = useReportStore();
export const useWorkflowStore = defineStore('workflow',{
    state:()=>{
        return{
            loading:false,
            loading2:false,
            modal:false,
            fields_list:[],
            fields_list_action:[],
            required_field:[],
            rows:[],
            page:{
                current:1,
                total:1,
                perpage:15
            },
            form:{
                id:"",
                name:"",
                module:"",
                description:"",
                status:1,
                trigger:1,
                recurrence:1,
                condition:[],
                action:{
                    title:"",
                    type:"",
                    status:"",
                    actions:[]
                }
            }
        }
    },
    actions:{
        async list(){
            try {
                this.loading = true;
                const response = await this.axios.get("workflows?page="+this.page.current);
                this.rows = response.data.data;
                this.page.total = response.data.meta.total;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get(){
            try {
                this.loading = true;
                const response = await this.axios.get("workflows/"+this.form.id+"/edit");
                const data = response.data.data;
                const current_module = auth_store.module.find(module_ => module_.id ==  data.module);
                this.form.id = data.id;
                this.form.module = current_module.name;
                this.form.name = data.name;
                this.form.description = data.description;
                this.form.status = data.status;
                this.form.trigger = data.trigger;
                this.form.recurrence = data.recurrence;
                this.get_fields(data.workflow_conditions);
                this.loading = false;
            } catch (error) {
                
            } 
        },
        async get_fields(conditions = []){
            try {
                this.loading = true;
                this.fields_list = [];
                this.form.selected_column = [];
                const response = await this.axios.post("reports/get_fields",{module:this.form.module});
                const data = response.data.data;
                const keys = Object.keys(data);
                keys.map(key=>{
                    this.fields_list.push({label:key,header:true})
                    data[key].map(item=>{
                        const item_ = item.table+"."+item.name;
                        this.fields_list.push({label:item.label,value:item_,type:item.type,header:false})
                    })
                })
                if(conditions.length > 0){
                    conditions.map(item =>{
                        this.form.condition.push({
                            type:item.type,
                            field:item.field,
                            value:item.value,
                            operator:item.operator
                        });
                    })
                }
                this.loading = false;
           } catch (error) {
            
           }
        },
        async get_fields_action(module_){
            try {
                this.loading = true;
                this.fields_list_action = [];
                this.required_field = [];
                const response = await this.axios.post("reports/get_fields",{module:module_});
                const data = response.data.data;
                const keys = Object.keys(data);
                const field_list_action = [];
                keys.map(key=>{
                    this.fields_list_action.push({label:key,header:true})
                    data[key].map(item=>{
                        const item_ = item.table+"."+item.name;
                        this.fields_list_action.push({label:item.label,value:item_,type:item.type,name:item.name,header:false})
                        if(item.column){
                            if(item.type == 'dropdown'){
                                dropdown_store.get_dropdown(item.name)
                            }
                            this.required_field.push(item_);
                            this.form.action.actions.push({
                                type:item.type,
                                field:item_,
                                name:item.name,
                                value:""
                            });
                        }
                    })
                })
                this.loading = false;
           } catch (error) {
            
           }
        },
        async save(){
            try {
                this.loading = true;
                if(this.form.id == ""){
                    const response = await this.axios.post("workflows",this.form);
                }
                else{
                    const response = await this.axios.put("workflows/"+this.form.id,this.form);
                }
                this.loading = false;
                this.router.push({
                    name: "workflow",
                });
            } catch (error) {
                
            }
        }
    },
    persist:true
})