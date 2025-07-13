<template>
  <RouterView />
</template>

<script lang="ts" setup>
import { useInitAuth } from '@/composables/useInitAuth.ts'
import { onMounted } from 'vue'

onMounted(() => useInitAuth())
</script>
<style scoped></style>
