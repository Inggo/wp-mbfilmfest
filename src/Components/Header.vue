<template>
  <header
    id="mbfilmfest_header"
    class="mbfilmfest_header"
    :class="link ? 'has-link' : ''"
    :style="{
      backgroundImage: 'url(' + image + ')',
      width: width,
      height: height
    }"
    @click="goToLink()"
  >
  </header>
</template>


<script>
export default {
  name: 'MBFFHeader',
  props: {
    image: String,
    link: {
      type: String,
      default: ''
    },
    width: {
      type: String,
      default: '100vw'
    },
    height: {
      type: String,
      default: '50vh'
    }
  },
  methods: {
    goToLink() {
      if (this.link && this.link != '') {
        window.open(this.link)
      }
    }
  }
}
</script>

<style scoped>
.mbfilmfest_header {
  width: 100vw;
  height: 50vh;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
.mbfilmfest_header.has-link:hover {
  cursor: pointer;
}
</style>