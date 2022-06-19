<template>
  <div>
    <Navbar></Navbar>
    <section class="section">
      <div class="container">
        <h2 class="title">Filmes</h2>
        <div class="content">

          <div>
            <b-card-group columns>
              <b-card
                v-for="movie in tableData" :key="movie.id"
                :title="movie.name"
                :img-src="movie.thumbnail_url"
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
                  <small class="text-muted">Last updated 3 mins ago</small>
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
import { mapGetters } from 'vuex'
import Navbar from "../components/Navbar";
import axios from 'axios';

export default {
  components: {Navbar},
  middleware: 'auth',

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
        .catch(function (error) { console.log(error); })
    },

    updateCurrentPage(currentPage) {
      console.log(currentPage)
      this.getMovies(currentPage)
    },

    rateMovie(value, movieId) {
      this.$axios.post(`user-rating`, {
        movieId: movieId,
        evaluationGrade: value
      })
        .then(response => {
          console.log(response);
        })
        .catch(function (error) { console.log(error); })
    },

    getRate(movie) {
      if (movie.user_rating !== null) {
        return movie.user_rating.evaluation_grade
      }
      return 0
    }

  }
}
</script>
