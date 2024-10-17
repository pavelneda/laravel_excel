<script>

import {Link} from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";

export default {
    name: "MainLayout",
    components: {Navigation, Link}
}
</script>

<template>
    <div class="w-96 mx-auto">
        <Navigation/>

        <slot></slot>
    </div>
</template>

<style scoped>

</style>
