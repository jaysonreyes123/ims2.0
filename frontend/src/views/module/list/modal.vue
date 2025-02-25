<template>
    <div>
        <Modal :activeModal="openFilterModal" @close="closeModal" title="Filter" sizeClass="max-w-5xl">
            <div class="text-base text-slate-600 dark:text-slate-300">
                <div v-for="(item,i) in filter_store.filter_field" :key="i"
                    class="lg:grid-cols-2 md:grid-cols-2 grid-cols-1 grid gap-5 mb-5 last:mb-0">
                    <div class="fromGroup relative">
                        <label class="flex-0 break-words ltr:inline-block rtl:block input-label">
                            Select Field
                        </label>
                        <Select @option:selected="picklist_event($event,i)" :reduce="(option) => option.value" placeholder="Select an option"
                            :options="filter_store.getDropdownFilter" v-model="item.field" 
                        />
                    </div>
                    <div class="flex justify-between items-end space-x-5">
                        <div class="flex-1">
                            <Textinput v-if="
                                filter_store.filter_field[i].type == 'text' || 
                                filter_store.filter_field[i].type == 'number' || 
                                filter_store.filter_field[i].type == 'generate'
                                " 
                                placeholder=""
                                class="flex-1" 
                                v-model="item.value"
                            />

                            <Select v-else-if="filter_store.filter_field[i].type == 'dropdown'" :options="dropdown_store.dropdownlist[item.field]" :reduce="(option) => option.label" v-model="item.value"
                                placeholder="Select an option" class="p-1" 
                            />
                            <flat-pickr v-else-if="filter_store.filter_field[i].type == 'time'" class="form-control" placeholder="HH:mm"
                                :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00', time_24hr: true, minuteIncrement: 1 }" v-model="item.value" />
                            <flat-pickr v-else-if="filter_store.filter_field[i].type == 'date' "  class="form-control"
                                placeholder="yyyy-mm-dd" v-model="item.value" :config="{ dateFormat: 'Y-m-d' }" />
                        </div>
                        <div class="flex-none relative w-14">
                            <button v-if="i !== 0" type="button"
                                class="inline-flex items-center justify-center h-10 w-10 bg-danger-500 text-lg border rounded border-danger-500 text-white"
                                @click="removeCondition(i)">
                                <Icon icon="heroicons-outline:trash" />
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-start">
                    <Button icon="heroicons-outline:plus" text="Add Condition"
                        btnClass="btn-outline-dark btn-sm"
                        @click="addCondition" />
                </div>
            </div>
            <template class="" v-slot:footer>
                <div class="w-full px-3 flex justify-between">
                    <Button text="Close" btnClass="btn-dark btn-sm" @click="closeModal()" />
                    <Button text="Save Filter" btnClass="btn-danger btn-sm" @click="SaveFilter()" />
                </div>
            </template>
        </Modal>
    </div>
</template>

<script>
import Button from '@/components/Button';
import Modal from '@/components/Modal';
import InputGroup from "@/components/InputGroup";
import Textinput from "@/components/Textinput"
import Icon from "@/components/Icon";
import Select from "vue-select";
import { useFilterStore } from '@/store/filter';
import { useDropdownStore } from '@/store/dropdown';
import { useListStore } from '@/store/list';
const list_store = useListStore();
const filter_store = useFilterStore();
const dropdown_store = useDropdownStore();
export default {
    components:{
        Modal,
        Button,
        InputGroup,
        Textinput,
        Icon,
        Select,
    },  
    data(){
        return{
            filter_store,
            dropdown_store
        }
    },
    created(){
        this.$watch(
            ()=>this.$route.params.module,
            (modules) => {
                this.ClearFilter();
                filter_store.module = modules;
                filter_store.get_fields();
            }
        )
    },
    mounted(){
            filter_store.module = this.$route.params.module;
            filter_store.get_fields();
    },
    props:{
        openFilterModal:{
            type:Boolean,
            default:false
        }
    },
    methods:{
        picklist_event(event,position){
            filter_store.filter_field[position].value = "";
            filter_store.filter_field[position].type = event.type;
            if(event.type == 'dropdown') {
                console.log(event)
                dropdown_store.get_dropdown(event.value);
            }
        },
        closeModal(){
            this.$emit('closeFilterModal',false);
        },
        addCondition(){
            if(filter_store.filter_field.length < 3){
                filter_store.filter_field.push(
                    {
                        field:"",
                        value:"",
                        type:"text"
                    }
                );
            }
        },
        removeCondition(index){
            filter_store.filter_field.splice(index,1)
        },
        ClearFilter(){
            filter_store.filter_field = ([{field:"",value:"",type:"text"}])
        },
        SaveFilter(){
            list_store.filter_data = filter_store.filter_field;
            list_store.list_function(this.$route.params.module)
            this.ClearFilter();
            this.$emit('closeFilterModal',false);
        },
    },
}
</script>

<style>
#headlessui-dialog-panel-9{
    overflow: unset !important;
}
</style>