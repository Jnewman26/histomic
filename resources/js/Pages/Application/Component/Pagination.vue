<template>
    <nav aria-label="Page navigation example" style="margin-top: 50px;">
        <ul class="pagination justify-content-end">
            <Link v-for="(link, comics) in links" :key="comics" :href="link.url"
                class="rounded-3 ms-2 btn btn-outline-dark" v-html="link.label" />
        </ul>
    </nav>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({ links: Array })
</script>

<!-- <template>
    <nav aria-label="Page navigation example" style="margin-top: 50px;">
      <ul class="pagination justify-content-end">
        <li v-for="(link, comics) in linksWithActiveProperty" :key="comics" :class="{ active: link.active }">
          <Link :href="link.url" class="rounded-3 ms-2 btn btn-outline-dark" v-html="link.label" />
        </li>
      </ul>
    </nav>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3';
  import { computed } from 'vue';
  
  defineProps({ links: Array });
  
  const activePagebawah = computed(() => {
    return window.location.pathname.split('/')[1];
  });
  
  // Set the active property for each link based on the current page
  const linksWithActiveProperty = computed(() => {
    return links.map((link, comics) => {
      return {
        ...link,
        active: (comics + 1) === parseInt(activePagebawah.value)
      };
    });
  });
  </script> -->
  

