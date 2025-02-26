<template lang="">
    <div>
        <div class="grid grid-cols-3 gap-4 mt-4">
            <Card title="Incident Summary" class="h-[400px]"></Card>
            <Card title="Media" class="h-[400px]"></Card>
            <Card title="Activity" class="h-[400px]"></Card>
            <Card title="Responder" class="h-[400px]"></Card>
            <Card title="Resources" class="h-[400px]"></Card>
            <Card title="Task List" class="h-[400px]"></Card>
        </div>
    </div>
</template>
<script>
import Card from "@/components/Card";
export default {    
    components:{
        Card
    }
}
</script>
<style lang="">
    
</style>