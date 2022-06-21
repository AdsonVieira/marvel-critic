<template>
  <div>
    <Navbar></Navbar>
    <section class="section">
      <div class="container">
        <h2 class="title mt-5">Filmes</h2>
        <div class="content">
          <div>
            <p v-if="movieList.length == 0" class="lead text-center">
              Não existem filmes para exibir
            </p>
            <div class="mb-5">
              <nav class="navbar navbar-light bg-light">
                <input
                  class="form-control mr-sm-2 full-width"
                  @change="searchMovie"
                  v-model="searchByName"
                  type="search" placeholder="Pesquise por filmes, aperte enter para buscar"
                  aria-label="Search"
                />
              </nav>
            </div>
            <b-card-group columns>
              <b-card
                v-for="movie in movieList" :key="movie.id"
                :title="movie.name"
                :img-src="(movie.thumbnail_url !== '') ? movie.thumbnail_url: require(`../static/no-photo.jpg`)"
                img-alt="Image"
                img-top
                tag="article"
                style="max-width: 20rem;"
                class="mb-2"
              >
                <b-card-text>
                  {{movie.synopsis}}
                </b-card-text>

                <p><b>Avaliar</b></p>
                <b-form-rating
                  :key="movie.id"
                  id="rating-sm"
                  size="sm"
                  variant="warning"
                  @change="rateMovie($event, movie.id)"
                  :value="getRate(movie)"
                ></b-form-rating>
                <template #footer>
                  <small class="text-muted">Última atualização em {{calcLastUpdate(movie)}}</small>
                  <div v-if="userIsAdmin()">
                    <b-button @click="deleteMovie(movie.id)" size="sm" variant="danger">Deletar</b-button>
                    <b-button size="sm" :to="`/editMovie?id=${movie.id}`">Editar</b-button>
                  </div>
                </template>
              </b-card>
            </b-card-group>
            <b-pagination
              pills
              align="center"
              v-model="currentPage"
              :total-rows="totalRows"
              :per-page="perPage"
              aria-controls="table-movie"
              @input="updateCurrentPage(currentPage)"
            ></b-pagination>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>

import Navbar from "../components/Navbar"

export default {
  middleware: ['auth'],

  components: {Navbar},

  data() {
    return {
      movieList: [],
      currentPage: 1,
      totalRows: 0,
      perPage: 0,
      searchByName: ''
    }
  },

  mounted () {
    this.getMovies(1)
  },

  methods: {
    async getMovies(currentPage) {
      this.$axios.get(`movies?page=${currentPage}`)
        .then(response => {
          this.movieList = response.data.data

          let meta = response.data.meta
          this.totalRows = meta.total
          this.perPage = meta.per_page

        })
        .catch(function (error) { console.log(error) })
    },

    async searchMovie() {
      this.$axios.get(`movies?page=1&name=${this.searchByName}`)
        .then(response => {
          this.movieList = response.data.data

          let meta = response.data.meta
          this.totalRows = meta.total
          this.perPage = meta.per_page

        })
        .catch(function (error) { console.log(error) })
    },

    async deleteMovie(id) {
      if (window.confirm("Deseja realmente deletar?")) {
        this.$axios.delete(`movies/${id}`)
          .then(response => {
            this.$bvToast.toast(`Atualizando Feed`, {
              title: 'Filme deletado com sucesso',
              autoHideDelay: 5000,
              variant: 'success'
            })
            this.getMovies(1)
          })
          .catch(function (error) { console.log(error) })
      }
    },

    updateCurrentPage(currentPage) {
      this.getMovies(currentPage)
    },

    rateMovie(value, movieId) {
      this.$axios.post(`user-rating`, {
        movieId: movieId,
        evaluationGrade: value
      })
      .then(response => {
        this.$bvToast.toast(`Resultado adicionado ao ranking`, {
          title: 'Avaliação feita com sucesso',
          autoHideDelay: 5000,
          variant: 'success'
        })
      })
      .catch(function (error) { console.log(error) })
    },

    getRate(movie) {
      if (movie.user_rating !== null) {
        return movie.user_rating.evaluation_grade
      }
      return 0
    },

    calcLastUpdate(movie) {
      var date = new Date(movie.updated_at);
      return `${date.getHours()}h${date.getMinutes()}min`
    },

    userIsAdmin() {
      return this.$auth.user.is_admin
    }

  }
}
</script>
