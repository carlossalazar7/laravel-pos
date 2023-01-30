<template>
  <div class="main-layout-wrapper">
    <div class="main-layout-card-header-with-button">
      <div class="main-layout-card-content-wrapper">
        <div class="main-layout-card-header-contents">
          <h5 class="m-0">Departamentos</h5>
        </div>
        <div v-if="permission !== 'read_only'"
             class="main-layout-card-header-contents text-right d-flex justify-content-end">
          <div class="p-1">
            <button class="btn btn-primary app-color" data-toggle="modal" data-target="#departamento-add-edit-modal"
                    @click.prevent="addEditAction('')">
              {{ trans('lang.add') }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <datatable-component class="main-layout-card-content" :options="tableOptions" :exportData="exportToVue"
                         exportFileName="departments" @resetStatus="resetExportValue"></datatable-component>

    <!-- Modal -->
    <div class="modal fade" id="departamento-add-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <add-edit-depto-modal class="modal-content" v-if="isActive" :id="selectedItemId"
                              :modalOptions="modalOptions"></add-edit-depto-modal>
      </div>
    </div>

    <!-- Delete Modal -->
    <confirmation-modal id="confirm-delete" :message="'brand_deleted_permanently'" :firstButtonName="'yes'"
                        :secondButtonName="'no'"
                        @confirmationModalButtonAction="confirmationModalButtonAction"></confirmation-modal>
  </div>
</template>

<script>
import axiosGetPost from '../../helper/axiosGetPostCommon';

var sourceURL = '/departamento';

export default {
  props: ['permission'],
  extends: axiosGetPost,
  data() {
    return {
      tableOptions: {
        tableName: 'departamentos',
        columns: [
          {title: 'lang.id', key: 'id', type: 'text', sortable: true},
          {title: 'lang.name', key: 'name', type: 'text', sortable: true},
          (this.permission !== 'read_only' ? {
            title: 'lang.action',
            type: 'component',
            key: 'action',
            componentName: 'departamento-action-component'
          } : {})

        ],
        source: '/departamentos',
        search: false,
        right_align: 'action',
      },

      modalOptions: {
        modalID: '#departamento-add-edit-modal',
        addLang: 'lang.add_brand',
        editLang: 'lang.edit_brand',
        getDataURL: sourceURL,
        postDataWithIDURL: sourceURL,
        postDataWithoutIDURL: sourceURL + '/store',
      },
      buttonLoader: false,
      isDisabled: false,
      exportToVue: false,
    }
  },

  mounted() {
    let instance = this;
    this.$hub.$on('departamentoAddEdit', function (id, name) {
      instance.addEditAction(id, name);
    });
    this.modalCloseAction(this.modalOptions.modalID);
  },

  methods: {
    confirmationModalButtonAction() {
      this.deleteDataMethod(sourceURL + '/delete/' + this.deleteID, this.deleteIndex);
    },
    resetDepartamentoModal(value, save) {
      $("#departamento-add-edit-modal").on("hidden.bs.modal", function (e) {
        this.isActiveAttributeModal = false;
        $("body").addClass("modal-open");
      });
      this.checkStatus = value;
      if (save) this.bus.$emit("saveStatus");
    }
  }
}

</script>