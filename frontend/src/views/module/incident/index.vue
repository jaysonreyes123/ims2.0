
<template>
    <div>
      <vue-good-table
        :isLoading.sync="listStore.loading"
        :columns="columns"
        styleClass=" vgt-table  lesspadding2 centered "
        :rows="listStore.list"
        :pagination-options="{
          enabled: true,
          perPage: perpage,
        }"
        :select-options="{
          enabled: true,
          selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
          selectioninfoClass: 'custom-class',
          selectionText: 'rows selected',
          clearSelectionText: 'clear',
          disableSelectinfo: true, // disable the select info-500 panel on top
          selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
        }"
      >
        <template v-slot:table-row="props">
          <span v-if="props.column.field == 'action'">
          <div class="flex space-x-3 justify-center rtl:space-x-reverse">
            <Tooltip placement="top" arrow theme="dark">
              <template #button>
                <router-link :to="`${this.$route.params.module}/detail/${props.row.id}`">
                  <div class="action-btn">
                    <Icon icon="heroicons:eye" />
                  </div>
                </router-link>
              </template>
              <span> View</span>
            </Tooltip>
            <Tooltip placement="top" arrow theme="dark">
              <template #button>
                <router-link :to="`${this.$route.params.module}/edit/${props.row.id}`">
                <div class="action-btn">
                  <Icon icon="heroicons:pencil-square" />
                </div>
                </router-link>
              </template>
              <span> Edit</span>
            </Tooltip>
            <Tooltip placement="top" arrow theme="danger-500">
              <template #button>
                <div class="action-btn text-red-500" @click="del(props.row.id)">
                  <Icon  icon="heroicons:trash" />
                </div>
              </template>
              <span>Delete</span>
            </Tooltip>
          </div>
        </span>
        </template>
        <template #pagination-bottom="props">
          <div class="py-4 px-3 flex justify-center">
            <Pagination
              :total="listStore.total"
              :current="listStore.current"
              :per-page="listStore.per_page"
              :pageRange="pageRange"
              :pageChanged="changePage"
              :perPageChanged="props.perPageChanged"
              >
            </Pagination>
          </div>
        </template>
      </vue-good-table>
    </div>
  </template>
  <script>

  import Icon from "@/components/Icon";
  import Tooltip from "@/components/Tooltip";
  import Pagination from "@/components/Pagination";
  import Swal from 'sweetalert2';
  import { useListStore } from "@/store/list";
  const listStore = useListStore();
  export default {
    components: {
      Pagination,
      Icon,
      Tooltip,
      Swal
    },
    created(){
      listStore.List(this.modules);
    },  
    methods:{
      changePage(event){
        if(listStore.current != event.currentPage){
          listStore.current = event.currentPage;
          listStore.List(this.modules);
        }
        
      },
      del(id){
        Swal.fire({
          title: "Do you want to delete this "+this.$route.params.module+" ?", 
          text: "You won't be able to revert this!",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Yes, delete it!", 
        }).then((result) => { 
            if (result.isConfirmed) {
                listStore.Delete(this.modules,id);
            } 
        });

      }
    },
    data() {
      return {
        modules:this.$route.params.module,
        listStore,
        columns: [
          {
            label: "No.",
            field: "incident_no",
          },
          {
            label: "Incident type",
            field: "incident_type.name",
          },
          {
            label: "Incident status",
            field: "incident_status.name",
          },
          {
            label: "Created time",
            field: "created_at",
          },
  
          {
            label: "SLA status",
            field: "quantity",
          },
  
          {
            label: "Dispatch to",
            field: "amount",
          },
  
          {
            label: "User",
            field: "status",
          },
          {
            label: "Action",
            field: "action",
          },
        ],
      };
    },
  };
  </script>
  <style lang="scss" scoped>
  .action-btn {
    @apply h-6 w-6 flex flex-col items-center justify-center border border-slate-200 dark:border-slate-700 rounded;
  }
  </style>
  