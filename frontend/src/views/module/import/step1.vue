<template>
  <div>
    <Card title="Import from csv file" class="shadow">
        <br>
        <div class="lg:grid lg:grid-cols-1">
            <div class="fromGroup relative">
                <label for="" class="inline-block input-label">Select csv file</label>
                <Fileinput accept=".csv" placeholder="Choose a file here..." @change="uploadFile" />
            </div>
            <br>
            <Checkbox v-model="hasheader" @change="hasheaderevent" label="Has header"/>
        </div>
    </Card>
  </div>
</template>

<script>
import Card from "@/components/Card";
import Fileinput from "@/components/Fileinput";
import Checkbox from "@/components/Checkbox";
export default {
    components:{
        Card,
        Fileinput,
        Checkbox
    },
    data(){
        return{
            hasheader:0
        }
    },
    methods:{
        uploadFile(event){
            this.$emit("uploadFile",event.target.files);
        },
        hasheaderevent(event){
            this.$emit("hasHeader",this.hasheader);
        }
    }
}
</script>

<style>

</style>