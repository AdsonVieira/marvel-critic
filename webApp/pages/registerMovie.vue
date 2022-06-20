<template>
  <div>
    <Navbar></Navbar>
    <section class="section">
      <div class="container">
        <h2 class="title mt-5">Cadastrar Filme</h2>
        <div class="content">
          <b-card>
            <b-form-group
              id="name-input"
              label="Nome"
            >
              <b-form-input
                id="name-input"
                v-model="this.$auth.user.name"
                type="text"
                disabled
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="email-input"
              label="Email"
            >
              <b-form-input
                id="email-input"
                v-model="this.$auth.user.email"
                type="text"
                disabled
              ></b-form-input>
            </b-form-group>
            <p>O seu perfil <b>{{this.$auth.user.is_admin == 1 ? 'é de administrador': 'não é de administrador'}}</b></p>
          </b-card>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  middleware: ['auth', 'admin']
}
</script>
