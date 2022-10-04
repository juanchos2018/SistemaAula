import { ref, watch, computed } from '@vue/composition-api'
import store from '@/store'

// Notification
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function useModule() {
  // Use toast
  const toast = useToast()

  const refInvoiceListTable = ref(null)
  const asignatura = ref([]);
  const regimens   = ref([]);
  const ordens     = ref([]);

  let grupo1=ref([]);   
  let grupo2=ref([]);   
  let grupo3=ref([]);   
  // Table Handlers

  const Columns = [
  
    { label:'Sección',key: 'SEC_NM', sortable: false },
    { label:'Asignatura',key: 'MAT_NM', sortable: false },
    { label:'Regimen',key: 'REGIME', sortable: false },
    { label:'Docente',key: 'FIR_NM', sortable: false },    
    { label:'Acciones',key: 'actions' },
  ]
  const perPage = ref(10)
  const totalInvoices = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const statusFilter = ref(null)

  const dataMeta = computed(() => {
    const localItemsCount = refInvoiceListTable.value ? refInvoiceListTable.value.localItems.length : 0
    return {
      from: perPage.value * (currentPage.value - 1) + (localItemsCount ? 1 : 0),
      to: perPage.value * (currentPage.value - 1) + localItemsCount,
      of: totalInvoices.value,
    }
  })

  const fecthVsEcmat = (ctx, callback) => {
    let  url = "/vssecmat/records"; 
    store.dispatch('vssecmat/fecthVsEcmat',url)
      .then(response => {
      //  console.log(response);
        const { result,total } = response.data                
        totalInvoices.value = total       
      
        result.forEach((item)=>{
          grupo1.value.push({asignatura:item.MAT_NM});         
        })

        result.forEach((item)=>{
          grupo2.value.push({regimen:item.REGIME});         
        })

        result.forEach((item)=>{
          grupo3.value.push({order:item.ORDERS});         
        })

        const groupAsignatura = grupo1.value.reduce((group, product) => {
          const { asignatura } = product;
          group[asignatura] = group[asignatura] ?? [];
          group[asignatura].push(product);
          return group;
        }, {});  

        const groupRegimen = grupo2.value.reduce((group, product) => {
          const { regimen } = product;
          group[regimen] = group[regimen] ?? [];
          group[regimen].push(product);
          return group;
        }, {});  

        const groupOrders = grupo3.value.reduce((group, product) => {
          const { order } = product;
          group[order] = group[order] ?? [];
          group[order].push(product);
          return group;
        }, {});  

        for (const property in groupAsignatura) {     
            asignatura.value.push({nombre:property,cantidad:groupAsignatura[property].length})    
        }
        for (const property in groupRegimen) {     
          let nombre ="";
          if (property=='1') {
            nombre='Interno'; 
          }
          else
          {
            nombre="Malla";
          }
            regimens.value.push({nombre:nombre,cantidad:groupRegimen[property].length})    
        }
        for (const property in groupOrders) {     
            ordens.value.push({nombre:property,cantidad:groupOrders[property].length})    
        }


        console.log(response)
        callback(result)

      })
      .catch((error) => {
        console.log(error);
        toast({
          component: ToastificationContent,
          props: {
            title: 'Error listar malla',
            icon: 'AlertTriangleIcon',
            variant: 'danger',
          },
        })
      })
  }
  const refetchData = () => {
    refInvoiceListTable.value.refresh()
  }

  watch([currentPage, perPage, searchQuery, statusFilter], () => {
    refetchData()
  })

  

  // *===============================================---*
  // *--------- UI ---------------------------------------*
  // *===============================================---*




  return {
    
    perPage,
    currentPage,
    totalInvoices,
    dataMeta,
    perPageOptions,
    searchQuery,
    sortBy,
    isSortDirDesc,
    refInvoiceListTable,

    statusFilter,



    refetchData,

    Columns,
    fecthVsEcmat,
    asignatura,
    regimens,
    ordens
  }
}
