<template>
  <div>
    <Card title="Duplicate record handling" class="shadow">
        <div class="fromGroup relative mt-5">
            <label for="" class="inline-block input-label">Select how duplicate records should be handled</label>
            <Select placeholder="Select an option" v-model="ImportStore.duplicate_handling_option" @change="duplicate_handling_event" :options="options" />
        </div>
        <div class="fromGroup relative" v-if="ImportStore.duplicate_handling_option != 1">
            <p class="mt-5">Select the matching fields to find duplicate records</p>
            <label for="" class="inline-block input-label">Available fields</label>
            <select @change="duplicate_handling_field_event" v-model="duplicate_handling_field" class="text-sm" multiple style="width: 100%;border: 1px solid #ccc;height: 200px;">
                <option value="" selected disabled>Select an option</option>
                <option :value="item.value" v-for="(item,index) in select" :key="index" >
                    {{ item.label }}
                </option>
            </select>
        </div>
    </Card> 
  </div>
</template>

<script>
import Card from "@/components/Card";
import Select from "@/components/Select";
import { useImportStore } from "@/store/import";
const ImportStore = useImportStore();
const options = [
    {
        value:1,
        label:"Skip this step"
    },
    {
        value:2,
        label:"Skip"
    },
    {
        value:3,
        label:"Update"
    }
];
export default {
    props:{
        modulefields:{
            type:Array,
        }
    },
    components:{
        Card,
        Select,
    },
    data(){
        return{
            options,
            duplicate_handling_field:[],
            select:[],
            ImportStore
        }
    },
    created(){
        this.formSelect(this.modulefields);
    },
    methods:{
        formSelect(data){
            data.map(item=>{
                if(item.duplicate_handling){
                    this.select.push(
                        {
                            label:item.label,
                            value:item.name
                        }
                    );
                }
            })
            return  this.select;
        },
        duplicate_handling_event(){
            this.$emit("duplicate_handling_option",ImportStore.duplicate_handling_option);
        },
        duplicate_handling_field_event(){
            this.$emit("duplicate_handling_field",this.duplicate_handling_field);
        }
    }

}
</script>

<style>

</style>