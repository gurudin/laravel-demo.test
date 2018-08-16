<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{id ? $t('menu.update-menu') : $t('menu.create-menu')}}</div>

      <div class="col-4 text-right">
          <router-link :to="{path: '/menu'}" class="btn col-4 btn-light">
            <i class="fa fa-arrow-left"></i> {{$t('common.back')}}
          </router-link>
      </div>
    </div>
  </div>

  <div class="col-12">
    <form>
      <div class="form-group">
        <label>{{$t('menu.title')}}</label>
        <input
          type="text"
          class="form-control"
          v-model="modelData.title"
          :class="{'is-invalid':validate && modelData.title==''}"
          :placeholder="$t('menu.title')">
      </div>

      <div class="form-group position-relative">
        <label>{{$t('menu.parent')}}</label>
        <input
          type="text"
          class="form-control"
          v-model="modelData.parent_name"
          @blur="onBlur"
          @keyup="onSearchMenus($event)"
          :placeholder="$t('menu.parent')">

        <div class="list-group d-none" :style="classObject" ref="menu-list-group">
          <a href="javascript:;"
            class="list-group-item"
            v-for="menu in menusData"
            @mousedown="onClickMenu(menu)">
            <h5 class="list-group-item-heading">{{menu.title}}</h5>
            <p class="list-group-item-text text-muted">
                {{menu.parent_name ? menu.parent_name : 'null'}} | {{menu.route ? menu.route : 'null'}}
            </p>
          </a>
        </div>
      </div>

      <div class="form-group position-relative">
        <label>{{$t('menu.route')}}</label>
        <input
          type="text"
          class="form-control"
          v-model="modelData.route"
          @blur="onBlur"
          @keyup="onSearchRoutes($event)"
          :placeholder="$t('menu.route')">

        <div class="list-group d-none" :style="classObject" ref="route-list-group">
          <a href="javascript:;"
            class="list-group-item list-group-item-light"
            v-for="route in routeData"
            @mousedown="onClickRoute(route)">{{route.name}}</a>
        </div>

      </div>

      <div class="form-group">
        <label>{{$t('menu.order')}}</label>
        <input
          type="number"
          class="form-control"
          v-model="modelData.order"
          :placeholder="$t('menu.order')">
      </div>

      <div class="form-group">
        <label>{{$t('menu.data')}}</label>
        <textarea class="form-control" v-model="modelData.data" rows="5" :placeholder="$t('menu.data')"></textarea>
      </div>

      <button type="button" class="btn btn-success" @click="save">{{$t('common.save')}}</button>
    </form>
  </div>
</div>
</template>

<script>
import api from "../../api";
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      validate: false,
      id: "",
      classObject: {
        position: "absolute",
        width: "100%",
        "max-height": "400px",
        overflow: "scroll",
        "z-index": 1
      }
    };
  },
  computed: mapState({
    modelData: state => state.menu.menuDetail,
    routeItem: state => state.authItem.permissionItem,
    menuItem: state => state.menu.menuItem,
    routeData() {
      var keyWord = this.modelData.route && this.modelData.route.toLowerCase();
      var data = this.routeItem.route;
      if (!data) {
        return [];
      }

      data = data.filter(row => {
        return (
          String(row.name)
            .toLowerCase()
            .indexOf(keyWord) > -1
        );
      });

      return data;
    },
    menusData: function() {
      var keyWord =
        this.modelData.parent_name && this.modelData.parent_name.toLowerCase();
      var data = this.menuItem;

      data = data.filter(row => {
        return (
          String(row.title)
            .toLowerCase()
            .indexOf(keyWord) > -1
        );
      });

      return data;
    }
  }),
  created() {
    this.id = this.$route.params.id;
    this.getMenuDetail(this.$route.params.id);
    this.getMenuList();
    this.getPermission();
  },
  methods: {
    ...mapActions(["getMenuDetail", "getPermission", "getMenuList"]),
    onBlur() {
      $(this.$refs["route-list-group"]).addClass("d-none");
      $(this.$refs["menu-list-group"]).addClass("d-none");
    },
    onSearchRoutes(event) {
      if (event.target.value == "") {
        $(this.$refs["route-list-group"]).addClass("d-none");
      } else {
        $(this.$refs["route-list-group"]).removeClass("d-none");
      }
    },
    onClickRoute(route) {
      $(this.$refs["route-list-group"]).addClass("d-none");
      this.modelData.route = route.name;
    },
    onSearchMenus(event) {
      if (event.target.value == "") {
        $(this.$refs["menu-list-group"]).addClass("d-none");
      } else {
        $(this.$refs["menu-list-group"]).removeClass("d-none");
      }
    },
    onClickMenu(menu) {
      $(this.$refs["menu-list-group"]).addClass("d-none");
      this.modelData.parent = menu.id;
      this.modelData.parent_name = menu.title;
    },
    save(event) {
      this.validate = true;
      if (this.modelData.title == "") {
        return false;
      }

      $(event.target).loading();

      var _this = this;
      api.setMenu(this.modelData).then(function(res) {
        if (res.body.status) {
          _this.$router.push({ path: "/menu" });
        } else {
          alert(res.body.msg);
          $(event.target).loading("reset");
        }
      });
    }
  }
};
</script>
