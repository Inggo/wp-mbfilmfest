<template>
  <section :class="[
    'mbfilmfest_films',
    layout == 'featured' ? 'mbfilmfest_featurefilms' : 'mbfilmfest_shortfilms'
  ]">
    <h3>{{ title }}</h3>
    <ul>
      <li 
        v-for="film in films" 
        ref="films" 
        :key="film.id" 
        @click="playFilm(film.embed)"
        @mouseover="setFocusFilm(film.id)"
        @mouseout="unfocusFilm(film.id)"
        :class="{
          mbfilmfest_focused_film: focusedOnFilm == film.id,
          mbfilmfest_film_preload: !filmLoaded.includes(film.id),
          mbfilmfest_film_loaded: filmLoaded.includes(film.id)
        }"
      >
        <div class="mbfilmfest_filmcover_container">
          <div class="mbfilmfest_filmcover" :style="{ backgroundImage: 'url(' + film.image + ')'}"></div>
        </div>
        <h4>{{ film.title }}</h4>
        <div class="mbfilmfest_description_container">
          <p v-html="film.description.replace(/\r/g,'').replace(/\n/g,'<br>')"></p>
        </div>
        <div class="mbfilmfest_play_button" 
          :style="{ backgroundImage: 'url(' + baseUrl + 'play.svg)'}">
        </div>
      </li>
    </ul>
    <transition name="fade">
      <div class="mbfilmfest_player" v-show="playing">
        <div class="mbfilmfest_player_viewport">
          <button class="mbfilmfest_close_player" @click="stopFilm">&times;</button>
          <div class="mbfilmfest_embed" v-html="currentEmbed"></div>
        </div>
      </div>
    </transition>
  </section>
</template>

<script>
export default {
  props: {
    title: String,
    films: Array,
    layout: {
      type: String,
      default: "basic"
    }
  },
  data() {
    return {
      focusedOnFilm: false,
      playing: false,
      currentEmbed: '',
      filmLoaded: [],
      filmHeights: [],
      baseUrl: window.mbfilmfest.baseUrl + 'src/assets/'
    }
  },
  computed: {
    defaultHeight() {
      return this.layout == 'featured' ? '580px' : '320px';
    }
  },
  methods: {
    setFocusFilm(filmId) {
      this.focusedOnFilm = filmId;
      /*
      this.$refs.films[this.filmLoaded.indexOf(filmId)].style.height =
        this.filmHeights[this.filmLoaded.indexOf(filmId)] + 'px';
      */
    },
    unfocusFilm() {
      this.focusedOnFilm = false;
      // this.$refs.films[this.filmLoaded.indexOf(filmId)].style.height = this.defaultHeight;
    },
    playFilm(embed) {
      document.body.classList.add("mbfilmfest_film_playing");
      this.currentEmbed = embed;
      this.playing = true;
    },
    stopFilm() {
      document.body.classList.remove("mbfilmfest_film_playing");
      this.currentEmbed = null;
      this.playing = false;
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.films.forEach((film, index) => {
        this.$refs.films[index].style.height = 'auto';
        /*
        this.filmHeights.push(this.$refs.films[index].clientHeight);
        this.$refs.films[index].style.height = this.defaultHeight;
        */
        this.filmLoaded.push(film.id);
      });
    });
  }
}
</script>

<style>
.mbfilmfest_film_playing {
  overflow: hidden;
}

.mbfilmfest_films ul {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: flex-start;
}

.mbfilmfest_films li {
  width: 33%;
  display: block;
  position: relative;
  border: 1px solid rgba(99,99,99);
  padding: 1em;
  margin: 0 0 2em;
  align-items: stretch;
  border-radius: 1em;
  overflow: hidden;
  box-shadow: 0 0 .5em .01em rgba(0,0,0,0.8);
  -webkit-box-shadow: 0 0 .5em .01em rgba(0,0,0,0.8);
  -moz-box-shadow: 0 0 .5em .01em rgba(0,0,0,0.8);
  transition: height 0.4s ease-out, transform 0.4s ease-out;
  height: 320px;
  transform: scale(0.9);
}

.mbfilmfest_featurefilms.mbfilmfest_films li {
  height: 580px;
}

.mbfilmfest_films li:hover {
  cursor: pointer;
}

.mbfilmfest_filmcover_container {
  position: relative;
  width: calc(100% + 2em);
  height: 250px; 
  overflow: hidden;
  margin: -1em -1em 0;
}

.mbfilmfest_featurefilms .mbfilmfest_filmcover_container {
  height: 500px;
}

.mbfilmfest_filmcover {
  position: relative;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  transition: transform 0.5s;
}

.mbfilmfest_films li:hover .mbfilmfest_filmcover {
  transform: scale(1.1);
}

.mbfilmfest_films li:hover {
  transform: scale(1);
}

.mbfilmfest_player {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: calc(100vw - (100vw - 100%));
  height: 100vh;
  background: rgba(0,0,0,.95);
  z-index: 110508;
}

.mbfilmfest_player_viewport {
  display: flex;
  align-items: center;
  justify-content: center;
  width: calc(100vw - (100vw - 100%));
  height: 100vh;
}

.mbfilmfest_embed {
  width: 90vw;
  height: 90vh;
}

.mbfilmfest_embed iframe {
  width: 100%;
  height: 100%;
}

.mbfilmfest_close_player {
  position: fixed;
  top: 0;
  right: 0;
  width: 48px;
  height: 48px;
  font-size: 24px;
  line-height: 48px;
  padding: 0;
  opacity: .2;
}

.mbfilmfest_play_button {
  font-size: 0;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 250px;
  background-color: rgba(255,255,255,0.1);
  background-repeat: no-repeat;
  background-position: center center;
  background-size: 125px;
  z-index: 100;
  transition: opacity .4s;
  opacity: 0;
}

.mbfilmfest_featurefilms .mbfilmfest_play_button {
  height: 500px;
  background-size: 200px;
}

.mbfilmfest_focused_film .mbfilmfest_play_button {
  opacity: .8;
}

.mbfilmfest_film_preload .mbfilmfest_description_container,
.mbfilmfest_focused_film .mbfilmfest_description_container {
  height: auto;
}

.mbfilmfest_focused_film .mbfilmfest_description_container p {
  white-space: unset;
  overflow: visible;
}

.mbfilmfest_description_container {
  /*
  height: 2rem;
  */
  height: auto;
}

/*
.mbfilmfest_film_loaded:not(.mbfilmfest_focused_film) .mbfilmfest_description_container p {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
*/

.mbfilmfest_close_player:hover {
  opacity: 1;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
    flex: 1;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
