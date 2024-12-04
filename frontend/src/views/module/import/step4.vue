<template>
  <div>
    <Card title="Import result" >
      <div class="lg:grid grid-cols-3 mt-3">
        <div>Records Created</div>
        <div class="col-span-2">{{ ImportStore.getRecordCreated.length }}</div>
      </div>

      <div class="lg:grid grid-cols-3 mt-3">
        <div>Records Skip</div>
        <div class="col-span-2">{{ ImportStore.getSkipResult.length }}</div>
      </div>

      <div class="lg:grid grid-cols-3 mt-3">
        <div>Records update</div>
        <div class="col-span-2">{{ ImportStore.getUpdateResult.length }}</div>
      </div>
    </Card>
  </div>
</template>

<script>
import Card from '@/components/Card';
import { useImportStore } from '@/store/import';
const ImportStore = useImportStore();
export default {
  components:{
    Card
  },
  data(){
    return{
      ImportStore
    }
  }
}
</script>

<style>

</style>