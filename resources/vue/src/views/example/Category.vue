<template>
  <section class="c-section py-5">
    <section class="container">
      <h1 class="text-center">Category name: {{ context.term ? context.term.name : '' }}</h1>
    </section>
  </section>
</template>

<script>
export default {
  data() {
    return {
      context: {},
      contextLoading: true,
    };
  },
  created() {
    this.getFullContext({ type: 'term', typeName: 'category', slug: this.$route.params.category_slug });
  },
};
</script>
