<template>
    <div>
        <Modal
            :activeModal="openFilterModal"
            @close="closeModal"
            title="Filter"
        >
        </Modal>
    </div>
</template>

<script>
import Button from '@/components/Button';
import Modal from '@/components/Modal';
export default {
    components:{
        Modal
    },  
    props:{
        openFilterModal:{
            type:Boolean,
            default:false
        }
    },
    methods:{
        closeModal(){
            this.$emit('closeFilterModal',false);
        }
    }
}
</script>

<style>

</style>