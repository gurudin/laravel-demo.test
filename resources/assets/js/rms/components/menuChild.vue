<template>
<li class="nav-item">
  <a :href="model.href ? model.href : 'javascript:;'"
    class="nav-link"
    :class="{'active': open}"
    @click="openChild">

    <i class="feather" :class="model.icon"></i>
    <span>{{model.text}}</span>
    <span class="float-right">
      <i :class="isFolder ? 'fas fa-angle-' + (open ? 'down' : 'right') : ''"></i>
    </span>
  </a>

  <transition name="fade">
  <ul v-show="open" v-if="isFolder" class="nav flex-column child_menu">
    <menu-child
      v-for="(model, index) in model.children"
      :key="index"
      :model="model">
    </menu-child>
  </ul>
  </transition>

</li>
</template>

<script>
export default {
  data() {
    return {
      open: false
    };
  },
  props: {
    model: null
  },
  computed: {
    isFolder() {
      return this.model.children && this.model.children.length;
    }
  },
  methods: {
    openChild() {
      if (this.isFolder) {
        this.open = !this.open;
      }
    }
  },
};
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
