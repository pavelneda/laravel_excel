<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Pagination",
    components: {Link},
    props: ['meta'],
}
</script>

<template>
    <div v-if="meta.links" class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center">
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                     <template v-for="link in meta.links">
                        <Link :href="link.url" v-if="!!link.url"
                              v-html="link.label"
                              :class="['relative inline-flex items-center px-4 py-2 text-sm font-semibold',
                              link.active ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                              : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0']">
                        </Link>
                    </template>
                </nav>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
