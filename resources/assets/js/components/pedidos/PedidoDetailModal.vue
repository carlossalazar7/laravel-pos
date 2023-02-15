<template>
    <div>
      <div class="modal-layout-header">
        <div class="row">
          <div class="col-10">
            <h5 class="bluish-text" v-if="id">{{ trans(modalOptions.titleLang) }}</h5>
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
            <h5><strong>{{ trans('lang.order_info') }}</strong></h5>
            <div class="row">
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.invoice_id') }}: </strong>{{ orden.invoice_id }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.date') }}: </strong>{{ orden.created_at }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.customer') }}: </strong>{{ cliente.first_name }} {{ cliente.last_name }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.phone_number') }}: </strong>{{ cliente.phone_number }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.emails') }}: </strong>{{ cliente.email }}</h6>
                </div>
                <div class="col-6">
                  <h6 class=""><strong>{{ trans('lang.customer_address') }}: </strong>{{ cliente.address }}</h6>
                </div>
                
            </div>

            <h5 class="mt-4"><strong>{{ trans('lang.shipping') }}</strong></h5>
            <div class="row">
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.shipping_area') }}: </strong>{{ envio.area }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.price') }}: </strong>${{ envio.price }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.departamento') }}: </strong>{{ envio.departamento }}</h6>
                </div>
                <div class="col-5">
                  <h6 class=""><strong>{{ trans('lang.municipio') }}: </strong>{{ envio.municipio }}</h6>
                </div>
                <div class="col-12">
                  <h6 class=""><strong>{{ trans('lang.shipping_address') }}: </strong>{{ envio.shipping_address }}</h6>
                </div>
                
                
            </div>

            <h5 class="mt-4"><strong>{{ trans('lang.products') }}</strong></h5>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">{{ trans('lang.title') }}</th>
                  <th scope="col">{{ trans('lang.quantity') }}</th>
                  <th scope="col">{{ trans('lang.price') }}</th>
                  <th scope="col">{{ trans('lang.subtotal') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(producto, index) in detalle_orden" :key="index">
                  <td>{{ producto.title }}</td>
                  <td>{{ producto.quantity }}</td>
                  <td>${{ producto.price }}</td>
                  <td>${{ producto.sub_total }}</td>
                </tr>
                <tr>
                  <td colspan="3"><strong>{{ trans('lang.total') }}</strong></td>
                  <td>${{ orden.total }}</td>
                </tr>
                
              </tbody>
            </table>
            
          </div>
          <div class="col-12">
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
        orden: '',
        cliente: '',
        envio: '',
        detalle_orden: '',
        alertMessage: '',
        checkStatus: true,
        saveStatus: false,
        submitted: false,
      }
    },
    created() {
      if (this.id) {
        this.getCommonData(this.modalOptions.getDataURL + '/' + this.id);
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
        this.$validator.reset();
        this.checkStatus = false;
        this.saveStatus = false;
        this.$emit('resetPedidoDetailModal', this.checkStatus, this.saveStatus);
      },
      closeModal() {
        $(this.modalOptions.modalID).modal('toggle')
      },
      getCommonData(route) {
        
        let instance = this;
        this.setPreLoader(false);
        this.axiosGet(route,
            function (response) {
              //data
              instance.orden = response.data.orden;
              instance.cliente = response.data.cliente;
              instance.envio = response.data.envio;
              instance.detalle_orden = response.data.detalle_orden;
              instance.setPreLoader(true);
            },
            function (response) {
              instance.setPreLoader(true);
            },
        );
      }
    },
  }
  </script>
  