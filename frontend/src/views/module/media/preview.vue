<template lang="">
    <div>
        <!-- <img 
        v-if="previewContent.type == 'image/png' || previewContent.type == 'image/jpg' || previewContent.type == 'image/svg+xml' " 
        :src="previewContent.preview" style="max-height:500px;width:100%" > -->
        <iframe  :src="previewContent.preview" style="width:100%;min-height:500px" frameborder=0 ></iframe>
    </div>
</template>
<script>
import { useMediaStore } from '@/store/media';
const media = useMediaStore();
export default {
    props:{
        previewContent:{
            type:String,
            default:""
        }
    },
}
</script>
<style lang="">
    
</style>