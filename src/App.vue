<template>
  <div class="mbfilmfest_container">
    <MBFFHeader :image="header.image"></MBFFHeader>
    <MBFFContents :films="contents.films"></MBFFContents>
    <MBFFHeader v-for="promo in promos"
      :image="promo.image"
      :title="promo.title"
      :link="promo.link ? promo.link : null"
      :key="promo.id"></MBFFHeader>
    <MBFFPartners :partners="partners" title="Partners"></MBFFPartners>
  </div>
</template>

<script>
import { default as MBFFHeader } from './Components/Header';
import { default as MBFFContents } from './Components/Contents';
import { default as MBFFPartners } from './Components/Partners';

export default {
  name: 'App',
  components: {
    MBFFHeader, MBFFContents, MBFFPartners
  },
  data() {
    return window.mbfilmfest // From wordpress
  }
}
</script>

<style>
body.has-mbfilmfest-.page-two-column:not(.archive) #primary .entry-header {
  display: none;
}
body.has-mbfilmfest-shortcode .wrap {
  max-width: none;
  padding: 0;
}
body.has-mbfilmfest-shortcode.page-two-column:not(.archive) #primary .entry-content {
  float: none;
  width: 100%;
}

</style>
