<template>
  <div>
    <b-card >
        <b-alert variant="primary" show>
        <div class="alert-body">
          <span> Ficha Personal</span>
        </div>
      </b-alert>    
      <div class="m-2">
        <b-row>
          <b-col cols="12" class="d-flex justify-content-between flex-wrap">
            <div>
              <b-button
                size="sm"
                class="mr-1"
                variant="success"
                @click="exportExcel"
              >
                <b-icon icon="file-earmark-excel" aria-hidden="true"></b-icon>
                Excel
              </b-button>
              <b-button
                size="sm"
                variant="danger"
                class="mr-1"
                @click="exportPdf"
              >
                <b-icon icon="file-pdf" aria-hidden="true"></b-icon> PDF
              </b-button>

              <label>Mostrar</label>
              <v-select
                v-model="perPage"
                :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                :options="perPageOptions"
                :clearable="false"
                class="per-page-selector d-inline-block mb-2"
              />
            </div>

            <div>
              <div class="justify-content-end">
                <b-form-input
                  v-model="searchTerm"
                  placeholder="Buscar"
                  type="text"
                  class="d-inline-block"
                />
              </div>
            </div>
          </b-col>
        </b-row>
      </div>

      <b-table
        ref="refVsemploxTable"
        :items="items"
        responsive
        :fields="Columns"
        primary-key="id"
        :sort-by.sync="sortBy"
        show-empty
        empty-text="No matching records found"
        :sort-desc.sync="isSortDirDesc"
        class="position-relative"
      >
        <template #cell(IDTYPE)="data">
          <template v-if="data.value === '05'">
            <b-badge pill variant="light-success"> Cèdula </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="danger"> otro </b-badge>
          </template>
        </template>

        <template #cell(ESTATU)="data">
          <template v-if="data.value == 1">
            <b-badge pill variant="light-success"> Activo </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="danger"> Inactivo </b-badge>
          </template>
        </template>

        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.EMP_NO}-preview-icon`"
              icon="EyeIcon"
              size="16"
              class="mx-1"
              @click="viewFicha(data.item.EMP_NO)"
            />
            <b-tooltip
              title="Consultar"
              :target="`invoice-row-${data.item.EMP_NO}-preview-icon`"
            />
            <feather-icon
              :id="`invoice-row-${data.item.EMP_NO}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
              @click="detailFicha(data.item.EMP_NO)"
            />
            <b-tooltip
              title="Editar"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.EMP_NO}-send-icon`"
            />
          </div>
        </template>
      </b-table>
      <div class="mx-2 mb-2">
        <b-row>
          <b-col
            cols="12"
            sm="6"
            class="
              d-flex
              align-items-center
              justify-content-center justify-content-sm-start
            "
          >
            <span class="text-muted"
              >Mostrando {{ dataMeta.from }} a {{ dataMeta.to }} de
              {{ dataMeta.of }} registros</span
            >
          </b-col>
          <b-col
            cols="12"
            sm="6"
            class="
              d-flex
              align-items-center
              justify-content-center justify-content-sm-end
            "
          >
            <b-pagination
              v-model="currentPage"
              :total-rows="total_pages"
              :per-page="perPage"
              v-on:input="Vsemplox"
              first-number
              last-number
              class="mb-0 mt-1 mt-sm-0"
              prev-class="prev-item"
              next-class="next-item"
            >
              <template #prev-text>
                <feather-icon icon="ChevronLeftIcon" size="18" />
              </template>
              <template #next-text>
                <feather-icon icon="ChevronRightIcon" size="18" />
              </template>
            </b-pagination>
          </b-col>
        </b-row>
      </div>
    </b-card>
    <detail-ficha />
  </div>
</template>

<script>

import vSelect from "vue-select";
import { onUnmounted, reactive, onMounted, toRefs,computed,ref } from "@vue/composition-api";
import store from "@/store";
import useInvoicesList from "./useInvoiceList";
import invoiceStoreModule from "./invoiceStoreModule";
import EventBus from "@/assets/js/EventBus";
import DetailFicha from "./components/DetailFicha.vue";
import { inject } from 'vue'
const axios = require("axios").default;

export default {
  components: {
    vSelect,
    DetailFicha,
  },
  setup() {
    const MODULE_EMPLOX = "vsemplox";
    const refVsemploxTable = ref(null)
    const searchTerm = "";
    // const swal = inject('$swal')
    const state = reactive({
      items: [],
      model: {},
      data: {},
      perPage: ref(1),
      currentPage: ref(1),
      total_pages: ref(0),
    });

    // Register module
    if (!store.hasModule(MODULE_EMPLOX))
      store.registerModule(MODULE_EMPLOX, invoiceStoreModule);

    onUnmounted(() => {
      if (store.hasModule(MODULE_EMPLOX))
        store.unregisterModule(MODULE_EMPLOX);
    });
    onMounted(() => {
       EventBus.$on("ListarFicha", (id) => {
         Vsemplox();
      });
      Vsemplox();
    });

    const statusOptions = ["Opcion 1", "Opcion 2", "Opcion 3"];
    const verifiqueSesion = () => {
      let url = "/session";
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
        console.log(response);
        let {status}=response.data;
        if (status==400) {
           alert("seson terminada");
           
        }
        //state.items = response.data.result;
      });
    };
    const Vsemplox = () => {
      let a = "";
      let sea = "";
      let search = a == "" ? "all" : sea;
      let url = "/vsemblox/records/" + search + "?page=" + state.currentPage;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
        
        const { result, total } = response.data;     
        state.total_pages = result.pagination.total_pages;
        state.items = result.data;
      });
    };
    const detailFicha = (EMP_NO) => {     
      EventBus.$emit("DetailFicha", EMP_NO);
    };
    const viewFicha = (id) => {};

    const success=()=> {
    /// swal('Something went wrong.')
    }
    const exportExcel = () => {
      let url = "/vsemblox/excel";
      window.open(url, "_blank");
    };
    const exportPdf = () => {
      let url = "/vsemblox/pdf";
      window.open(url, "_blank");
    };
    const dataMeta = computed(() => {
      const localItemsCount = refVsemploxTable.value ? refVsemploxTable.value.localItems.length : 0
      return {
        from: state.perPage * (state.currentPage - 1) + (localItemsCount ? 1 : 0),
        to: state.perPage * (state.currentPage - 1) + localItemsCount,
        of: state.total_pages,
      }
    })   
    const {   
      perPageOptions,
      isSortDirDesc,  
      statusFilter,
      searchQuery,
      Columns,
      sortBy,  
    } = useInvoicesList();

    return {   
      refVsemploxTable,
      ...toRefs(state),
      perPageOptions,
      isSortDirDesc,
      statusOptions,  
      statusFilter,
      searchQuery,
      exportExcel,
      detailFicha,
      searchTerm,
      exportPdf,
      viewFicha,
      Vsemplox,
      dataMeta,
      Columns,
      success,
      sortBy,
    };
  }, 
  methods: {
    rout() {
      $router.push({
        name: "apps-invoice-preview",
        params: { id: data.item.id },
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.per-page-selector {
  width: 90px;
}

.invoice-filter-select {
  min-width: 190px;

  ::v-deep .vs__selected-options {
    flex-wrap: nowrap;
  }

  ::v-deep .vs__selected {
    width: 100px;
  }
}
</style>

<style lang="scss">
@import "~@resources/scss/vue/libs/vue-select.scss";
@import '~@resources/scss/vue/libs/vue-sweetalert.scss';

</style>
