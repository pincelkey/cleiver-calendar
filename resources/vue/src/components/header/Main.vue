<template>
  <header class="c-header w-100 pb-0">
    <div class="container position-relative">
      <nav class="c-nav w-100">
        <div class="c-nav__left d-flex justify-content-center align-items-center">
          <figure class="c-brand c-brand--normal d-flex justify-content-center align-items-center">
            <router-link class="c-brand__link" to="/">
              <img class="c-brand__image" src="@/assets/img/logo.png" alt="Panda WP - Logo" />
            </router-link>
          </figure>
        </div>
        <div class="c-nav__right">
          <ul class="c-menu menu ul-reset">
            <li
              v-for="item of general.data.primary_menu"
              :key="item.id"
              :class="[item.class, {'activate' : isAtiveMenuItem(item)}]">
              <router-link :to="item.url" class="position-relative" replace>
                {{ item.name }}
              </router-link>
            </li>
          </ul>
          <a
            href="item.link"
            class="c-button c-button--primary w-medium
              f2 fs-18 white d-block"
            >
            <div class="d-flex w-100 height-100 justify-content-center align-items-center">
              Wsp
            </div>
          </a>
        </div>
      </nav>
    </div>
  </header>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState(['general']),
  },
  methods: {
    isAtiveMenuItem(item) {
      return item.slug.toLowerCase() === this.$route.name.toLowerCase();
    },
  },
};
</script>
