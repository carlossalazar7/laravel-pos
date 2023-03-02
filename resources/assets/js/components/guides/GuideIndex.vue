<template>
  <div>
    <div class="main-layout-card-header-with-button">
      <div class="main-layout-card-content-wrapper">
        <div class="main-layout-card-header-contents">
          <h5 class="m-0">{{ trans('lang.guides') }}</h5>
        </div>
        <div v-if="permission !== 'read_only'"
             class="main-layout-card-header-contents text-right d-flex justify-content-end">
          <div class="p-1">
            <button class="btn btn-primary app-color" data-toggle="modal" data-target="#guide-add-edit-modal"
                    @click.prevent="addEditAction('')">
              {{ trans('lang.add') }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <datatable-component class="main-layout-card-content" :options="tableOptions" :exportData="exportToVue"
                         exportFileName="guides" @resetStatus="resetExportValue"></datatable-component>

    <!-- Modal -->
    <div class="modal fade" id="guide-add-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <add-edit-guide-modal class="modal-content" v-if="isActive" :id="selectedItemId"
                                       :modalOptions="modalOptions"></add-edit-guide-modal>
      </div>
    </div>

    <!-- Delete Modal -->
    <confirmation-modal id="confirm-delete" :message="'guide_deleted_permanently'" :firstButtonName="'yes'"
                        :secondButtonName="'no'"
                        @confirmationModalButtonAction="confirmationModalButtonAction"></confirmation-modal>
  </div>
</template>

<script>
import axiosGetPost from '../../helper/axiosGetPostCommon';

var sourceURL = '/guide';

export default {
  extends: axiosGetPost,
  props: ['permission'],
  data() {
    return {
      tableOptions: {
        tableName: 'guides',
        columns: [
          {title: 'lang.id', key: 'id', type: 'text', sortable: true},
          {title: 'lang.guide', key: 'name', type: 'text', sortable: true},
          {title: 'lang.fecha_entrega', key: 'fecha_entrega', type: 'text', sortable: true},
          {title: 'lang.delivery', key: 'nombreDelivery', type: 'text', sortable: true},          
          {title: 'lang.route', key: 'nombreRuta', type: 'text', sortable: true},
          {title: 'lang.observacion', key: 'observacion', type: 'text', sortable: true},
          {title: 'lang.status', key: 'status', type: 'text', sortable: true},
          (this.permission !== 'read_only' ? {
            title: 'lang.action',
            type: 'component',
            key: 'action',
            componentName: 'guide-action-component'
          } : {})
        ],
        source: '/guides',
        search: false,
        right_align: 'action',
      },

      modalOptions: {
        modalID: '#guide-add-edit-modal',
        addLang: 'lang.add_guide',
        editLang: 'lang.edit_guide',
        getDataURL: sourceURL,
        postDataWithIDURL: sourceURL,
        postDataWithoutIDURL: sourceURL + '/store',
      },
      buttonLoader: false,
      isDisabled: false,
      exportToVue: false,
    }
  },
  methods: {
    confirmationModalButtonAction() {
      this.deleteDataMethod(sourceURL + '/delete/' + this.deleteID, this.deleteIndex);
    },
    resetguideModal(value, save) {
      $("#guide-add-edit-modal").on("hidden.bs.modal", function (e) {
        this.isActiveAttributeModal = false;
        $("body").addClass("modal-open");
      });
      this.checkStatus = value;
      if (save) this.bus.$emit("saveStatus");
    },
    resetExportValue(value) {
      this.exportToVue = value;
      this.buttonLoader = false;
      this.isDisabled = false;

    }
  },
  mounted() {
    let instance = this;
    this.$hub.$on('guideAddEdit', function (id, name) {
      instance.addEditAction(id, name);
    });

    this.$hub.$on('generarPDF', function (id) {
      let instance = this;
      console.log(id);


      axios({
          url: '/generate-pdf-guide/'+ id,
          method: 'GET',
          responseType: 'blob', // important
      }).then((response) => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'file.pdf');
          document.body.appendChild(link);
          link.click();
      });

    });

    this.modalCloseAction(this.modalOptions.modalID);
  }
}
</script>
