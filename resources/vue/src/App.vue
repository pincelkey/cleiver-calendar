<template>
  <section>
    <Header></Header>
    <HeaderMobile :switcher="isActiveMenu"></HeaderMobile>
    <Toggle :switcher.sync="isActiveMenu"></Toggle>

    <transition name="fade" mode="out-in">
      <keep-alive>
        <router-view></router-view>
      </keep-alive>
    </transition>

    <Footer></Footer>
  </section>
</template>

<script>
import { mapActions } from 'vuex';

import Header from './components/header/Main.vue';
import HeaderMobile from './components/header/Mobile.vue';
import Toggle from './components/header/Toggle.vue';
import Footer from './components/Footer.vue';

export default {
  data() {
    return {
      isActiveMenu: false,
    };
  },
  components: {
    Header,
    HeaderMobile,
    Toggle,
    Footer,
  },
  created() {
    this.getGeneralData();
  },
  methods: {
    ...mapActions(['getGeneralData']),
  },
};
</script>
