
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
import { useDropdownStore } from "./dropdown";
const toast = useToast();
const dropdown_store = useDropdownStore();
export const useReportStore = defineStore('report', {
    state: () => {
        return {
            module:"",
            loading:false,
            fields_list:[],
            module_list:[],
            columns:[],
            generate_report_list:[],
            relation_module:[],
            data:[],
            form:{
                modules:"",
                type:"",
                group_by:"",
                data_field:"",
                report_name:"",
                selected_column:[],
                related_module:[],
                chart:{
                    type:"",
                    dataset:[],
                    group_by:""

                },
                filter:[
                    {
                        field:"",
                        operator:"",
                        type:"text",
                        value:""
                    },
                ],
            }
        }
    },
    actions: {
        async report_list(){
            this.loading = true;
            const response = await this.axios.get("reports/"+this.id,{
                params:{
                    limit:100
                }
            });
            const data = response.data.data;
            this.generate_report_list = data; 
            this.loading = false;
        },
        async get_chart(id){
            this.loading = true;
            const response = await this.axios.get("reports/get_chart/"+id);
            this.loading = false;
        },
        async get_fields(){
            try {
                this.loading = true;
                this.fields_list = [];
                this.form.selected_column = [];
                const response = await this.axios.post("reports/get_fields",{module:this.form.modules,related_module:this.form.related_module});
                const data = response.data.data;
                const keys = Object.keys(data);
                keys.map(key=>{
                    this.fields_list.push({label:key,header:true})
                    data[key].map(item=>{
                        const item_ = item.table+"."+item.name;
                        this.fields_list.push({label:item.label,value:item_,type:item.type,header:false})
                    })
                })
                // const current_selected_column = this.form.selected_column;
                // this.form.selected_column = [];
                // current_selected_column.map(item=>{
                //     this.form.selected_column.push(item);
                // })
                this.loading = false;
           } catch (error) {
            
           }
        },
        async get_relation_module(){
                try {
                    this.loading = true;
                    this.fields_list = [];
                    this.form.related_module = [];
                    this.relation_module = [];
                    const response = await this.axios.get("get_related_menu/"+this.module);
                    response.data.data.map(item=>{
                        this.relation_module.push({value:item.related_menus.name,label:item.label});
                    })
                    this.loading = false;
                    
                } catch (error) {
                    
                }
        },
        async get_single_data(){
            try {
                this.loading = true;
                const response = await this.axios.get("reports/"+this.id+"/edit");
                const data = response.data.data;
                this.form.report_name = data.report_name;
                this.form.type = data.type;
                this.form.group_by = data.group_by;
                this.form.data_field = data.data_field;
                this.form.pin = data.pin;
                this.form.modules = data.modules;
                this.data = data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get(){
            try {
                this.get_relation_module();
                this.form.selected_column = [];
                this.form.filter = [];
                this.loading = true;
                const response = await this.axios.get("reports/"+this.id+"/edit");
                const data = response.data.data;
                this.form.modules = data.modules;
                this.form.report_name = data.report_name;
                this.form.related_module = JSON.parse(data.related_module);
                if(data.type == 'list'){
                    data.report_conditions.map((item,index)=>{
                        let sub_data = {};
                        let value = item.value;
                        if(item.type == 'picklist'){
                            this.load_picklist(item.column);
                            value = parseInt(item.value);
                        }
                        sub_data['field'] = item.column;
                        sub_data['operator'] = item.operator;
                        sub_data['value'] = value;
                        sub_data['type'] = item.type;
                        this.form.filter.push(sub_data);
                    });
                }
                else{
                    this.form.chart.type = data.report_charts.chart;
                    this.form.chart.dataset = JSON.parse(data.report_charts.dataset)
                    this.form.chart.group_by = data.report_charts.groupby
                }
                
                this.loading = false;
                
            } catch (error) {
                
            }
        },
        async get_report_column(){
            this.columns = [];
            this.loading = true;
            const response = await this.axios.get("reports/get_columns/"+this.id);
            const data = response.data.data;
            data.report_columns.map(item=>{
                const sub_column = {};
                sub_column["label"] = item.label;
                sub_column["field"] = item.column.replace(".","_");
                this.columns.push(sub_column);
            })
           this.report_list();
        },
        async save(){
            try {
                this.loading = true;
                let response;
                if(this.id == ""){
                    response = await this.axios.post("reports",this.form);
                  
                    this.id = response.data.data.id;
                }
                else{
                    response = await this.axios.put("reports/"+this.id,this.form);
                }   
                this.loading = false;
                
                this.router.push({
                    name:"generate",
                    params:{
                        id:this.id,
                        module:"reports",
                    }
                });
                
            } catch (error) {
                
            }
        },
        async report_export(type){
            try {   
                this.loading = true;
                const response = await this.axios.get("reports/generate/export/"+type+"/"+this.id,{
                    responseType:'blob'
                });
                const href = URL.createObjectURL(response.data);
                const link = document.createElement('a');
                link.href = href;
                link.setAttribute('download',this.form.report_name+"."+type); //or any other extension
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(href);
                this.loading = false;
            } catch (error) {
                
            }
        }       
    },
    persist: true,
})