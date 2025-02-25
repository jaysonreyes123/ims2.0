<template lang="">
    <div>
        <div>
            <span class="capitalize font-bold">Workflow</span>
        </div>
        <div class="flex justify-end mb-4">
            <router-link :to="{
                name:'save_workflow'
            }">
                <Button
                    text="New Workflow"
                    btnClass="btn-danger mr-2 py-2"
                    icon="heroicons-outline:plus"
                    iconPosition="left"
                    iconClass="text-lg"
                />
            </router-link>
        </div>
        <div>
            <Card>
                <Table
                :loading="workflow_store.loading"
                :columns="columns"
                :rows="workflow_store.rows"
                :total="workflow_store.page.total"
                :current="workflow_store.page.current"
                @pageChange="pageChange"
                />
            </Card>
        </div>
    </div>
</template>
<script>
import Button from "@/components/Button";
import Icon from "@/components/Icon";
import Table from '../list/table.vue';
import Card from "@/components/Card";
import { useWorkflowStore } from "@/store/workflow";
const workflow_store = useWorkflowStore();
const columns = [
    {
        label:"Workflow Name",
        field:"name"
    },
    {
        label:"Module",
        field:"module"
    },
];
export default {
    components:{
        Table,
        Card,
        Button,
        Icon
    },
    data(){
        return{
            columns,
            workflow_store
        }
    },
    mounted(){
        workflow_store.page.current = 1;
        workflow_store.list();
    },
    methods:{
        pageChange(page){
            workflow_store.page.current = page;
            workflow_store.list();
        }
    }
}
</script>
<style lang="">
    
</style>