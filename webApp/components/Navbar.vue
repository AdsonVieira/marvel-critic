<template>
  <b-navbar toggleable="lg" type="dark" variant="dark">
    <b-navbar-brand href="#">Marvel Critic</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="ml-auto">
        <b-navbar-nav>
          <b-nav-item class="nav-item" to="/movies">Filmes</b-nav-item>
          <b-nav-item
            v-if="this.$auth.user.is_admin"
            class="nav-item"
            to="/registerMovie">
            Cadastrar Filme
          </b-nav-item>
          <b-nav-item class="nav-item" to="/account">Minha Conta</b-nav-item>
          <b-nav-item @click="logout">Sair</b-nav-item>
        </b-navbar-nav>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  methods: {
    async logout() {
      this.$axios.post(`logout`).catch(function (error) { console.log(error) })
      await this.$auth.logout();
    },
  },
}
</script>
