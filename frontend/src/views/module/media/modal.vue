<template lang="">
    <div>
        <Modal :title="media.title" :activeModal="media.modal" @close="closeModal" sizeClass="max-w-5xl">
            <Media v-if="media.title == 'Media' " />
            <Preview v-if="media.title == 'Preview'" :preview-content="previewContent" />
        </Modal>
    </div>
</template>
<script>
import Modal from '@/components/Modal';
import Button from '@/components/Button';
import { useMediaStore } from '@/store/media';
import Media from "./add_media.vue";
import Preview from "./preview.vue";
import { ref } from 'vue';
const media = useMediaStore();
const modal_title = ref("Media");
export default {
    props:{
        previewContent:{
            default:"",
            type:String
        }
    },
    components:{
        Modal,
        Button,
        Media,
        Preview
    },
    data(){
        return{
            media,
        }
    },
    methods:{
        closeModal(){
            media.form.files = [];
            media.modal = false;
        }
    }
}
</script>
<style>
    .vl-overlay,.vl-full-page{
        z-index: 99999999 !important;
    }
</style>