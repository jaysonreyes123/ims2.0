<template lang="">
    <div>
        <Modal :title="title" :activeModal="related_store.modal" @close="closeModal" sizeClass="max-w-9xl">
            <save v-if="method == 'edit'" :props_module="this.$route.params.module" :props_related_module="this.$route.params.related_module" />
            <detail v-else-if="method == 'view' " :props_module="related_store.related_module" :props_id="related_store.id" />
        </Modal>
    </div>
</template>
<script>
import Modal from '@/components/Modal';
import Button from '@/components/Button';
import { useRelatedStore } from '@/store/related';
import save from './save.vue';
import detail from '../view/detail.vue';
const related_store = useRelatedStore();
export default {
    props:{
        title:{
            type:String,
            default:""
        },
        method:{
            type:String,
            default:"edit"
        }
    },
    components:{
        Modal,
        Button,
        save,
        detail
    },
    data(){
        return{
            related_store,
        }
    },
    methods:{
        closeModal(){
            related_store.modal = false;
        }
    }
}
</script>
<style>
    .vl-overlay,.vl-full-page{
        z-index: 999 !important;
    }
</style>