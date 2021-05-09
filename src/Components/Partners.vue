<template>
  <section
    class="mbfilmfest_partners"
    :class="layout == 'instax' ? 'mbfilmfest_partners_instax' : null"
    :style="{
      backgroundColor: background
    }"
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
.mbfilmfest_partners ul {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
  align-items: flex-start;
}

.mbfilmfest_partners li {
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

.mbfilmfest_partners.mbfilmfest_partners_instax li {
  background: #fff;
  border: 1px solid rgba(99,99,99);
  box-shadow: 0 0 .2em .01em rgba(0,0,0,0.8);
  -webkit-box-shadow: 0 0 .2em .01em rgba(0,0,0,0.8);
  -moz-box-shadow: 0 0 .2em .01em rgba(0,0,0,0.8);
}

.mbfilmfest_partners li:hover {
  cursor: pointer;
  transform: rotate(0) !important;
}
</style>
