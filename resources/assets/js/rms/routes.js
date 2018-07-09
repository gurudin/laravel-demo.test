export default [
  /** route */
  { path: '/route', component: require('./page/route/index.vue') },
  /** menu */
  { path: '/menu', component: require('./page/menu/index.vue') },
  { path: '/menu-create', component: require('./page/menu/save.vue') },
  { path: '/menu-edit/:id', component: require('./page/menu/save.vue') },
  /** permission */
  { path: '/permission', component: require('./page/permission/index.vue') },
  // { path: '/permission-create', component: require('./page/permission/create.vue') },
  // { path: '/permission-view/:name', component: require('./page/permission/view.vue') },
];