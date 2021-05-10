<template>
  <header
    id="mbfilmfest_banners"
    class="mbfilmfest_banners"
  >
    <ul>
      <li v-for="banner in banners"
        :class="banner.link ? 'has-link' : ''"
        :style="{
          backgroundColor: banner.background
      }"
        :key="banner.id">
        <img :src="banner.image"
          :style="{
            maxWidth: banner.width ? banner.width : 'calc(100vw - (100vw - 100%))',
            maxHeight: banner.height
          }"
        @click="goToLink(banner.link, banner.newWindow)">
      </li>
    </ul>
  </header>
</template>


<script>
export default {
  name: 'MBFFBanners',
  props: {
    banners: Array
  },
  methods: {
    goToLink(link) {
      if (link && link != '') {
        window.open(link)
      }
    }
  }
}
</script>

<style>
.mbfilmfest_banners {
  width: calc(100vw - (100vw - 100%));
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}

.mbfilmfest_banners ul,
.mbfilmfest_banners li {
  list-style: none;
  margin: 0;
  padding: 0;
}

.mbfilmfest_banners li,
.mbfilmfest_banners img {
  display: block;
}

.mbfilmfest_banners img {
  width: auto;
  height: auto;
  margin: 0 auto;
}

.mbfilmfest_banners li.has-link:hover {
  cursor: pointer;
}
</style>