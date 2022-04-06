import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    general: {
      data: {},
      isLoading: true,
    },
  },
  mutations: {
    updateGeneralData(state, object) {
      state.general = object;
    },
  },
  actions: {
    getGeneralData({ commit }) {
      const request = `${process.env.VUE_APP_API}/pages/general/?type=general`;

      fetch(request)
        .then((res) => {
          if (res.status === 201 || res.status < 300) {
            return res.json();
          }

          throw res;
        })
        .then((response) => {
          if (response.status) {
            // console.log(response.data);
            commit(
              'updateGeneralData',
              {
                data: response.data,
                isLoading: false,
              },
            );
          }
        })
        .catch((err) => {
          throw err;
        });
    },
  },
  modules: {
  },
});
