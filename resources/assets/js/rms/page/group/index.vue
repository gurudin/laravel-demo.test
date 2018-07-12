<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{ $t("group.group") }}</div>

      <div class="col-4 text-right">
        <button class="btn col-4 btn-success" @click="showModal('create')">
          {{ $t("common.create") }}
        </button>
      </div>
    </div>
  </div>

  <div class="col-12">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th class="w-10">#</th>
          <th class="w-25">{{ $t("group.name") }}</th>
          <th class="w-40">{{ $t("group.description") }}</th>
          <th class="w-25">{{ $t("common.action") }}</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item,inx) in groupItem">
          <td>{{item.id}}</td>
          <td>{{item.name}}</td>
          <td>{{item.description}}</td>
          <td>
            <router-link :to="{path: '/group-view/' + item.id +'/'+ encodeURIComponent(item.name)}" class="btn btn-info btn-sm">
              <i class="fas fa-eye"></i>
            </router-link>
            <button type="button" class="btn btn-warning text-white btn-sm" @click="showModal('update', item)">
              <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm" @click="deleteGroup($event, inx, item)"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Save role modal -->
  <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$t('group.group')}}{{modalTitle=='update' ? ': ' + groupModel.old.name : ''}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">{{$t('group.name')}}:</label>
              <input
                type="text"
                class="form-control"
                :class="{'is-invalid':validate && !groupModel.new.name}"
                v-model.trim="groupModel.new.name"
                :placeholder="$t('group.name')">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">{{$t('group.description')}}:</label>
              <input
                type="text"
                class="form-control"
                :class="{'is-invalid':validate && !groupModel.new.description}"
                v-model.trim="groupModel.new.description"
                :placeholder="$t('group.description')">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{$t('common.cancel')}}</button>
          <button type="button" class="btn btn-success" @click="save">{{$t('common.save')}}</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /Save role modal -->

</div>
</template>

<script>
import api from "../../api";
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      groupModel: {old: {}, new: {}},
      modalTitle: '',
      validate: false,
    };
  },
  computed: mapState({
    groupItem: state => state.authGroup.groupItem,
  }),
  created() {
    this.getGroup();
  },
  methods: {
    ...mapActions(["getGroup"]),
    showModal(method, item) {
      this.modalTitle = method;
      if (method == 'create') {
        this.groupModel.old = {};
        this.groupModel.new = {};
      } else {
        this.groupModel.old = item;
        this.groupModel.new = $.extend({}, item);
      }
      $('#saveModal').modal('show');
    },
    deleteGroup(event, inx, item) {
      if (!confirm(this.$t("common.are-you-sure-to-delete-this-item"))) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.removeAuthGroup(item.id).then(function(res) {
        if (res.body.status) {
          _this.groupItem.splice(inx, 1);
        } else {
          alert(res.body.msg);
        }
        $btn.loading("reset");
      });
    },
    save($event) {
      this.validate = true;
      if (!this.groupModel.new.name
        || !this.groupModel.new.description
      ) {
          return false;
      }

      var $btn = $(event.currentTarget);
      var _this = this;
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      if (JSON.stringify(this.groupModel.old) == "{}") {
        // Create
        api.setAuthGroup(this.groupModel.new).then(function(res) {
          if (res.body.status) {
            _this.$router.go(0);
          } else {
            alert(res.body.msg);
          }
          $btn.loading("reset");
        });
      } else {
        // Update
        api.updateAuthGroup(this.groupModel.new).then(function(res) {
          if (res.body.status) {
            _this.$router.go(0);
          } else {
            alert(res.body.msg);
          }
          $btn.loading("reset");
        });
      }
    }
  }
};
</script>

