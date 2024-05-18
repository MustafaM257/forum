<template>

<!--                    Comment Data-->
                    <div class="relative flex items-start space-x-3 ">
                            <div class="relative">
                                <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" :src="comment.user.profile_photo_url" alt="" />

                                <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div>
                                    <div class="text-sm">
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">Commented by {{comment.user.name}} <span class="font-bold"> {{ dateFormat(comment.created_at)}} ago </span></p>
                                </div>
                                <div class="mt-2 text-sm text-gray-700 break-all">
                                    <p>{{ comment.body }}</p>
                                </div>
                            </div>
                        <div class="mt-4">
                            <form @submit.prevent="deleteComment">
                                <button>Delete</button>
                            </form>
                        </div>
                    </div>
<!--                    End of Comment Data-->

</template>

<script setup>
import {formatDistance, parseISO} from "date-fns";
import {router} from "@inertiajs/vue3"
const props = defineProps(['comment'])
const dateFormat = (str) => {
    return formatDistance(parseISO(str), new Date());
}
const deleteComment = () => {
    router.delete(route('comments.destroy',props.comment.id), {
        preserveScroll: true,
    });
}
</script>
