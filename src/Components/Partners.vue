<template>
  <div
    class="mbfilmfest_links_container"
    :style="{
      backgroundColor: background
    }"
  >
    <section
      class="mbfilmfest_links"
      :class="layout == 'instax' ? 'mbfilmfest_links_instax' : null"
    >
      <h3 v-if="title">{{ title }}</h3>
      <ul>
        <li 
          v-for="link in links" 
          :key="link.id" 
          :ref="link.id"
          @click="goToLink(link.link)"
          :style="layout == 'instax' ? randomRot() : null"
        >
          <img :src="link.image" :alt="link.name">
          <h4 v-if="showNames">{{ link.name }}</h4>
        </li>
      </ul>
    </section>
  </div>
</template>

<script>
export default {
  props: {
    showNames: {
      type: Boolean,
      default: true
    },
    title: String,
    links: Array,
    background: {
      type: String,
      default: '#FFF'
    },
    layout: String
  },
  methods: {
    goToLink(link) {
      window.open(link)
    },
    randomRot() {
      return 'transform: ' + this.randomRotValue();
    },
    randomRotValue() {
      return 'rotate(' + 
        ((Math.random() * 5) * (Math.random() < .5 ? 1 : -1)) + 
        'deg)';
    }
  }
}
</script>

<style>
.mbfilmfest_links ul {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
  align-items: flex-start;
}

.mbfilmfest_links li {
  width: 20%;
  display: block;
  position: relative;
  margin: 0 1em 2em;
  transition: transform 0.6s;
  overflow: hidden;
  align-items: stretch;
  padding: 1em;
  overflow: hidden;
}

.mbfilmfest_links.mbfilmfest_links_instax li {
  background: #fff;
  border: 1px solid rgba(99,99,99);
  box-shadow: 0 0 .2em .01em rgba(0,0,0,0.8);
  -webkit-box-shadow: 0 0 .2em .01em rgba(0,0,0,0.8);
  -moz-box-shadow: 0 0 .2em .01em rgba(0,0,0,0.8);
}

.mbfilmfest_links li:hover {
  cursor: pointer;
  transform: rotate(0) !important;
}
</style>
