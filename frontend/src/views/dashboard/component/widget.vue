<template>
    <div :class="`${bgClass}`" class="rounded-md p-4 bg-opacity-[0.15] dark:bg-opacity-25 relative z-[1] ">
        <div class="overlay absolute left-0 top-0 w-full h-full z-[-1]">
            <img :src="`${scr_}`" alt="" draggable="false" class="w-full h-full object-contain" />
        </div>
        <span class="block mb-2 text-sm text-slate-900 dark:text-white font-medium">{{ title }}</span>
        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium mb-2" v-bind:id="`widget${widget_id}`">{{ count }}</span>
        <div class="flex space-x-2 rtl:space-x-reverse">
            <div class="flex-1 text-sm">
                <span class="block mb-1 text-slate-600 dark:text-slate-300" v-bind:id="`date${widget_id}`">{{ date }}</span>
            </div>
        </div>
    </div>
</template>


<script>
import shade1 from "@/assets/images/all-img/shade-1.png"
export default {

    props:{
        bgClass:{
            type:String,
            default : 'bg-info-500'
        },
        title:{
            type:String,
            default:"test"
        },
        count:{
            type:Number,
            default : 0
        },
        scr_:{
            type:String,
            default:shade1
        },
        date:{
            type:String
        },
        widget_id:{
            type:Number
        }
    }

}
</script>

<style>

</style>