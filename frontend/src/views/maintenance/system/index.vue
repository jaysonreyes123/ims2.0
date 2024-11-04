<template>
  <div>
        <Breadcrumb/>
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="col-start-4 col-span-6">
                <Card title="Branding">
                    <p>Logo</p>
                    <form @submit.prevent="save" class="space-y-4">
                    <img alt="logo" :src="url" class="rounded-lg" style="width: 300px;height: 300px !important;" />
                    <button @click="remove" type="button" class=" mt-5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Remove</button>
                    <label for="file" class="btn-light px-4 py-2 ml-6 cursor-pointer">
                        Change Logo
                    </label>
                    <input @change="changeLogo" style="display: none;" type="file" id="file" />
                    <div>
                        <Textinput v-model="store.systemForm.site" label="Site Title"/>
                    </div>
                    <div class="text-right mt-5">
                    <Button type="submit"  text="save" />
                    </div>
                    </form>
                </Card>
            </div>
        </div>
  </div>
</template>

<script setup>
import Breadcrumb from "@/components/Breadcrumb";
import Card from "@/components/Card";
import Button from "@/components/Button";
import Textinput from "@/components/Textinput";
import { ref } from "vue";
import { useSystemStore } from "@/store/system";
import { useAuthStore } from "@/store/auth";
import { useToast } from "vue-toastification"; 
import default_image from "@/assets/images/logo/default.png"
const toast = useToast(); 
const authStore = useAuthStore();
const store = useSystemStore();
store.systemForm.logo = store.systemForm.logo == "" ? authStore.fmslogo : store.systemForm.logo;
store.systemForm.site = store.systemForm.site == "" ? authStore.fmssite : store.systemForm.site;
console.log(store.systemForm.logo)
const url = ref(store.systemForm.logo);
const changeLogo = (e) =>{
    const selectedFile = e.target.files[0];
    if(selectedFile.type != "image/jpeg" && selectedFile.type != "image/png") {
        toast.error("Invalid Image", {
            timeout: 3000,
        });
        return false;
    }
    store.systemForm.logo = selectedFile;
    url.value = URL.createObjectURL(selectedFile);
}
const remove = () =>{
    url.value = default_image;
    store.systemForm.logo = ""; 
}
const save = () =>{
    store.save();
}
</script>

<style>

</style>