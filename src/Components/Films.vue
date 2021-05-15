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
        @mouseenter="isMobile ? null : setFocusFilm(film)"
        @mouseleave="isMobile ? null : unfocusFilm()"
        :class="{
          mbfilmfest_focused_film: focusedOnFilm == film.id,
          mbfilmfest_film_preload: !filmLoaded.includes(film.id),
          mbfilmfest_film_loaded: filmLoaded.includes(film.id),
          mbfilmfest_film_playable: isFilmPlayable(film)
        }"
      >
        <div class="mbfilmfest_filmcover_container"
          @click="selectFilm(film)"
          :style="{
            height: filmcoverHeight + 'px'
          }"
        >
          <div class="mbfilmfest_filmcover"
            :style="{
              backgroundImage: 'url(' + film.image + ')'
            }"
            ></div>
        </div>
        <div class="mbfilmfest_description_container"
          @click="selectFilm(film)"
        >
          <h4>{{ film.title }}</h4>
          <p class="mbfilmfest_description_screentime" v-if="film.screening_time">{{ film.screening_time }}</p>
          <p v-html="film.description"></p>
          <p class="mbfilmfest_watch_now" v-if="isFilmPlayable(film)">
            <a
              href="#"
              @click.prevent="playFocusedFilm(film)"
            >Watch Now</a>
          </p>
        </div>
        <div class="mbfilmfest_play_button" 
          :style="{
            backgroundImage: 'url(' + baseUrl + 'play.svg)',
            height: filmcoverHeight + 'px'
          }"
          @click.stop="playFocusedFilm(film)"
          v-if="isFilmPlayable(film)"
        >
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
let isMobile = require('is-mobile');

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
      focusedFilmIsPlayable: false,
      focusedOnFilm: false,
      playing: false,
      currentEmbed: '',
      filmLoaded: [],
      filmHeights: [],
      filmcoverHeight: 0,
      baseUrl: window.mbfilmfest.baseUrl + 'src/assets/'
    }
  },
  computed: {
    defaultHeight() {
      let contentHeight = document.documentElement.clientWidth < 1366 ? 105 : 118;
      return (this.filmcoverHeight + contentHeight) + 'px';
    },
    isMobile() {
      return isMobile();
    }
  },
  methods: {
    isFilmPlayable(film) {
      let now = Date.now();
      return (!film.startTime || Date(film.startTime) <= now) &&
          (!film.endTime || Date(film.endTime) >= now);
    },
    calculateFilmcoverHeight() {
      // featured: 1980x1280 1:1.44385 ; default: 1980x1080 1.77776:1
      let height = 0;
      
      if (document.documentElement.clientWidth < 500) {
        // 100% width
        height = (this.layout == 'featured')
          ? document.documentElement.clientWidth * 1.44385
          : document.documentElement.clientWidth / 1.777776;
      } else if (document.documentElement.clientWidth < 800) {
        // 50% width
        height = (this.layout == 'featured')
          ? (document.documentElement.clientWidth * 1.44385) / 2
          : (document.documentElement.clientWidth / 1.777776) / 2;
      } else {
        // 33% width
        height = this.layout == 'featured' ? 540 : 191;
      }
      this.filmcoverHeight = height;
    },
    playFocusedFilm(film) {
      if (this.focusedOnFilm == film.id) {
        return this.playFilm(film.embed);
      }
    },
    setFocusFilm(film) {
      this.unfocusFilm();
      this.focusedOnFilm = film.id;
      this.$refs.films[this.filmLoaded.indexOf(film.id)].style.height =
        this.filmHeights[this.filmLoaded.indexOf(film.id)] + 'px';
      if (this.isFilmPlayable(film)) {
        this.focusedFilmIsPlayable = true;
      }
      if (this.isMobile) {
        // Scroll to bottom of description after animation
        setTimeout(() => {
          // Double check focused film
          if (!this.focusedOnFilm == film.id) {
            return;
          }

          let padTop = 24; // Add some white space on top
          let filmIndex = this.films.map(f => f.id).indexOf(film.id);
          let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
          let filmRef = this.$refs.films[filmIndex];
          let cardHeight = filmRef.offsetHeight;
          let scrollTo = scrollTop;

          if (cardHeight > window.innerHeight) {
            let descRef = filmRef.querySelector('.mbfilmfest_description_container');
            if (descRef.offsetHeight > window.innerHeight) {
              // If description height is too high, scroll to top of it
              scrollTo += descRef.getBoundingClientRect().top - padTop;
            } else {
              // Otherwise, scroll to bottom of height of card
              scrollTo += filmRef.getBoundingClientRect().bottom - window.innerHeight + padTop;
            }
          } else {
            scrollTo += filmRef.getBoundingClientRect().top - padTop;
          }
          
          window.scroll({
            top: scrollTo,
            behavior: 'smooth'
          });
        }, 125);
      }
      this.$emit('film-focused', film);
    },
    unfocusFilm() {
      this.focusedOnFilm = false;
      this.focusedFilmIsPlayable = false;
      for (let i = 0; i < this.$refs.films.length; i++) {
        this.$refs.films[i].style.height = this.defaultHeight;
      }
    },
    selectFilm(film) {
      if (this.isMobile) {
        return this.focusedOnFilm == film.id
          ? this.unfocusFilm(film)
          : this.setFocusFilm(film);
      }
      return this.playFilm(film.embed);
    },
    playFilm(embed) {
      if (!this.focusedFilmIsPlayable) {
        return false;
      }
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
      this.calculateFilmcoverHeight();
      this.$nextTick(() => {
        this.films.forEach((film, index) => {
          this.filmHeights.push(this.$refs.films[index].clientHeight);
        });
        this.$nextTick(() => {
          this.films.forEach((film, index) => {
            this.$refs.films[index].style.height = this.defaultHeight;
            this.filmLoaded.push(film.id);
          });
        });
      });
    });
  }
}
</script>

<style>
body.mbfilmfest_film_playing {
  overflow: hidden !important;
}

.mbfilmfest_films ul {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: flex-start;
  padding: 0;
  margin: 0;
}

.mbfilmfest_films li {
  font-size: 1.2rem;
  width: 100%;
  display: block;
  position: relative;
  border: 1px solid rgba(99,99,99);
  padding: 1em;
  margin: 0 0 2em;
  border-radius: 1em;
  overflow: hidden;
  box-shadow: 0 0 .5em .01em rgba(0,0,0,0.8);
  -webkit-box-shadow: 0 0 .5em .01em rgba(0,0,0,0.8);
  -moz-box-shadow: 0 0 .5em .01em rgba(0,0,0,0.8);
}

.mbfilmfest_films li:not(.mbfilmfest_film_loaded) {
  height: auto !important;
}

.mbfilmfest_film_loaded {
  transition: height 0.125s ease-out, transform 0.125s ease-out;
}

.mbfilmfest_film_loaded {
  transform: scale(0.95);
}

.mbfilmfest_films li:hover {
  cursor: pointer;
}

.mbfilmfest_filmcover_container {
  position: relative;
  overflow: hidden;
  margin: -1em -1em 0;
}

.mbfilmfest_filmcover {
  position: relative;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  /*
  transition: transform 0.5s;
  */
}

.mbfilmfest_films .mbfilmfest_focused_film .mbfilmfest_filmcover {
  /*
  transform: scale(1.05);
  */
}

.mbfilmfest_films .mbfilmfest_focused_film {
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
  position: relative;
  width: calc(100vw - (100vw - 100%));
  height: 90vh;
}

.mbfilmfest_embed iframe,
.mbfilmfest_embed object,
.mbfilmfest_embed embed { 
    position: absolute;
    top: 0;
    left: 0;
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
  opacity: .1;
  z-index: 11;
}

.mbfilmfest_play_button {
  font-size: 0;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 191px;
  background-color: rgba(255,255,255,0.1);
  background-repeat: no-repeat;
  background-position: center center;
  background-size: 125px;
  transition: opacity .4s;
  opacity: 0;
  z-index: -1;
}

.mbfilmfest_watch_now {
  text-align: right;
  margin: 0;
}

.mbfilmfest_focused_film .mbfilmfest_play_button {
  z-index: 100;
}

.mbfilmfest_featurefilms .mbfilmfest_play_button {
  height: 540px;
  background-size: 200px;
}

.mbfilmfest_focused_film .mbfilmfest_play_button {
  opacity: .8;
}

.mbfilmfest_film_preload .mbfilmfest_description_container,
.mbfilmfest_focused_film .mbfilmfest_description_container {
  height: auto;
}

.mbfilmfest_film_loaded.mbfilmfest_focused_film .mbfilmfest_description_container p {
  white-space: normal;
  overflow: visible;
}

.mbfilmfest_description_container {
  height: 105px;
}

.mbfilmfest_description_screentime {
  font-weight: bold;
  color: #212D65;
  font-size: 1.2rem;
}

.mbfilmfest_film_loaded:not(.mbfilmfest_focused_film) .mbfilmfest_description_container p {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

.mbfilmfest_close_player:hover {
  opacity: 1;
}

/* Landscape phones */
@media screen and (min-width: 576px) {
  .mbfilmfest_films li {
    width: 50%;
  }
}

 /* Medium devices */
@media screen and (min-width: 768px) {
  .mbfilmfest_films li {
    width: 30%;
  }

  .mbfilmfest_films li:nth-child(3n + 2) {
    margin-left: auto;
    margin-right: auto;
  }
}

/* Large devices */
@media screen and (min-width: 992px) {
  .mbfilmfest_film_loaded {
    transition: height 0.2s ease-out, transform 0.2s ease-out;
  }

  .mbfilmfest_description_container {
    height: 118px;
  }
}

/* Desktop */
@media screen and (min-width: 1200px) {
}

/* Transitions */
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
