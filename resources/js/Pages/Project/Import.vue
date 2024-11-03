<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Import",

    layout: MainLayout,

    data() {
        return {
            file: null,
            type: 1,
        }
    },

    methods: {

        selectExcel() {
            this.$refs.file.click()
        },

        setExcel(e) {
            this.file = e.target.files[0]
        },

        importExcel() {
            const formData = new FormData
            formData.append('file', this.file)
            formData.append('type', this.type)

            this.$inertia.post('/projects/import', formData, {
                onSuccess: () => {
                    this.file = null;
                    this.$refs.file.value = null;
                }
            })
        },

    }
}
</script>

<template>
    project import

    <div class="flex justify-center mt-4">
        <form class="flex justify-center">
            <select v-model="type"
                    class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value='1'>Static import</option>
                <option value='2'>Dynamic import</option>
            </select>
            <input @change="setExcel" type="file" ref="file" class="hidden">
            <div @click="selectExcel" class="bg-green-600 rounded-full text-white w-32 text-center p-2 cursor-pointer">
                Excel
            </div>
        </form>
        <div v-if="file" class="ml-3">
            <div @click="importExcel" class="bg-sky-600 rounded-full text-white w-32 text-center p-2 cursor-pointer">
                Import
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
