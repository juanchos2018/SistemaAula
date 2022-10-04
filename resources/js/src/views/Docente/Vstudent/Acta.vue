<template>
  <section class="invoice-preview-wrapper">
    <!-- Alert: No item found -->
    <b-alert variant="danger" :show="invoiceData === undefined">
      <h4 class="alert-heading">Error fetching invoice data</h4>
      <div class="alert-body">
        No se Encontraron Registros
        <b-link class="alert-link" :to="{ name: 'apps-invoice-list' }">
          Invoice List
        </b-link>
        for other invoices.
      </div>
    </b-alert>

    <b-row v-if="invoiceData" class="invoice-preview">
 
      <b-col cols="12" xl="9" md="8">
        <b-card no-body class="invoice-preview-card">

          <b-card-body class="invoice-padding pb-0">
           
            <div class="d-flex justify-content-between">
      
              <div>
                <div class="logo-wrapper">
                  <!-- <logo /> -->
                  <img src="/logo/UEHIPATIA.jpg" alt="" />
                </div>

           
              </div>
              <div>
                <h4 class="invoice-title">
                  <span class="invoice-number"
                    >UNIDAD EDUCATIVA "HIPATIA CARDENAS DE BUSTAMANTE"</span
                  >
                </h4>
              </div>
         
              <div class="mt-md-0 mt-2">
              
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">No. Matricula:</p>
                  <p class="invoice-date">00683</p>
                </div>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">No Folio:</p>
                  <p class="invoice-date">00683</p>
                </div>
              </div>
            </div>
          </b-card-body>


          <hr class="invoice-spacing" />

          <b-card-body v-if="invoiceData.client" class="invoice-padding pt-0">
            <b-row>
              <b-col cols="12" xl="6" class="p-0">
                <h6 class="mb-2">Datos del Estudiante:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pr-1">Nombres y Apellidos:</td>
                      <td>
                        <span class="font-weight-bold"
                          >AGUIRRE OVALLE ADRIAN RICARDO</span
                        >
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-1">Grado Curso:</td>
                      <td>PRIMER CURSO DE BACHILLERATO BGU - B</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Fecha Nacimiento:</td>
                      <td>{{ paymentDetails.country }}</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Cedula Ciudadana:</td>
                      <td>1725494056</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Direcccion:</td>
                      <td>Direccion del estudianet</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Teléfono:</td>
                      <td>9707808265</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Edad Cronológica:</td>
                      <td>15</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Correo Electrónico:</td>
                      <td>correo@gmail.com</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Fecha Matricula:</td>
                      <td>15/15/2022</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Institución:</td>
                      <td>coleegioil del coeligo</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Observacion:</td>
                      <td>observaicsxcs</td>
                    </tr>
                  </tbody>
                </table>
              </b-col>
            </b-row>
          </b-card-body>

 
          <hr />

          <b-card-body v-if="invoiceData.client" class="invoice-padding pt-0">
            <b-row>
              <b-col cols="12" xl="6" class="p-0">
                <h6 class="mb-2">Datos del Representante:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pr-1">Nombres y Apellidos:</td>
                      <td>
                        <span class="font-weight-bold">Nombre y apellidos</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-1">Cedula Ciudadana:</td>
                      <td>1725494056</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Direcccion:</td>
                      <td>Direccion del estudianet</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Profesion</td>
                      <td>profesion</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Teléfono:</td>
                      <td>9707808265</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Correo :</td>
                      <td>correo@gmail.com</td>
                    </tr>
                  </tbody>
                </table>
              </b-col>
            </b-row>
          </b-card-body>
          <hr />

          <b-card-body v-if="invoiceData.client" class="invoice-padding pt-0">
            <b-row>
              <b-col cols="12" xl="6" class="p-0">
                <h6 class="mb-2">Datos del Padre:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pr-1">Nombres y Apellidos:</td>
                      <td>
                        <span class="font-weight-bold">Nombre y apellidos</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-1">Cedula Ciudadana:</td>
                      <td>1725494056</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Direcccion:</td>
                      <td>Direccion del estudianet</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Profesion</td>
                      <td>profesion</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Teléfono:</td>
                      <td>9707808265</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Correo :</td>
                      <td>correo@gmail.com</td>
                    </tr>
                  </tbody>
                </table>
              </b-col>
            </b-row>
          </b-card-body>

          <hr class="invoice-spacing" />

          <b-card-body v-if="invoiceData.client" class="invoice-padding pt-0">
            <b-row>
              <b-col cols="12" xl="6" class="p-0">
                <h6 class="mb-2">Datos del Madre:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pr-1">Nombres y Apellidos:</td>
                      <td>
                        <span class="font-weight-bold">Nombre y apellidos</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="pr-1">Cedula Ciudadana:</td>
                      <td>1725494056</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Direcccion:</td>
                      <td>Direccion del estudianet</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Profesion</td>
                      <td>profesion</td>
                    </tr>
                    <tr>
                      <td class="pr-1">Teléfono:</td>
                      <td>9707808265</td>
                    </tr>

                    <tr>
                      <td class="pr-1">Correo :</td>
                      <td>correo@gmail.com</td>
                    </tr>
                  </tbody>
                </table>
              </b-col>
            </b-row>
          </b-card-body>
     

          <div class="row mt-4 pt-4">
            <div class="col-6 text-center">
              <address>
                <hr
                  style="border: 0.4px solid #dedede; width: 50%"
                  class="mb-1"
                />
                <p class="mb-0" style="font-size: 14px">
                  <strong>Nombre REcror</strong>
                </p>
                Rector/a
              </address>
            </div>

            <div class="col-6 text-center">
              <address>
                <hr
                  style="border: 0.4px solid #dedede; width: 50%"
                  class="mb-1"
                />
                <p class="mb-0" style="font-size: 14px">
                  <strong>nombre empresa</strong>
                </p>
                Secretario/a
              </address>
            </div>
            <br /><br /><br />

            <div class="col-12 text-center">
              <address>
                <hr
                  style="border: 0.4px solid #dedede; width: 30%"
                  class="mb-1"
                />
                <p class="mb-0" style="font-size: 14px">
                  <strong>Alumno</strong>
                </p>
                Representante
              </address>
            </div>
          </div>     
         
        </b-card>
      </b-col>

      <b-col cols="12" md="4" xl="3" class="invoice-actions">
        <b-card>
          <b-button
            v-ripple.400="'rgba(186, 191, 199, 0.15)'"
            variant="outline-secondary"
            class="mb-75"
            block
            @click="printInvoice"
          >
            Inprimir
          </b-button>
        </b-card>
      </b-col>
    </b-row>
  </section>
</template>

<script>
import { ref, onUnmounted } from "@vue/composition-api";
import store from "@/store";
import router from "@/router";
import { VBToggle } from "bootstrap-vue";
import Logo from "@core/layouts/components/Logo.vue";
import Ripple from "vue-ripple-directive";
import invoiceStoreModule from "./aaaa";

export default {
  directives: {
    Ripple,
    "b-toggle": VBToggle,
  },
  components: {
    Logo,
  },
  setup() {
    const invoiceData = ref(null);
    const paymentDetails = ref({});

   


    const INVOICE_APP_STORE_MODULE_NAME = "app-invoice";

    // Register module
    if (!store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
      store.registerModule(INVOICE_APP_STORE_MODULE_NAME, invoiceStoreModule);

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
        store.unregisterModule(INVOICE_APP_STORE_MODULE_NAME);
    });

    store
      .dispatch("app-invoice/fetchInvoice", {
        id: router.currentRoute.params.id,
      })
      .then((response) => {
        invoiceData.value = response.data.invoice;
        paymentDetails.value = response.data.paymentDetails;
      })
      .catch((error) => {
        if (error.response.status === 404) {
          invoiceData.value = undefined;
        }
      });

    const printInvoice = () => {
      window.print();
    };

    return {
      invoiceData,
      paymentDetails,

      printInvoice,
    };
  },
};
</script>

<style lang="scss" scoped>
@import "~@resources/scss/base/pages/app-invoice.scss";
</style>

<style lang="scss">
@media print {
  // Global Styles
  body {
    background-color: transparent !important;
  }
  nav.header-navbar {
    display: none;
  }
  .main-menu {
    display: none;
  }
  .horizontal-menu-wrapper {
    display: none;
  }
  .header-navbar-shadow {
    display: none !important;
  }
  .content.app-content {
    margin-left: 0;
    padding-top: 2rem !important;
  }
  footer.footer {
    display: none;
  }
  .card {
    background-color: transparent;
    box-shadow: none;
  }
  .customizer-toggle {
    display: none !important;
  }

  // Invoice Specific Styles
  .invoice-preview-wrapper {
    .row.invoice-preview {
      .col-md-8 {
        max-width: 100%;
        flex-grow: 1;
      }

      .invoice-preview-card {
        .card-body:nth-of-type(2) {
          .row {
            > .col-12 {
              max-width: 50% !important;
            }

            .col-12:nth-child(2) {
              display: flex;
              align-items: flex-start;
              justify-content: flex-end;
              margin-top: 0 !important;
            }
          }
        }
      }
    }

    // Action Right Col
    .invoice-actions {
      display: none;
    }
  }
}
</style>
