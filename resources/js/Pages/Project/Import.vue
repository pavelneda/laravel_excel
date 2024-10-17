<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Import",

    layout: MainLayout,

    data() {
        return{
            file: null,
        }
    },

    methods:{

        selectExcel(){
            this.$refs.file.click()
        },

        setExcel(e){
            this.file = e.target.files[0]
        },

        importExcel(){
            const formData = new FormData
            formData.append('file', this.file)

            this.$inertia.post('/projects/import', formData)
        },

    }
}
</script>

<template>
    project import

    <div class="flex justify-center mt-4">
        <form>
            <input @change="setExcel" type="file" ref="file" class="hidden">
            <div @click="selectExcel" class="bg-green-600 rounded-full text-white w-32 text-center p-2 cursor-pointer">Excel</div>
        </form>
        <div v-if="file" class="ml-3">
            <div @click="importExcel" class="bg-sky-600 rounded-full text-white w-32 text-center p-2 cursor-pointer">Import</div>
        </div>
    </div>
</template>

<style scoped>

</style>
