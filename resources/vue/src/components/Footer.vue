<template>
  <footer class="c-footer">
    <div class="container d-flex justify-content-between">
      <p class="m-0">Made by <a href="/">Panda WP</a></p>
      <p class="m-0">© {{ year }} All Rights Reserved</p>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>
