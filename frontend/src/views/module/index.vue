<template>
    <div>
        <Breadcrumb/>
        <div class="lg:grid lg:grid-cols-3 mb-2">
            <div class="flex">
                    <InputGroup type="text" placeholder="Search" prependIcon="heroicons-outline:search" merged />
                    <Button
                        icon="heroicons-outline:plus"
                        text="Filters"
                        btnClass="btn-secondary ml-2 py-2"
                    />
             
            </div>
            <div class="col-start-3">
                <div class="lg:float-right">
                    <Button
                    icon="heroicons-outline:plus"
                    text="Add new incidents"
                    btnClass="btn-danger mr-2 py-2"
                    />
                    <Button
                    icon="heroicons-outline:arrow-down-tray"
                    text="Import"
                    btnClass="btn-outline-danger py-2"
                    />
                </div>
            </div>
        </div>
        <Incident v-if="this.$route.params.module == 'incidents' " />
    </div>
</template>
<script>
import InputGroup from "@/components/InputGroup";
import Breadcrumb from "../components/Breadcrumb.vue";
import Incident from "./incident/index.vue";
import Textinput from "@/components/Textinput";
import Button from '@/components/Button';
import Icon from "@/components/Icon";
import test from "../components/button";
export default {
    components:{
        Breadcrumb,
        Incident,
        Textinput,
        Button,
        Icon,
        test,
        InputGroup
    }
}
</script>

<style>

</style>