import { defineStore } from "pinia";
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useImportStore = defineStore('import',{
    state:()=>{
        return{
            loading:true,
            stepNumber:0,
            duplicate_handling_option:1,
            get_single_row:[],
            import_result:[]
        }
    },
    getters:{
        getRecordCreated(state){
            return state.import_result.filter(item => item.status == 1 );
        },
        getSkipResult(state){
           return state.import_result.filter(item => item.status == 2 );
        },
        getUpdateResult(state){
            return state.import_result.filter(item => item.status == 3 );
         },
    },
    actions:{
        async getImport(form){
            try {
                this.loading = true;
                const response = await this.axios.post("import/get_single_data",form,{
                    headers:{
                        'Content-type' : 'multipart/form-data'
                    }
                })
                this.get_single_row = response.data;
                this.stepNumber++;
                this.loading = false;
                console.log(response);
            } catch (error) {
                
            }
        },
        async saveImport(forms){
            try {
                this.loading = true;
                const response = await this.axios.post("import/save_import",forms,{
                    headers:{
                        'Content-type' : 'multipart/form-data'
                    }
                })
                this.stepNumber++;
                this.loading = false;
                this.import_result = response.data.data;
            } catch (error) {
                
            }
        },
    },
    persist:true
});