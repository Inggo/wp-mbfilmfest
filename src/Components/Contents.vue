<template>
  <main
    id="mbfilmfest_body"
    class="mbfilmfest_body"
  >
    <MBFFFilmList
      title="Feature Films"
      layout="featured"
      :films="featuredFilms"
      ref="featureFilms"
      @film-focused="$refs.shortFilms.unfocusFilm()"
    ></MBFFFilmList>
    <MBFFFilmList
      title="Short Films"
      :films="shortFilms"
      ref="shortFilms"
      @film-focused="$refs.featureFilms.unfocusFilm()"
    ></MBFFFilmList>
  </main>
</template>

<script>
import { default as MBFFFilmList } from './Films';

export default {
  name: 'MBFFContents',
  props: {
    films: Array
  },
  components: {
    MBFFFilmList
  },
  computed: {
    featuredFilms() {
      if (this.films) {
        return this.films.filter(film => film.tags.includes('Feature Films'))
      }
      return []
    },
    shortFilms() {
      if (this.films) {
        return this.films.filter(film => film.tags.includes('Short Films'))
      }
      return []
    }
  }
}
</script>

<style>
.mbfilmfest_body {
  margin: 0 auto;
  max-width: 1140px;
}
</style>