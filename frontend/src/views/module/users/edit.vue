<template>
  <div>
    <Block v-for="(block,index) in responder_fields" :key="index" :title="block.block_name">
        <div class="lg:grid gap-x-12"> 
            <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                <div v-if="field.type == 'date' ">
                    <div class="fromGroup relative">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }}</label>
                    <flat-pickr
                        v-model="form[field.name]"
                        class="form-control"
                        placeholder="yyyy-mm-dd"
                        :config="{ dateFormat:'Y-m-d' }"
                    />
                    </div>
                </div>
                <div v-else>
                    <Textinput :label="field.label" v-model="form[field.name]" :placeholder="`Enter ${field.label}` " />
                </div>
            </div>
        </div>
    </Block>
  </div>
</template>

<script>
import Block from "../../components/Block";
import Textinput from "@/components/Textinput"
import { responder_fields } from "../fields/responder";
export default {
    components:{
        Block,
        Textinput
    },
    data(){
        return{
            responder_fields,
            form:{}
        }
    },
    methods:{
        testing(){
            console.log(this.form)
        }
    }
}
</script>

<style>
.custom-grid-0{
    grid-column:1
}
.custom-grid-1{
    grid-column:2
}
</style>