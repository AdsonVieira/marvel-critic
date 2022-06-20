<template>
  <div>
    <NavBarGuest></NavBarGuest>
    <div class="bg-light p-5" style="height: 94vh;">
      <h1 class="display-1 text-center">Marvel Critic</h1>
      <p class="lead text-center">
        Avalie os principais filmes da Marvel
      </p>

      <hr class="my-4 w-75">
      <div class="d-flex justify-content-center">
        <b-button class="mr-3" variant="success" to="/login">Login</b-button>
        <b-button variant="primary" to="/register">Criar conta</b-button>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  components: {},

  middleware: 'guest'
}
</script>
