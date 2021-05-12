<template>
  <header
    id="mbfilmfest_banners"
    class="mbfilmfest_banners"
  >
    <VueAgile
      v-show="windowLoaded"
      :autoplay="isCarousel"
      ref="carousel"
      @before-change="setContainerDimensions($event)"
      :style="{
        height: currentSlideHeight
      }"
      :class="{
        'mbfilmfest_banner_carousel' : this.banners.length > 1
      }"
    >
      <div v-for="(banner, index) in banners"
        ref="slides"
        :class="{
          'mbfilmfest_banner': true,
          'has-link': banner.link
        }"
        :style="{
            backgroundColor: banner.background,
        }"
        :key="banner.id"
      >
        <img :src="banner.image"
          :style="slideDimensions[index]"
          ref="bannerImages"
          @click="goToLink(banner.link, banner.newWindow)"
        >
      </div>
    </VueAgile>
  </header>
</template>


<script>
import { VueAgile } from 'vue-agile';

export default {
  name: 'MBFFBanners',
  components: {
    VueAgile
  },
  props: {
    banners: Array
  },
  data() {
    return {
      windowLoaded: false,
      currentSlideWidth: 0,
      currentSlideHeight: 0,
      sliderOptions: {
        autoplaySpeed: 6000,
        centerMode: true,
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    navButtons: this.banners.length > 1,
                    dots: false
                }
            },
            {
                breakpoint: 900,
                settings: {
                    navButtons: this.banners.length > 1,
                    dots: this.banners.length > 1
                }
            }
        ]
      },
      slideDimensions: []
    }
  },
  computed: {
    isCarousel() {
      return this.banners.length > 1
    }
  },
  methods: {
    setSlideDimensions() {
      let dimensions = [];
      for (let i = 0; i < this.banners.length; i++) {
        let banner = this.banners[i];
        if (banner.width <= document.documentElement.clientWidth && banner.height <= document.documentElement.clientHeight) {
          dimensions.push({
            width: banner.width + 'px',
            height: banner.height + 'px'
          });
        } else if (banner.height <= document.documentElement.clientHeight) {
          dimensions.push({
            width: document.documentElement.clientWidth + 'px',
            height: banner.height / (banner.width/document.documentElement.clientWidth) + 'px'
          })
        } else if (banner.width <= document.documentElement.clientWidth) {
          dimensions.push({
            width: banner.width / (banner.height/document.documentElement.clientHeight) + 'px',
            height: document.documentElement.clientHeight + 'px'
          })
        } else {
          // Edge case, follow width
          dimensions.push({
            width: document.documentElement.clientWidth + 'px',
            height: banner.height / (banner.width/document.documentElement.clientWidth) + 'px'
          })
        }
      }
      this.slideDimensions = dimensions;
    },
    setContainerDimensions(event) {
      this.currentSlideWidth = this.slideDimensions[event.nextSlide].width;
      this.currentSlideHeight = this.slideDimensions[event.nextSlide].height;
    },
    goToLink(link) {
      if (link && link != '') {
        window.open(link)
      }
    }
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener('load', () => {
        this.windowLoaded = true;
        this.setSlideDimensions();
        this.$nextTick(() => {
          this.currentSlideWidth = this.slideDimensions[0].width;
          this.currentSlideHeight = this.slideDimensions[0].height;
          this.$refs.carousel.reload();
        });
        window.addEventListener('resize', () => {
          this.setSlideDimensions();
          this.$nextTick(() => {
            this.$refs.carousel.reload();
          });
        });
      });
    });
  }
}
</script>

<style>
.mbfilmfest_banners .agile {
  position: relative;
  transition: height .3s;
  width: 100%;
}

.mbfilmfest_banners .has-link:hover {
  cursor: pointer;
}

.mbfilmfest_banner {
  position: relative;
  width: 100%;
  height: 100%;
}

.mbfilmfest_banner img {
  max-width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
}

.mbfilmfest_banners .agile__list {
  height: 100%;
  position: absolute;
}

.mbfilmfest_banners .agile__slides {
  align-items: flex-start;
}

.mbfilmfest_banners .mbfilmfest_banner_carousel .agile__actions {
  display: flex;
}

.mbfilmfest_banners:hover .agile__actions {
  opacity: .9;
}

.mbfilmfest_banners .agile__actions {
  display: none;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  align-items: stretch;
  opacity: 0;
  transition: opacity .4s;
  pointer-events: none;
}

.mbfilmfest_banners .agile__nav-button {
  pointer-events: auto;
  padding: 16px;
  border-radius: 0;
}

.mbfilmfest_banners .agile__nav-button,
.mbfilmfest_banners .agile__nav-button:active,
.mbfilmfest_banners .agile__nav-button:focus {
  background: none;
  border: none;
  outline: none;
}

.mbfilmfest_banners .agile__dots {
  margin: auto auto 0;
  height: 48px;
}

.mbfilmfest_banners .agile__dot {
  padding: 8px;
}

.mbfilmfest_banners .agile__dot button {
  width: 16px;
  height: 16px;
  border: 2px solid #fff;
  background: transparent;
  pointer-events: auto;
  opacity: .5;
  transition: opacity .4s;
}

.mbfilmfest_banners .agile__dot button,
.mbfilmfest_banners .agile__dot button:focus,
.mbfilmfest_banners .agile__dot button:active {
  outline: none;
}

.mbfilmfest_banners .agile__dot:hover button {
  opacity: 1;
}

.mbfilmfest_banners .agile__dot.agile__dot--current button {
  background: #fff;
}

.mbfilmfest_banners .agile__nav-button:hover {
  background: rgba(0,0,0,.2);
  border: none;
  outline: none;
}
</style>