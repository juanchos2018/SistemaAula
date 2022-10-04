<template>
  <div>
    <b-card>
      <b-alert variant="primary" show>
        <div class="alert-body">
          <span>Boletín por Sección.</span>
        </div>
      </b-alert>     

      <b-table
        ref="refInvoiceListTable"
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
       <template #cell(JOR_NO)="data">
                <template v-if="data.value == 1">
                    <b-badge pill variant="light-success"> Matutina </b-badge>
                </template>
                <template v-else>
                    <b-badge pill variant="danger">Noche </b-badge>
                </template>
             </template>
        <template #cell(actions)="data">
            
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.SEC_NO}-preview-icon`"
              icon="FileMinusIcon"
              size="16"
              class="cursor-pointer"
              @click="modalBoletin()"
            />
            <b-tooltip
              title="Boletin"
              :target="`invoice-row-${data.item.SEC_NO}-preview-icon`"
            />

            <!-- <input v-on:keyup.enter="onEnter(data.item.STD_NO)" /> -->
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
              v-on:input="Listvsabsec"
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
    <modal-boletin/>
  </div>
</template>

<script>
import { avatarText } from "@core/utils/filter";

import vSelect from "vue-select";

import {
  onUnmounted,
  reactive,
  onMounted,
  toRefs,
  ref,
} from "@vue/composition-api";

import store from "@/store";
import useModule from "./UseModule";

import Modules from "./Modules";
import EventBus from "@/assets/js/EventBus";

import { kFormatter } from "@core/utils/filter";
import ModalBoletin from "./components/ModalBoletin.vue";

const axios = require("axios").default;

export default {
  components: {
    vSelect,
    ModalBoletin
  },
  setup() {
    const INVOICE_APP_STORE_MODULE_NAME = "vslibsec";
    const state = reactive({
      items: [],
      model: {},
      data: {},
      perPage: ref(1),
      currentPage: ref(1),
      total_pages: ref(0),
    });
    let selected=ref(null)
    const  option= [
        { title: "Opcion 1" },
        { title: "Opcion 2" },
        { title: "Opcion 3" },
        { title: "Opcion 4" },
     ]

    if (!store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
      store.registerModule(INVOICE_APP_STORE_MODULE_NAME, Modules);

    onUnmounted(() => {
      if (store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
        store.unregisterModule(INVOICE_APP_STORE_MODULE_NAME);
    });
    onMounted(() => {
      Listvsabsec();
    });

    const statusOptions = ["Opcion 1", "Opcion 2", "Opcion 3"];
    const Listvsabsec = () => {
      let a = "";
      let sea = "";
      let search = a == "" ? "all" : sea;
      let url = "/vslibsec/records/" + search + "?page=" + state.currentPage;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
           console.log(response);
        const { result, total } = response.data;
        // state.rows = result.total;
        state.total_pages = result.pagination.total_pages;
        state.items = result.data;
      });
    };
   
    const viewFicha = (id) => {};
    const modalBoletin = () => {
      EventBus.$emit("ModalBoletin", null);
    };
    
    const acta = () => {
      console.log("click");  
      router.push({ name: "apps-acta" });
    };
    const searchTerm = "";
    const {
      dataMeta,

      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refInvoiceListTable,
      statusFilter,
      Columns,
    } = useModule();

    return {
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refInvoiceListTable,

      statusFilter,

      statusOptions,
      avatarText,
      Columns,

      ...toRefs(state),
    

      viewFicha,
      searchTerm,
      Listvsabsec,
      modalBoletin,
       selected,
      option
    };
  },

  methods: {
    kFormatter,
    onEnter: function (id) {
      console.log("enterwe", id);
    },
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
a {
  text-decoration: none;
}
</style>

<style lang="scss">
@import "~@resources/scss/vue/libs/vue-select.scss";
</style>
