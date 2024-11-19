<template>
    <div>
        <Textinput :placeholder="label" :label="label" :name="name" :type="type" :isReadonly="isReadonly" class="mb-4" />
    </div>
</template>
<script>
import Textinput from "@/components/Textinput";
export default{
    components:{
        Textinput,
    },
    props:{
        label:{
            type:String,
            default:"search"
        },
        name:{
            type:String,
            default:"name"
        },
        type:{
            type:String,
            default:"text"
        },
        isReadonly:{
            type:Boolean,
            default:false
        }
    },
}
</script>