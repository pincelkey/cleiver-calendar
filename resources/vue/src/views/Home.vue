<template>
  <section class="c-section c-section--home">
    <div class="container">
      <section class="py-5 h-100 text-center">
        <h1 data-aos="zoom-in" class="w-bold">
          Cleiver Calendar
          2022
        </h1>
        <button
          @click="authGoogle()"
          :disabled="loading"
          class="c-button c-button--primary">
          Google Auth
        </button>
      </section>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    authGoogle() {
      this.loading = true;

      fetch(`${process.env.VUE_APP_API}/events/auth`, {
        method: 'GET',
      })
        .then((res) => {
          if (res.status === 201 || res.status < 300) {
            return res.json();
          }

          throw res;
        })
        .then((response) => {
          if (response.status) {
            window.location.href = response.data;
          } else {
            alert('¡Ha ocurrido un error enviar! 😥⚠️🚨, intentelo más tarde (revisar datos)');
          }
        })
        .catch((err) => {
          alert('¡Ha ocurrido un error enviar! 😥⚠️🚨, intentelo más tarde (revisar datos)');

          throw err;
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
