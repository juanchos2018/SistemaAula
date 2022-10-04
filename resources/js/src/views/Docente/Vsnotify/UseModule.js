import { ref, watch, computed } from '@vue/composition-api'
import store from '@/store'

// Notification
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function useModule() {
  // Use toast
  const toast = useToast()

  const refInvoiceListTable = ref(null)

  const Columns = [
  
    { label:'Id',key: 'SEC_ID', sortable: false },
    { label:'Periodo',key: 'PERIOS', sortable: false },
    { label:'Fecha',key: 'FECREG', sortable: false },
    { label:'Hora.',key: 'HORREG', sortable: false },
    { label:'Tipo Falta ',key: 'CLAIMS', sortable: false },
    { label:'SEC_NM',key: 'SEC_NM', sortable: false }, 
    { label:'Acciones',key: 'actions' },
  ]
  const perPage = ref(15)
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

 

  const refetchData = () => {
    refInvoiceListTable.value.refresh()
  }

  watch([currentPage, perPage, searchQuery, statusFilter], () => {
    refetchData()
  })

  

  return {
    
    perPage,
    currentPage, 
    dataMeta,
    perPageOptions,
    searchQuery,
    sortBy,
    isSortDirDesc,
    refInvoiceListTable,
    statusFilter,
    refetchData,
    Columns,

   
  }
}
