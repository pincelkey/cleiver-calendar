<template>
  <section class="c-section c-section--home">
    <div class="container">
      <section class="p-4">
        <h2 class="fs-21 mb-3 text-center">Creación del evento</h2>
        <form @submit.prevent="createEvent">
          <div class="c-form-group mb-4" :class="{ 'c-form-group--error': $v.name.$error }">
            <label class="c-form-group__label">Titulo del evento</label>
            <input class="c-form-group__input" v-model.trim="$v.name.$model"/>

            <span class="c-form-group__error" v-if="!$v.name.required">Campo requerido</span>
          </div>

          <button
            :disabled="loading"
            class="c-button c-button--primary mt-4">
            Crear evento
          </button>
        </form>
      </section>
    </div>
  </section>
</template>

<script>
import {
  required,
} from 'vuelidate/lib/validators';

export default {
  data() {
    return {
      name: '',

      loading: false,
    };
  },
  validations: {
    name: {
      required,
    },
  },
  methods: {
    createEvent() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.loading = true;

        const formData = new FormData();

        formData.append('event', this.name);
        formData.append('code', this.$route.query.code);

        fetch(`${process.env.VUE_APP_API}/events`, {
          method: 'POST',
          body: formData,
        })
          .then((res) => {
            if (res.status === 201 || res.status < 300) {
              return res.json();
            }

            throw res;
          })
          .then((response) => {
            if (response.status) {
              alert('Evento creado existosamente!!!');
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
      }
    },
  },
};
</script>
