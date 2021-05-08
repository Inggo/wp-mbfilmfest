<template>
  <section :class="[
    'mbfilmfest_films',
    layout == 'featured' ? 'mbfilmfest_featurefilms' : 'mbfilmfest_shortfilms'
  ]">
    <h3>{{ title }}</h3>
    <ul>
      <li v-for="film in films" :ref="film.id" :key="film.id" @click="playFilm(film.embed)">
        <div class="mbfilmfest_filmcover_container">
          <div class="mbfilmfest_filmcover" :style="{ backgroundImage: 'url(' + film.image + ')'}"></div>
        </div>
        <h4>{{ film.title }}</h4>
        <p>{{ film.description }}</p>
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
    films: Object,
    layout: {
      type: String,
      default: "basic"
    }
  },
  data() {
    return {
      playing: false,
      currentEmbed: ''
    }
  },
  methods: {
    playFilm(embed) {
      this.currentEmbed = embed;
      this.playing = true;
    },
    stopFilm() {
      this.playing = false;
    }
  }
}
</script>

<style>
.mbfilmfest_films ul {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
  align-items: flex-start;
}

.mbfilmfest_films li {
  width: 30%;
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
}

.mbfilmfest_films li:hover {
  cursor: pointer;
}

.mbfilmfest_filmcover_container {
  position: relative;
  width: calc(100% + 2em);
  height: 20vh; 
  overflow: hidden;
  margin: -1em -1em 0;
}

.mbfilmfest_featurefilms .mbfilmfest_filmcover_container {
  height: 40vh
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
  transform: scale(1.25);
}

.mbfilmfest_player {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,.95);
  z-index: 110508;
}

.mbfilmfest_player_viewport {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100vw;
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
