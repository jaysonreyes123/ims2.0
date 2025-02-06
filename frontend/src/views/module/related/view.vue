<template lang="">
    <div>
        <Breadcrum mode='view' />
        <Menu/>
        <Relatedlist/>
    </div>
</template>
<script>
import Menu from '../view/menu.vue';
import Breadcrum from '../Breadcrum.vue';
import Relatedlist from './list.vue';
export default {
    components:{
        Menu,
        Breadcrum,
        Relatedlist
    }
}
</script>
<style lang="">
    
</style>