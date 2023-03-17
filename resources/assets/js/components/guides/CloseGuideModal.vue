<template>
  <div>
    <div class="modal-layout-header">
      <div class="row">
        <div class="col-10">
          <h5 class="bluish-text" v-if="id">{{ trans(modalOptions.editLang) }}</h5>
          <h5 class="bluish-text" v-else>{{ trans(modalOptions.addLang) }}</h5>
        </div>
        <div class="col-2 text-right">
          <button type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                  @click.prevent="closeModal()">
            <i class="la la-close icon-modal-cross"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="modal-layout-content">
      <pre-loader v-if="!hidePreLoader" class="small-loader-container"></pre-loader>
      <form class="form-row margin-top" v-else>
        <div class="form-group col-md-12">
        <h5><strong>{{ trans('lang.guide_information') }}</strong></h5>
          <div class="row">
              <div class="col-5">
                <h6 class=""><strong>{{ trans('lang.guide') }}: </strong>{{ name }}</h6>
              </div>
              <div class="col-5">
                <h6 class=""><strong>{{ trans('lang.fecha_entrega') }}: </strong>{{ fecha_entrega }}</h6>
              </div>
              <div class="col-5">
                <h6 class=""><strong>{{ trans('lang.delivery') }}: </strong>{{ delivery }}</h6>
              </div>
              <div class="col-5">
                <h6 class=""><strong>{{ trans('lang.route') }}: </strong>{{ route }}</h6>
              </div>
              <div class="col-6">
                <h6 class=""><strong>{{ trans('lang.observacion') }}: </strong>{{ observacion }}</h6>
              </div>
              
          </div>
        </div>

        <div class="form-group col-md-12">
          <h5 class="mt-2" ><strong>{{ trans('lang.pedidos_guia') }}</strong></h5>
          
          <div>
            <table v-if="pedidosGuia.length > 0" class="table">
              <thead>
                <tr>
                  <th scope="col">{{ trans('lang.invoice_id') }}</th>
                  <th scope="col">{{ trans('lang.date') }}</th>
                  <th scope="col">{{ trans('lang.customer') }}</th>
                  <th scope="col">{{ trans('lang.shipping_area') }}</th>
                  <th scope="col">{{ trans('lang.total') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(pedido, index) in pedidosGuia" :key="index">
                  <td>{{ pedido.invoice_id }}</td>
                  <td>{{ pedido.date }}</td>
                  <td>{{ pedido.customer }}</td>
                  <td>{{ pedido.area }}</td>
                  <td>${{ pedido.total }}</td>
                </tr>
                
              </tbody>
            </table>
            <div v-else class="alert alert-warning" role="alert">
              {{ trans('lang.sin_pedidos_guia') }}
            </div>
          </div>
           
        </div>
        
        <div class="col-12">
          <p style="color: red">{{ trans('lang.pregunta_cerrar_guia') }}</p>
          <button type="submit" class="btn btn-primary app-color mobile-btn" @click.prevent="closeGuide()">{{
              trans('lang.cerrar_guia')
            }}
          </button>
          <button class="btn btn-secondary cancel-btn mobile-btn" data-dismiss="modal"
                  @click.prevent="close()">{{ trans('lang.cancel') }}
          </button>
        </div>
      </form>
    </div>

  </div>
</template>

<script>

import axiosGetPost from '../../helper/axiosGetPostCommon';

export default {

  props: ['id', 'modalOptions'],
  extends: axiosGetPost,
  data() {
    return {
      name: '',
      fecha_entrega: '',
      observacion: '',
      delivery: '',
      route: '',
      alertMessage: '',
      checkStatus: false,
      saveStatus: false,
      submitted: false,
      pedidosGuia: [],
      open: null,
    }
  },
  created() {
    //this.getCommonDataPedidos('/pedidosPreparacionSinGuia');
    //this.setFechaActual();
    if (this.id) {
      this.getCommonData(this.modalOptions.getDataURL + '/' + this.id);
      console.log(this.route);
    }
  },
  mounted() {
    let instance = this;
    $('#attributes-add-edit-modal').on('hidden.bs.modal', function (e) {
      instance.close();
    });
  },

  methods: {
    close() {
      this.name = '';
      this.fecha_entrega = '';
      this.observacion = '';
      this.delivery = '';
      this.route = '';
      this.$validator.reset();
      this.checkStatus = false;
      this.saveStatus = false;
      this.$emit('resetCloseguideModal', this.checkStatus, this.saveStatus);
    },
    closeModal() {
      $(this.modalOptions.modalID).modal('toggle')
    },
    closeGuide() {
      this.submitted = true;
      this.inputFields = {
        name: this.name,
        fecha_entrega: this.fecha_entrega,
        observacion: this.observacion,
        delivery: this.delivery,
        route: this.route,
        pedidosGuia: this.pedidosGuia,
      };
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.postDataMethod(this.modalOptions.postDataWithIDURL + '/' + this.id, this.inputFields); 
        }
      });
    },
    getCommonData(route) {
      let instance = this;
      this.setPreLoader(false);
      this.axiosGet(route,
          function (response) {
            instance.name = response.data.guia.name;
            instance.fecha_entrega = response.data.guia.fecha_entrega,
            instance.observacion = response.data.guia.observacion,
            instance.delivery = response.data.guia.delivery,
            instance.route = response.data.guia.route,
            instance.pedidosGuia = response.data.pedidosGuia,
            instance.setPreLoader(true);
          }
      );
    },
    postDataThenFunctionality(response = null) {
      $(this.modalOptions.modalID).modal('toggle');
      let instance = this;
      instance.saveStatus = false;
      this.name = '';
      this.fecha_entrega = '';
      this.observacion = '';
      this.delivery = '';
      this.route = '';
      this.$validator.reset();
      this.checkStatus = false;
      this.$emit('resetCloseguideModal', this.checkStatus, this.saveStatus);
      if (!this.modalOptions.turnOffLoader) {
        this.$hub.$emit('reloadDataTable');
      } else {
        this.$hub.$emit('reloadAttributeData');
      }
    },
    postDataCatchFunctionality(error) {
    },
  },
}
</script>
