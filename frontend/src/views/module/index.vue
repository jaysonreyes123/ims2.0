<template>
    <div>
        <Breadcrumb/>
        <div class="lg:grid lg:grid-cols-2 mb-2">
            <div class="flex">
                    <!-- <InputGroup class="w-3/5" type="text" placeholder="Search" appendIcon="heroicons-outline:search" /> -->
                    <InputGroup class="w-3/5" type="text" v-model="list_store.search" placeholder="Search...">
                    <template v-slot:append>
                        <Button :disabled="list_store.filter_data.length > 0 ? true : false" @click="searchBtn" icon="heroicons-outline:search" 
                            btnClass="btn-outline-dark disabled:bg-slate-300 disabled:cursor-not-allowed" />
                    </template>
                    </InputGroup>
                    <div>
                        <Button
                        :disabled="is_search ? true : false "
                        icon="heroicons-outline:adjustments-horizontal"
                        text="Filters"
                        btnClass="btn-outline-dark ml-2 py-2 disabled:bg-slate-300 disabled:cursor-not-allowed"
                        @click="filterModalBtn"
                    />
                    <Button
                        v-if="list_store.filter_data.length > 0"
                        icon="heroicons-outline:x-mark"
                        text="Clear Filter"
                        btnClass="btn-outline-danger ml-2 py-2"
                        @click="clearFilter"
                    />
                    <Button
                        v-if="is_search"
                        icon="heroicons-outline:x-mark"
                        text="Clear Search"
                        btnClass="btn-outline-danger ml-2 py-2"
                        @click="clearSearch"
                    />
                    </div>
            </div>
            <div>
                <div class="lg:float-right">
                    <router-link :to="{name:'edit',params:{module:this.$route.params.module}}">
                        <Button
                        icon="heroicons-outline:plus"
                        :text="`New ${this.$route.params.module}`"
                        btnClass="btn-danger mr-2 py-2"
                        />
                    </router-link>
                    <Button
                    icon="heroicons-outline:arrow-down-tray"
                    text="Import"
                    btnClass="btn-outline-danger py-2"
                    @click="importModalbtn"
                    />
                </div>
            </div>
        </div>
        <List/>
        <Import :openModal="openModal" @closeModal="closeModal" />
        <Filter_modal :openFilterModal="openFilterModal" @closeFilterModal="closeFilterModal" />
    </div>
</template>
<script>
import InputGroup from "@/components/InputGroup";
import Breadcrumb from "../components/Breadcrumb.vue";
import Textinput from "@/components/Textinput";
import Button from '@/components/Button';
import Icon from "@/components/Icon";
import List from "./list/list.vue";
import Filter_modal from "./list/filter_modal.vue";
import Import from "./import/import.vue";
import { useListStore } from "@/store/list";
import { ref } from "vue";
const list_store = useListStore();
const is_search = ref(false);
export default {
    components:{
        Breadcrumb,
        Textinput,
        Button,
        Icon,
        InputGroup,
        List,
        Import,
        Filter_modal
    },
    data(){
        return{
            openModal:false,
            openFilterModal:false,
            list_store,
            is_search
        }
    },
    created(){
        this.$watch(
            ()=>this.$route.params.module,
            (modules) => {
                list_store.search = "";
                is_search.value = false;
            }
        )
    },  
    methods:{
        importModalbtn(){
            this.openModal = true;
        },
        closeModal(value){
            this.openModal = value;
        },
        filterModalBtn(){
            this.openFilterModal = true;
        },
        closeFilterModal(value){
            this.openFilterModal = value;
        },
        clearFilter(){
            list_store.filter_data = [];
            list_store.List(this.$route.params.module);
        },
        clearSearch(){
            list_store.search = "";
            is_search.value = false;
            list_store.List(this.$route.params.module);
        },
        searchBtn(){
            if(list_store.search != ""){
                is_search.value = true;
                list_store.List(this.$route.params.module);
            }
        }
    }
}
</script>

<style>
</style>