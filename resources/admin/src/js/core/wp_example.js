import Vue from 'vue';
import View from '../views/Example.vue';

Vue.mixin({
  methods: {
    assets: (file) => `${ panda.assets }/${ file }?key=${ panda.vertion }`,
  }
})

new Vue({
  render: h => h(View),
}).$mount('#app')
