<template>
    <div>
        <Breadcrumb />

        <div class="grid grid-cols-2 gap-3 w-full">
            <div class="col-span-1">
                <Card title="Profile Info">
                    <form class="space-y-4 pt-4">
                        <Textinput type="text" v-model="profileInfo.name" placeholder="Name" label="Name" />
                        <Textinput type="email" v-model="profileInfo.email" placeholder="Email" label="Email" />
                        <label for="" class="inline-block input-label">Role</label>
                        <vSelect class="dark:bg-slate-400" placeholder="User role" value="value"
                            :reduce="label => label.value" label="label" v-model="profileInfo.role"
                            :options="role.getUserRole" />

                        <div class="text-right">
                            <Button type="button" btnClass="btn-success" text="Update" :isLoading="user.loading" @click="saveInfo()" />
                        </div>
                    </form>
                </Card>
            </div>
            <div class="col-span-1">
                <Card title="Credentials">
                    <div class="space-y-4 pt-4">
                        <Textinput type="password" v-model="current_password" placeholder="Current Password"
                            label="Current Password" />
                        <Textinput type="password" v-model="new_password" placeholder="New Password"
                            label="New Password" />
                        <div class="text-right">
                            <Button type="submit" btnClass="btn-success" text="Update" :isLoading="user.loading"  @click="checkPassword" />
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    </div>
</template>

<script setup>
import Breadcrumb from "@/components/Breadcrumb";
import Card from "@/components/Card/index";
import Button from "@/components/Button";
import Textinput from "@/components/Textinput";
import vSelect from "vue-select"; 

import { useAuthStore } from "@/store/auth";
import { useUserRoleStore } from "@/store/role";
import { useUserStore } from "@/store/user";
import { onMounted, ref } from "vue";

const user = useUserStore();
const role = useUserRoleStore();
const authStore = useAuthStore();

const profileInfo = ref({
    id: '',
    name: '',
    email: '',
    role: ''
});

const current_password = ref('');
const new_password = ref('');

const saveInfo = async () => {
    user.userForm.id = profileInfo.value.id;
    user.userForm.name = profileInfo.value.name;
    user.userForm.email = profileInfo.value.email;
    user.userForm.role = profileInfo.value.role;
    user.save();
}

const checkPassword = async () => { 
    user.checkPassword(profileInfo.value.id,current_password.value, new_password.value);
}

onMounted(() => {
    profileInfo.value.id = authStore.user.id;
    profileInfo.value.name = authStore.user.name;
    profileInfo.value.email = authStore.user.email;
    profileInfo.value.role = authStore.user.role;
})
</script>