<template>
    <div>
        <form @submit.prevent="saveForm">
         <Incident v-if="this.$route.params.module == 'incidents' " />
         <Block>
            <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" :text="saveBtn" />
        </Block>
        </form>
    </div>
</template>
<script>
import Breadcrumb from "../components/Breadcrumb.vue";
import Incident from "./incident/edit.vue";
import Block from "../components/Block";
import Button from "@/components/Button";
import { useIncidentStore } from "@/store/incident";
const IncidentStore = useIncidentStore();
export default {
    components:{
        Breadcrumb,
        Incident,
        Block,
        Button
    },
    data(){
        return{
            saveBtn:"Save "+this.$route.params.module,
        }    
    },
    methods:{
        saveForm(event){
            const test = Object.fromEntries(new FormData(event.target));
            console.log(IncidentStore.form)
        }
    }
}
</script>

<style>

</style>