<template>
  <section class="mbfilmfest_partners">
    <h3>{{ title }}</h3>
    <ul>
      <li 
        v-for="partner in partners" 
        :key="partner.id" 
        :ref="partner.id"
        @click="goToLink(partner.link)"
        :style="randomRot()"
      >
        <img :src="partner.image" :alt="partner.name">
        <h4>{{ partner.name }}</h4>
      </li>
    </ul>
  </section>
</template>

<script>
export default {
  props: {
    title: String,
    partners: Array
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
