<template>
  <label
    class="c-toggle button-reset button position-fixed"
    :class="{ 'c-toggle--active' : switcher }"
    @click="updateStatusMenu()"
  >
    <div class="c-icons-container position-absolute overflow-hidden">
      <div class="c-icons">
        <div class="c-icon d-flex justify-content-center align-items-center">
          <span>
            <Icon class="fs-30" icon="dashicons:menu" />
          </span>
        </div>
        <div class="c-icon d-flex justify-content-center align-items-center">
          <span>
            <Icon class="fs-30" icon="eva:close-fill" />
          </span>
        </div>
      </div>
    </div>
  </label>
</template>

<script>
import { Icon } from '@iconify/vue2';

export default {
  props: ['switcher'],
  methods: {
    updateStatusMenu() {
      this.$emit('update:switcher', !this.switcher);
    },
  },
  components: {
    Icon,
  },
};
</script>
