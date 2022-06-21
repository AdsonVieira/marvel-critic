<template>
  <div>
    <Navbar></Navbar>
    <section class="section">
      <div class="container">
        <h2 class="title mt-5">Filmes</h2>
        <div class="content">
          <div>
            <p v-if="tableData.length == 0" class="lead text-center">
              Avalie os principais filmes da Marvel
            </p>
            <b-card-group columns>
              <b-card
                v-for="movie in tableData" :key="movie.id"
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
      tableData: [],
      fieldsTable: ['id', 'name', 'thumbnail_url', 'rate'],
      currentPage: 1,
      totalRows: 0,
      perPage: 0
    }
  },

  mounted () {
    this.getMovies(1)
  },

  methods: {
    async getMovies(currentPage) {
      this.$axios.get(`movies?page=${currentPage}`)
        .then(response => {
          this.tableData = response.data.data

          let meta = response.data.meta
          this.totalRows = meta.total
          this.perPage = meta.per_page

        })
        .catch(function (error) { console.log(error) })
    },

    async deleteMovie(id) {
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
