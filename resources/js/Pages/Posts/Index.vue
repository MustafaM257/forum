<template>
    <AppLayout>
        <Container>
            <ul class="divide-y">
                <li v-for="post in posts.data" :key="post.id">
                    <Link :href=post.routes.show class="block group px-2 py-4">
                        <span class="font-bold text-lg group-hover:text-indigo-500">{{ post.title }}</span>
                        <span class="first-letter:uppercase block pt-1 text-sm text-gray-600">{{ date(post) }} ago by {{ post.user.name }}</span>
                    </Link>
                </li>
            </ul>

            <Pagination :meta="posts.meta" class="mt-2"/>
        </Container>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import {Link} from "@inertiajs/vue3";
import {formatDistance, parseISO} from "date-fns";

defineProps(['posts']);

const date = (post) => {
    return formatDistance(parseISO(post.created_at), new Date());
};
</script>
