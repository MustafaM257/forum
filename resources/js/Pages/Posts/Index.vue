<template>
    <AppLayout>
<Container>
        <ul class="space-y-4">
            <li v-for="post in posts.data">
                {{post.title}}
            </li>
        </ul>
</Container>
    </AppLayout>
</template>
<script setup lang="ts">
import Container from "@/Components/Container.vue";

defineProps([
    'posts'
]);
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
