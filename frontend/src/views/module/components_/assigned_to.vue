<template lang="">
    <div>
        <div class="fromGroup relative">
            <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">
                Assigned To <span class="text-red-500">*</span>
            </label>
            <Select placeholder="Select an option" @option:selected="selected_assigned" :reduce="option => option.id"  :options="dropdown_store.assigned_to"/>
        </div>
    </div>
</template>
<script>
import Select from "vue-select";
import { useDropdownStore } from "@/store/dropdown";
const dropdown_store = useDropdownStore();
export default {
    props:['assigned_to'],
    emits:['update:assigned_to'],
    components:{
        Select
    },
    data(){
        return{
            dropdown_store
        }
    },
    mounted(){
        dropdown_store.get_assigned_to();
    },
    methods:{
        selected_assigned(event){
            this.$emit("update:assigned_to",event.value);
        }
    }
}
</script>
<style lang="">
    
</style>