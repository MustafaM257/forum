<template>
    <ConfirmationModal :show="state.show">
        <template #title>
            {{state.title}}
        </template>
        <template #content>
            {{state.message}}
        </template>
        <template #footer>
            <PrimaryButton>Primary</PrimaryButton>
            <SecondaryButton>Secondary</SecondaryButton>
        </template>
    </ConfirmationModal>
</template>
<script setup lang="ts">
import {useModal} from '@/Composables/useModal';
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
const {state} = useModal();

</script>
