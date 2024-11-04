<template>
    <div>
        <Modal :activeModal="store.modal" @close="store.closeModal" :title="store.action + ' ' + store.moduleName">
            <form @submit.prevent="save" class="space-y-4">
                <Textinput label="Name" v-model="store.roleForm.name" placeholder="Input Name" />

                <p class="font-bold">Module</p>
                <div class="grid grid-cols-5">
                    <Checkbox label="Dashboard"     v-model="store.roleForm.dashboard"    :checked="store.roleForm.dashboard" />
                    <Checkbox label="Warning"        v-model="store.roleForm.warning"      :checked="store.roleForm.warning" />
                    <Checkbox label="Historical"      name="database"  v-model="store.roleForm.database"    :checked="store.roleForm.database"/>
                    <Checkbox label="Monitoring"    name="monitoring" v-model="store.roleForm.monitoring"   :checked="store.roleForm.monitoring"/>
                    <Checkbox label="Sensor"        name="sensor"  v-model="store.roleForm.sensor"      :checked="store.roleForm.sensor"/>
                </div>

                <p class="font-bold">Maintenance</p>
                <div class="grid grid-cols-3">
                    <Checkbox label="Station"               name="station"   v-model="store.roleForm.station"            :checked="store.roleForm.station" />
                    <Checkbox label="Warning"               name="maintenance_warning" v-model="store.roleForm.maintenance_warning"  :checked="store.roleForm.maintenance_warning"/>
                    <Checkbox label="Notification Content"  name="notification"   v-model="store.roleForm.notification"       :checked="store.roleForm.notification"/>
                    <Checkbox label="Recipients"            name="recipient"    v-model="store.roleForm.recipient"         :checked="store.roleForm.recipient"/>
                    <Checkbox label="Users"                 name="users"        v-model="store.roleForm.user"         :checked="store.roleForm.user"/>
                    <Checkbox label="User Role"             name="user_role"    v-model="store.roleForm.user_role"         :checked="store.roleForm.user_role"/>
                    <Checkbox label="System"                name="system"    v-model="store.roleForm.system"         :checked="store.roleForm.system"/>
                </div>
                <div class="text-right">
                    <Button type="submit" :text="store.action" btnClass="btn-success" :isLoading="store.loading" />
                </div>
            </form>
        </Modal>
    </div>
</template>
<script setup> 
import Button from "@/components/Button";
import Modal from "@/components/Modal"; 
import Checkbox from "@/components/Checkbox";

import Textinput from "@/components/Textinput";

import { useUserRoleStore } from "@/store/role";
const store = useUserRoleStore();

const save  = () =>{
    console.log(store.roleForm)
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
    