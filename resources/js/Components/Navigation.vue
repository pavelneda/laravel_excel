<script>

import {Link} from "@inertiajs/vue3";

export default {
    name: "Navigation",
    components: {Link}
}
</script>


<template>
    <nav class="bg-gray-800 mb-4">
        <div class="mx-auto max-w-7xl  ">
            <div class="relative flex h-16 items-center justify-between">

                <div class="flex flex-1 items-center justify-center sm:items-stretch ">
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                            <Link
                                :class="['rounded-md px-3 py-2 text-sm font-medium', $page.component === 'Project/Index' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                :href="route('projects.index')">
                                Projects
                            </Link>
                            <Link
                                :class="['rounded-md px-3 py-2 text-sm font-medium', $page.component === 'Project/Import' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                :href="route('projects.import')">
                                Import
                            </Link>
                            <Link
                                :class="['rounded-md px-3 py-2 text-sm font-medium', $page.component === 'Task/Index' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                :href="route('tasks.index')">
                                Tasks
                            </Link>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                   aria-current="page">Dashboard</a>
                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
            </div>
        </div>
    </nav>

</template>

