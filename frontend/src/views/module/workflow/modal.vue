<template lang="">
    <div>
        <Modal 
            :title="title" 
            @close="closeModal" 
            :activeModal="workflow_store.modal" 
            sizeClass="max-w-7xl"
        >
            <create v-if="action == 'create'"/>
            <div slot="footer" class="mt-8 flex justify-center items-center">
                <Button
                    @click="SaveAction"
                    text="Save"
                    btnClass="btn-success btn-md px-6"
                />
                <Button
                    @click="closeModal"
                    text="Cancel"
                    btnClass="text-danger-500"
                />
            </div>
        </Modal>
    </div>
</template>
<script>
import create from './create.vue';

import Modal from '@/components/Modal';
import Button from '@/components/Button';
import { useWorkflowStore } from '@/store/workflow';
const workflow_store = useWorkflowStore();
export default {
    props:{
        action:{
            type:String,
            default:""
        }
    },
    components:{
        Modal,
        Button,
        create
    },
    data(){
        return{
            workflow_store
        }
    },
    computed:{
        title(){
            let title_ = "";
            switch (this.action) {
                case 'create':
                    title_ = "Create Record"
                    break;
                case 'update':
                title_ = "Update Fields"
                    break;
                default:
                    break;
            }
            return title_;
        }
    },
    created(){
        this.$watch(
            ()=>this.action,
            (action) => {
                console.log(action)
            }
        )
    },
    methods:{
        closeModal(){
            workflow_store.modal = false;
        },
        SaveAction(){
            console.log(workflow_store.form.action.actions.map(action => action.field));
        }
    }
}
</script>