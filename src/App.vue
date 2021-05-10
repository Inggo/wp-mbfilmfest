<template>
  <div class="mbfilmfest_container">
    <MBFFBanners :banners="contents.primaryBanners"></MBFFBanners>
    <MBFFContents :films="contents.films"></MBFFContents>
    <MBFFBanners :banners="contents.secondaryBanners"></MBFFBanners>
    <MBFFLinks
      :links="primaryLinks"
      :title="settings.primaryLinksTitle"
      :description="settings.primaryLinksDescription"
      :background="settings.primaryLinksBackground"
      :layout="settings.primaryLinksFormat"
      :showNames="settings.showPrimaryLinkNames"
    ></MBFFLinks>
    <MBFFLinks
      :links="secondaryLinks"
      :title="settings.secondaryLinksTitle"
      :description="settings.secondaryLinksDescription"
      :background="settings.secondaryLinksBackground"
      :layout="settings.secondaryLinksFormat"
      :showNames="settings.showSecondaryLinkNames"
    ></MBFFLinks>
  </div>
</template>

<script>
import { default as MBFFBanners } from './Components/Banners';
import { default as MBFFContents } from './Components/Contents';
import { default as MBFFLinks } from './Components/Links';

export default {
  name: 'App',
  components: {
    MBFFBanners, MBFFContents, MBFFLinks
  },
  data() {
    return window.mbfilmfest // From wordpress
  },
  computed: {
    primaryLinks() {
      return this.settings.primaryLinksFilter
        ? this.contents.links.filter(link => link.tags.includes(this.settings.primaryLinksFilter))
        : this.contents.links;
    },
    secondaryLinks() {
      return this.settings.secondaryLinksFilter
        ? this.contents.links.filter(link => link.tags.includes(this.settings.secondaryLinksFilter))
        : this.contents.links;
    }
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
