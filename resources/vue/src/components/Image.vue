<template>
  <div class="c-card-image overflow-hidden">
    <v-lazy-image class="w-100 h-100 of--cover" :src="source" />
  </div>
</template>

<script>
import VLazyImage from 'v-lazy-image/v2/v-lazy-image.es';

export default {
  props: ['source'],
  components: {
    VLazyImage,
  },
};
</script>
