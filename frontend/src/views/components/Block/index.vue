<template>
        <Card :title="blockname" class="mb-4">
            <br v-if="blockname != '' ">
            <slot></slot>
        </Card>
</template>

<script>
import Card from "@/components/Card";
export default {
    components:{
        Card
    },
    props:{
        blockname:{
            type:String,
            default:""
        }
    }
}
</script>

<style>

</style>