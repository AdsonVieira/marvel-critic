<template>
  <div>
    <NavBarGuest></NavBarGuest>
    <div class="bg-light p-5" style="height: 94vh;">
      <div class="d-flex justify-content-center">
        <div class="w-25">
          <h1 class="display-4 text-center">Fazer Login</h1>
          <b-alert :show="this.showError" variant="danger">{{ this.errorMsg }}</b-alert>
          <form method="post" @submit.prevent="login">
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
              <b-button type="submit" class="button is-dark w-100">Logar</b-button>
            </div>
            <p class="text-center mt-4">Ainda não tem uma conta? <b-link to="/register">Criar conta</b-link></p>
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
      password: '',
      showError: false,
      errorMsg: ''
    }
  },

  methods: {
    async login() {
      try {
        await this.$auth.loginWith('local', {
          data: {
            email: this.email,
            password: this.password
          }
        })

        this.$router.push('/movies')
      } catch (e) {
        this.showError = true
        this.errorMsg = e.response.data.error
      }
    }
  }
}
</script>
