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
        <div class="form-group col-md-5">
          {{ alertMessage }}
          <label for="nombreGuide">{{ trans('lang.guide') }}</label>
          <input v-validate="'required'" name="nombreGuide" class="form-control" id="nombreGuide"
                 type="text"
                 v-model="name" :class="{ 'is-invalid': submitted && errors.has('name') }">
          <div class="heightError" v-if="submitted && errors.has('name')">
            <small class="text-danger" v-if="errors.has('name')">{{
                errors.first('name')
              }}</small>
          </div>
        </div>

        <div class="form-group col-md-5">
          {{ alertMessage }}
          <label for="fechaEntrega">{{ trans('lang.fecha_entrega') }}</label>
          <input v-validate="'required'" name="fechaEntrega" class="form-control" id="fechaEntrega"
                 type="date"
                 v-model="fecha_entrega" :class="{ 'is-invalid': submitted && errors.has('fecha_entrega') }">
          <div class="heightError" v-if="submitted && errors.has('fecha_entrega')">
            <small class="text-danger" v-if="errors.has('fecha_entrega')">{{
                errors.first('fecha_entrega')
              }}</small>
          </div>
        </div>

        <div class="form-group col-md-5">
          {{ alertMessage }}
          <label for="delivery">{{ trans('lang.delivery') }}</label>
          <select v-validate="'required'" name="delivery" id="delivery"
                  class="form-control" v-model="delivery_id"
                  :class="{ 'is-invalid': submitted && errors.has('delivery_id') }">
            <option value="" disabled selected>{{ trans('lang.choose_one') }}</option>
            <option v-for="(delivery) in deliveriesData" :value="delivery.id">{{ delivery.nombre }}</option>
          </select>
          <div class="heightError" v-if="submitted && errors.has('delivery_id')">
            <small class="text-danger" v-if="errors.has('delivery_id')">{{ errors.first('delivery_id') }}</small>
          </div>
        </div>

        <div class="form-group col-md-5">
          {{ alertMessage }}
          <label for="ruta">{{ trans('lang.route') }}</label>
          <select v-validate="'required'" name="ruta" id="ruta"
                  class="form-control" v-model="route_id"
                  :class="{ 'is-invalid': submitted && errors.has('route_id') }">
            <option value="" disabled selected>{{ trans('lang.choose_one') }}</option>
            <option v-for="(ruta) in rutasData" :value="ruta.id">{{ ruta.name }}</option>
          </select>
          <div class="heightError" v-if="submitted && errors.has('route_id')">
            <small class="text-danger" v-if="errors.has('route_id')">{{ errors.first('route_id') }}</small>
          </div>
        </div>

        <div class="form-group col-md-10">
          {{ alertMessage }}
          <label for="observacion">{{ trans('lang.observacion') }}</label>
          <input name="observacion" class="form-control" id="observacion"
                 type="text"
                 v-model="observacion" :class="{ 'is-invalid': submitted && errors.has('observacion') }">
          <div class="heightError" v-if="submitted && errors.has('observacion')">
            <small class="text-danger" v-if="errors.has('observacion')">{{
                errors.first('observacion')
              }}</small>
          </div>
        </div>

        

        <div class="form-group col-md-12">
          <label class="mt-2" for="observacion">{{ trans('lang.pedidos_guia') }}</label>
          <div class="row"> 
            <div class="col-md-5">
              {{ alertMessage }}
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="la la-search"></i></span>
                </div>
                <input type="text"
                  class="form-control pr-4 rounded-right"
                  v-model="searchValue"
                  :placeholder="trans('lang.search_invoice_id')"
                  aria-label="Search"
                  aria-describedby="search"
                  @input="searchOrderInput"
                  @keydown.enter="selectOrder(filterPedidos[highlightIndex])"
                  @keydown.down="down"
                  @keydown.up="up">
                  <div v-if="searchValue!=''">
                      <i class="la la-close position-absolute p-1 customer-search-cancel"
                          @click.prevent="searchValue=''"></i>
                  </div>

                  <!-- Customer search result dropdown structure starts-->
                  <div class="dropdown-menu dropdown-menu-right w-100"
                                 :class="{'show':searchValue}">
                                 <pre-loader v-if="!hideOrderSearchPreLoader"
                                            class="small-loader-container"></pre-loader>
                                <div class="px-3 py-1 text-center"
                                     v-else-if="hideOrderSearchPreLoader && filterPedidos.length === 0">
                                    {{ trans('lang.no_result_found') }}
                                </div>
                                <div class="customers-container" v-else-if="filterPedidos.length !== 0">
                                    <span v-for="(pedido,index) in filterPedidos">
                                        <a href="#"
                                           class="dropdown-item"
                                           :class="{ active: parseInt(index) === parseInt(highlightIndex) }"
                                           @click.prevent="selectOrder(pedido)">
                                            <h6 class="m-0">
                                                {{ pedido.invoice_id }}
                                            </h6>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                    </span>
                                </div>
                            </div>
                            <!-- Customer search result dropdown structure ends-->
              </div>

            </div>
          </div>
          <div class="mt-3">
            <table v-if="pedidosGuia.length > 0" class="table">
              <thead>
                <tr>
                  <th scope="col">{{ trans('lang.invoice_id') }}</th>
                  <th scope="col">{{ trans('lang.date') }}</th>
                  <th scope="col">{{ trans('lang.total') }}</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(pedido, index) in pedidosGuia" :key="index">
                  <td>{{ pedido.invoice_id }}</td>
                  <td>{{ pedido.date }}</td>
                  <td>${{ pedido.total }}</td>
                  <td><a href="" class='action-button text-danger' @click.prevent="removePedido(pedido)"><i class="la la-minus-circle"></i></a></td>
                </tr>
                
              </tbody>
            </table>
            <div v-else class="alert alert-warning" role="alert">
              {{ trans('lang.sin_pedidos_guia') }}
            </div>
          </div>
           
        </div>

        <div class="form-group col-md-12">
          <label class="mt-2" for="observacion">{{ trans('lang.pedidos_sin_asignar') }}</label>

          <table v-if="pedidos.length > 0" class="table">
              <thead>
                <tr>
                  <th scope="col">{{ trans('lang.invoice_id') }}</th>
                  <th scope="col">{{ trans('lang.date') }}</th>
                  <th scope="col">{{ trans('lang.total') }}</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(pedido, index) in pedidos" :key="index">
                  <td>{{ pedido.invoice_id }}</td>
                  <td>{{ pedido.date }}</td>
                  <td>${{ pedido.total }}</td>
                  <td><a href="" class='action-button text-success' @click.prevent="addPedido(pedido)"><i class="la la-plus-circle"></i></a></td>
                </tr>
                
              </tbody>
            </table>
            <div v-else class="alert alert-warning" role="alert">
              {{ trans('lang.sin_pedidos_disponibles') }}
            </div> 
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary app-color mobile-btn" @click.prevent="save()">{{
              trans('lang.save')
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
      delivery_id: 0,
      route_id: 0,
      alertMessage: '',
      checkStatus: true,
      saveStatus: false,
      submitted: false,
      deliveriesData: [],
      rutasData: [],
      pedidos: [],
      pedidosGuia: [],
      filterPedidos: [],
      sortedResults: [],
      searchValue: '',
      hideOrderSearchPreLoader: true,
      open: null,
      highlightIndex: 0,
    }
  },
  created() {
    this.getCommonDataPedidos('/pedidosPreparacionSinGuia');
    this.setFechaActual();
    if (this.id) {
      this.getCommonData(this.modalOptions.getDataURL + '/' + this.id);
    }
  },
  mounted() {
    this.axiosGet(
        "/get-deliveries",
        response => {
          this.deliveriesData = response.data.deliveries; 
        },
    );
    this.axiosGet(
        "/get-routes",
        response => {
          this.rutasData = response.data.routes; 
        },
    );
    let instance = this;
    $('#attributes-add-edit-modal').on('hidden.bs.modal', function (e) {
      instance.close();
    });
    this.searchValue = '';
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13 || event.keyCode == 38 || event.keyCode == 40) {
                event.preventDefault();
                return false;
            }
        });
    });
  },

  methods: {
    close() {
      this.name = '';
      this.fecha_entrega = '';
      this.observacion = '';
      this.delivery_id = 0;
      this.route_id = 0;
      this.$validator.reset();
      this.checkStatus = false;
      this.saveStatus = false;
      this.$emit('resetGuideModal', this.checkStatus, this.saveStatus);
    },
    closeModal() {
      $(this.modalOptions.modalID).modal('toggle')
    },
    save() {
      this.submitted = true;
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.inputFields = {
            name: this.name,
            fecha_entrega: this.fecha_entrega,
            observacion: this.observacion,
            delivery_id: this.delivery_id,
            route_id: this.route_id,
            pedidosGuia: this.pedidosGuia,
          };
          console.log(this.delivery_id);
          console.log(this.inputFields);
          if (this.id) {
            this.postDataMethod(this.modalOptions.postDataWithIDURL + '/' + this.id, this.inputFields);
          } else {
            this.postDataMethod(this.modalOptions.postDataWithoutIDURL, this.inputFields);
          }
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
            instance.delivery_id = response.data.guia.delivery_id,
            instance.route_id = response.data.guia.route_id,
            instance.pedidosGuia = response.data.pedidosGuia,
            instance.setPreLoader(true);
          },
          function (response) {
            instance.setPreLoader(true);
          },
      );
    },
    getCommonDataPedidos(route) {
      let instance = this;
      this.setPreLoader(false);
      this.axiosGet(route,
          function (response) {
            instance.pedidos = response.data.pedidos,
            instance.setPreLoader(true);
          },
          function (response) {
            instance.setPreLoader(true);
          },
      );
    },
    addPedido(pedido){

      this.pedidosGuia.push({
        area: pedido.area,
        date: pedido.date,
        first_name: pedido.first_name,
        invoice_id: pedido.invoice_id,
        last_name: pedido.last_name,
        orderID: pedido.orderID,
        status: pedido.status,
        total: pedido.total,
      })
      this.pedidos = this.pedidos.filter(orden => orden.orderID !== pedido.orderID);

    },
    removePedido(pedido){

      this.pedidos.push({
        area: pedido.area,
        date: pedido.date,
        first_name: pedido.first_name,
        invoice_id: pedido.invoice_id,
        last_name: pedido.last_name,
        orderID: pedido.orderID,
        status: pedido.status,
        total: pedido.total,
      })
      this.pedidosGuia = this.pedidosGuia.filter(orden => orden.orderID !== pedido.orderID);

    },
    setFechaActual(){
      var fecha = "";
      let date = new Date()

      let day = date.getDate()
      let month = date.getMonth() + 1
      let year = date.getFullYear()

      if(month < 10){
        fecha = `${year}-0${month}-${day}`;
      }else{
        fecha = `${year}-${month}-${day}`;
      }
      this.fecha_entrega = fecha;
      
    },orderSearch(sortedResults) {
        let instance = this;
        if (instance.searchValue) {
            this.filterPedidos = sortedResults.filter(function (element) {
                let invoice_id = element.invoice_id.toLowerCase().includes(instance.searchValue.toLowerCase());
                return invoice_id;
                
            });
        } else {
            instance.filterPedidos = sortedResults;
        }
    },
    searchOrderInput() {
        let instance = this;
        if (!this.open) {
            this.open = true
        }
        this.highlightIndex = 0;
        let sortedResults;
        sortedResults = this.pedidos;
        instance.orderSearch(sortedResults);
        instance.hideOrderSearchPreLoader = true;
    },
    selectOrder(pedido) {
      this.addPedido(pedido)
      this.searchValue = '';
    },
    up() {
        if (this.open) {
            if (this.highlightIndex > 0) {
                this.highlightIndex--
            }
        } else {
            this.setOpen(true)
        }
    },
    down() {
        if (this.open) {
            if (this.highlightIndex < this.filterPedidos.length - 1) {
                this.highlightIndex++
            }
        } else {
            this.setOpen(true)
        }
    },
    postDataThenFunctionality(response = null) {
      $(this.modalOptions.modalID).modal('toggle');
      let instance = this;
      instance.saveStatus = true;
      this.name = '';
      this.fecha_entrega = '';
      this.observacion = '';
      this.delivery_id = 0;
      this.route_id = 0;
      this.$validator.reset();
      this.checkStatus = false;
      this.$emit('resetGuideModal', this.checkStatus, this.saveStatus);
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
