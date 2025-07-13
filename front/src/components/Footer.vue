<template>
  <footer class="bg-gray-100 py-6 mt-12 border-t">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
      <div class="flex items-center gap-2 mb-4 md:mb-0">
        <span class="text-gray-700 font-semibold text-base">MyStore</span>
      </div>

      <div class="text-gray-400 text-xs mt-4 md:mt-0">
        © {{ new Date().getFullYear() }} MyStore. Все права защищены.
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts"></script>
