<template>
    <div class="fromGroup relative">
        <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ label }}</label>
          <div class="relative flex-1">
            <v-select :options="options"  @input="changedValue" :searchable="false" :reduce="label => label.value"></v-select>
          </div>
      </div>
  </template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
export default {
    components:{
        vSelect
    },
    props:{
        label:{
            type:String,
            default:"search"
        },
        options:Array,
        multiple:{
            type:Boolean,
            default:false
        },
        modelValue: {
      // type: String || Array,
      default: "",
    },
    },
    methods: {
        changedValue: function() {
            alert("A new value was selected");
        }
}
}
</script>

<style>

</style>