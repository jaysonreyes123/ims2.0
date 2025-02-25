<template lang="">
    <div>
        <h6>Login History</h6>
        <br>
        <Card>
            <vue-good-table 
                max-height="600px" 
                :columns="columns"
                :rows="system_store.login_history.logs"
                :isLoading.sync="system_store.loading" 
                styleClass="vgt-table condensed lesspadding2" 
                :fixed-header="true"
                :sort-options="{
                    enabled: false,
                }" 
                :pagination-options="{
                    enabled: true,
                    perPage:system_store.login_history.perpage
                }">
                <template #pagination-bottom="props">
                    <div class="py-4 px-3 justify-center flex">
                        <Pagination 
                            :total="system_store.login_history.total" 
                            :current="system_store.login_history.current"
                            :per-page="system_store.login_history.perpage" 
                            @pageChanged="pageChanged"
                        />
                    </div>
                </template>    
            </vue-good-table>
        </Card>
    </div>
</template>
<script>
import Card from "@/components/Card";
import Pagination from "@/components/Pagination";
import { useSystemStore } from '@/store/system';
const system_store = useSystemStore();
export default {
    components:{
        Card,
        Pagination
    },
    methods:{
        pageChanged(page){
            system_store.login_history.current = page;
            system_store.login_history_logs();
        }
    },
    data(){
        return{
            system_store,
            columns:[
                {
                    label:"User Name",
                    field:"user"
                },
                {
                    label:"IP Address",
                    field:"ipaddress"
                },
                {
                    label:"Sign-in",
                    field:"signin"
                },
                {
                    label:"Sign-out",
                    field:"signout"
                },
                {
                    label:"Status",
                    field:"status"
                }
            ]
        }
    },
    mounted(){
        system_store.login_history.logs = [];
        system_store.login_history.current = 1;
        system_store.login_history_logs();
    }
}
</script>
<style>    
.vgt-table thead th {
  @apply px-2;
}
</style>