<template>
  <div>
    <NavBarGuest></NavBarGuest>
    <div class="bg-light p-5" style="height: 94vh;">
      <div class="d-flex justify-content-center">
        <div class="w-25">
          <h1 class="display-4 text-center">Criar Conta</h1>
          <b-alert :show="this.showError" variant="danger">{{ this.errorMsg }}</b-alert>
          <form method="post" @submit.prevent="createAccount">
            <b-form-group
              id="name-group-1"
              label="Nome:"
              label-for="name-input"
            >
              <b-form-input
                id="name-input"
                v-model="name"
                type="text"
                placeholder="Informe o seu nome"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="email-group-1"
              label="Email:"
              label-for="email-input"
            >
              <b-form-input
                id="email-input"
                v-model="email"
                type="email"
                placeholder="Informe o email"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="pass-group-1"
              label="Senha:"
              label-for="pass-input"
            >
              <b-form-input
                id="pass-input"
                v-model="password"
                type="password"
                placeholder="Informe a senha"
                required
              ></b-form-input>
            </b-form-group>

            <div class="d-flex justify-content-center">
              <b-button type="submit" class="button is-dark w-100">Registrar</b-button>
            </div>
            <p class="text-center mt-4">Já tem uma conta? <b-link to="/login">Faça login</b-link></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import NavBarGuest from "../components/NavBarGuest";

export default {
  components: {NavBarGuest},

  middleware: 'guest',

  data() {
    return {
      email: '',
      name: '',
      password: '',
      showError: false,
      errorMsg: ''
    }
  },

  methods: {
    async createAccount() {
      try {
        this.$axios.post(`users`, {
          email: this.email,
          name: this.name,
          password: this.password
        })
          .then(response => {
            this.$bvToast.toast(`Faça login para começar a avaliar`, {
              title: 'Conta criada com sucesso',
              autoHideDelay: 5000,
              variant: 'success'
            })
            console.log(response);
          })
          .catch(function (error) { console.log(error); })


      } catch (e) {
        console.log(e.response.data.error)
        this.showError = true
        this.errorMsg = e.response.data.error
      }
    }
  }
}
</script>
