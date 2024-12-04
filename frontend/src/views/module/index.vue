<template>
    <div>
        <Breadcrumb/>
        <div class="lg:grid lg:grid-cols-2 mb-2">
            <div class="flex">
                    <InputGroup class="w-4/5" type="text" placeholder="Search" prependIcon="heroicons-outline:search" merged />
                    <Button
                        icon="heroicons-outline:adjustments-horizontal"
                        text="Filters"
                        btnClass="btn-outline-dark ml-2 py-2"
                        @click="filterModalBtn"
                    />
             
            </div>
            <div>
                <div class="lg:float-right">
                    <router-link :to="{name:'edit',params:{module:this.$route.params.module}}">
                        <Button
                        icon="heroicons-outline:plus"
                        :text="`Add new ${this.$route.params.module}`"
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
            openFilterModal:false
        }
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
        }
    }
}
</script>

<style>
</style>