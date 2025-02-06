<template lang="">
    <div>
            <div
                v-bind="getRootProps()"
                class="w-full text-center border-dashed border border-secondary-500 rounded-md py-[52px] flex flex-col justify-center items-center"
                >
                <div>
                    <input v-bind="getInputProps()" class="hidden" />
                    <img src="@/assets/images/svg/upload.svg" alt="" class="mx-auto mb-4" />
                    <p
                    v-if="isDragActive"
                    class="text-sm text-slate-500 dark:text-slate-300 font-light"
                    >
                    Drop the files here ...
                    </p>
                    <p v-else class="text-sm text-slate-500 dark:text-slate-300 font-light">
                    Drop files here or click to upload.
                    </p>
                </div>
            </div>
            <ul class="list-item space-y-3 h-full overflow-x-auto mt-5">
                <li
                    class="flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0"
                    v-for="(item, i) in media.form.files"
                    :key="i">
                        <div class="text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]">
                            <div class="text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap">
                                {{i+1}}. {{item.name}}
                            </div>
                        </div>
                        <div class="flex-1 ltr:text-right rtl:text-left">
                             <div class="text-sm font-light text-slate-400 dark:text-slate-400">
                                <Button icon="heroicons-outline:trash"
                                btnClass="inline-flex items-center justify-center h-10 w-10 bg-danger-500 text-lg border rounded border-danger-500 text-white"
                                @click="removeFile(i)" />
                            </div>
                        </div>
                </li>
            </ul>
            <div class="w-full flex justify-between mt-5">
                    <Button text="Close" btnClass="btn-dark" @click="closeModal()" />
                    <Button text="Save Media" btnClass="btn-danger" @click="SaveMedia()" />
            </div>
    </div>
</template>
<script>
import Button from '@/components/Button';
import { useDropzone } from "vue3-dropzone";
import { ref } from "vue";
import Icon from "@/components/Icon";
import router from '@/router';
import { useMediaStore } from '@/store/media';
import Modal from '@/components/Modal/Modal.vue';
import { useRelatedStore } from '@/store/related';
const related_store = useRelatedStore();
export default {
    setup() {
        const media = useMediaStore();
        function onDrop(acceptFiles) {
            acceptFiles.map((item)=>{
                media.form.files.push(item)
            })
        }
        function closeModal(){
            media.form.files = [];
            media.modal = false;
        }
        function removeFile(index){
            media.form.files.splice(index,1);
        }
        function changeFile(event){
            console.log(event.target.files[0])
        }
        const SaveMedia = () => {
            if(media.form.files.length > 0){
                const id = router.currentRoute.value.params.id;
                const module = router.currentRoute.value.params.module;
                var form = new FormData();
                media.id = id;
                form.append("id",id);
                form.append("module",module);
                media.form.files.map((item)=>{
                    form.append("files[]",item);
                })
                media.save(form);
                const router_ = router.currentRoute.value.params;
                related_store.get_column(router_.id,router_.module,router_.related_module)
            }
            closeModal();

        }
        const { getRootProps, getInputProps, ...rest } = useDropzone({ onDrop });
        return {
            getRootProps,
            getInputProps,
            closeModal,
            removeFile,
            SaveMedia,
            changeFile,
            ...rest,
            media,
        };
    },
    components:{
        Modal,
        Icon,
        Button
    },
}
</script>
<style lang="">
    
</style>