<template>
    <div class="fromGroup relative">
        <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ label }}</label>
        <VueDatePicker v-model="date"  :enable-time-picker="false"></VueDatePicker>
    </div>
</template>
<script>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
  components: { VueDatePicker },
  watch:{
    date:function(){
        this.$emit('test',this.date);
    }
  },
  props:{
        label:{
            type:String,
            default:""
        }
  },    
  data() {
    return {
      date: null,
    };
  }
}
</script>