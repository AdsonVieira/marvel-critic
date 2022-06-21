<template>
  <div>
    <Navbar></Navbar>
    <section class="section">
      <div class="container">
        <h2 class="title mt-5">Cadastrar Filme</h2>
        <b-alert :show="this.showError" variant="danger">{{ this.errorMsg }}</b-alert>
        <form method="post" @submit.prevent="registerMovie">
          <div class="content">
            <b-card>
              <b-form-group
                id="name-input"
                label="Nome"
              >
                <b-form-input
                  id="name-input"
                  v-model="name"
                  type="text"
                  required
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="synopsis-input"
                label="Sinopse"
              >
                <b-form-input
                  id="synopsis-input"
                  v-model="synopsis"
                  type="text"
                  required
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="thumbnailUrl-input"
                label="Url da capa do Filme"
              >
                <b-form-input
                  id="thumbnailUrl-input"
                  v-model="thumbnailUrl"
                  type="text"
                  required
                ></b-form-input>
              </b-form-group>
              <b-button block type="submit" class="mr-3" variant="success">Salvar filme</b-button>
            </b-card>
          </div>
        </form>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  middleware: ['auth', 'admin'],

  data() {
    return {
      name: '',
      synopsis: '',
      thumbnailUrl: '',
      showError: false,
      errorMsg: ''
    }
  },

  methods: {
    async registerMovie() {
      let self = this;

      this.$axios.post(`movies`, {
        name: this.name,
        synopsis: this.synopsis,
        thumbnail_url: this.thumbnailUrl
      })
      .then(response => {
        this.$bvToast.toast(`Agora é começar a avaliar`, {
          title: 'Filme cadastrado com sucesso',
          autoHideDelay: 5000,
          variant: 'success'
        })

        this.name = ''
        this.synopsis = ''
        this.thumbnailUrl = ''
        this.errorMsg = ''
        this.showError = false
        this.$router.push('/registerMovie')
      })
      .catch(function (e) {
        self.showError = true
        self.errorMsg = e.response.data.error
      })
    }
  }

}
</script>
