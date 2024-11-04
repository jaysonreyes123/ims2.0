<template>
    <div>
        <Modal :activeModal="store.modal" @close="store.closeModal" :title="store.action + ' ' + store.moduleName">
            <form @submit.prevent="save" class="space-y-4">
                <Textinput label="Name" v-model="store.userForm.name" placeholder="Input Name" />
                <Textinput label="Email"  type="email" v-model="store.userForm.email" placeholder="Input Email" />
                <label for="" class="inline-block input-label">Role</label>
                <vSelect  class="dark:bg-slate-400" placeholder="User role" value="value" :reduce="label => label.value" label="label" v-model="store.userForm.role" :options="role.getUserRole"/> 
                <Textinput label="Password" v-if="store.action == 'Add'"  v-model="store.userForm.password" type="password" placeholder="Input password" />
                <div class="text-right">
                    <Button type="submit" :text="store.action" btnClass="btn-success" :isLoading="store.loading" />
                </div>
            </form>
        </Modal>
    </div>
</template>
<script setup> 
import vSelect from "vue-select";
import Button from "@/components/Button";
import Modal from "@/components/Modal"; 

import Textinput from "@/components/Textinput";

import { useUserStore } from "@/store/user";
import { useUserRoleStore } from "@/store/role";
const store = useUserStore();
const role = useUserRoleStore();

const save  = () =>{
    console.log(store.userForm)
    store.save();
}

</script>
<style  >
.z-\[99999\] {
    z-index: 1001;
} 
.v-select{
     margin-top: 0px !important;

}
</style>
    