<template>
    <AppLayout :title="post.title">
        <h1>{{post.title}}</h1>
        <article>
            {{post.body}}
        </article>
        {{date}}
    </AppLayout>
</template>
<script setup lang="ts">
import {computed} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {formatDistance, parseISO} from "date-fns";
const props = defineProps(['post'])

const date = computed(() => {
    return formatDistance(parseISO(props.post.created_at), new Date());
})




</script>
