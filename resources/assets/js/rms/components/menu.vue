<template>
<ul class="nav flex-column">
  <menu-child v-for="(tree,inx) in treeData" :model="tree" :key="inx"></menu-child>
</ul>
</template>

<script>
import api from "../api";

export default {
  data() {
    return {
      treeData: [
        // {
        //   text: 'System & Permissions',
        //   icon: 'fas fa-align-center',
        //   children: [
        //     {
        //       text: 'Permission',
        //       children: [
        //         {text: 'Route', href: '/admin#/route'}
        //       ]
        //     },
        //     {
        //       text: 'Menu',
        //       children: [
        //         {
        //           text: 'List',
        //           href: '/admin#/menu',
        //         },
        //         {
        //           text: 'Create',
        //           href: '/admin#/menu-create',
        //         },
        //       ]
        //     }
        //   ],
        // },
        // {
        //   text: 'Parent 2',
        //   href: '/admin#/permission'
        // }
      ]
    };
  },
  created() {
    var _this = this;
    api.getAuthMenu(this.$route.query.group).then(res =>{
      _this.treeData = res.body.data;
    });
  }
};
</script>

