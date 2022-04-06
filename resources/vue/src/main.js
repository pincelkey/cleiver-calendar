import Vue from 'vue';
import { BootstrapVue } from 'bootstrap-vue';
import Vuelidate from 'vuelidate';
import AOS from 'aos';

import App from './App.vue';
import router from './router';
import store from './store';

import 'bootstrap';
import './assets/styles/main.scss';

AOS.init();

Vue.config.productionTip = false;

Vue.mixin({
  methods: {
    getFullContext(payload) {
      let request = `${process.env.VUE_APP_API}/pages/${payload.slug}/?type=${payload.type}`;

      if (payload.typeName) request += `&type-name=${payload.typeName}`;
      if (payload.parent) request += `&parent=${payload.parent}`;

      fetch(request)
        .then((res) => {
          if (res.status === 201 || res.status < 300) {
            return res.json();
          }

          throw res;
        })
        .then((response) => {
          if (response.status) {
            this.context = {
              ...this.context,
              ...response.data,
            };

            this.contextLoading = false;
          } else {
            this.$router.push('/404');
          }
        })
        .catch((err) => {
          this.$router.push('/404');

          throw err;
        });
    },
  },
});

Vue.use(BootstrapVue);
Vue.use(Vuelidate);

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount('#app');
