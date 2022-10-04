import { ref, watch, computed } from '@vue/composition-api'
import store from '@/store'

// Notification
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function useInvoicesList() {
  // Use toast
  const toast = useToast()
  // Table Handlers

  const Columns = [
    { label:'#',key: 'id',  sortable: false },
    { label:'Nombre',key: 'LAS_NM', sortable: false },
    { label:'Apellido',key: 'FIR_NM', sortable: false },
    { label:'Tipo Id',key: 'IDTYPE', sortable: false },
    { label:'No. Id',key: 'IDE_NO', sortable: false },
    { label:'Estado',key: 'ESTATU', sortable: false },
    { label:'Direccion',key: 'ADDRES', sortable: false },    
    { label:'Telefono',key: 'TPHONE', sortable: false },
    { label:'Acciones',key: 'actions' },
  ]
 

  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const statusFilter = ref(null)
 

  const fecthVsEmplox = (ctx, callback) => {
    let  url = "/vsemblox/records"; 
    store
      .dispatch('app-invoice/fecthVsEmplox',url)
      .then(response => {
        const { result,total } = response.data                  
        callback(result)
        totalInvoices.value = total       
      })
      .catch(() => {
        toast({
          component: ToastificationContent,
          props: {
            title: 'Error fetching users list',
            icon: 'AlertTriangleIcon',
            variant: 'danger',
          },
        })
      })
  } 

  const fetchInvoices = (ctx, callback) => {
    store
      .dispatch('app-invoice/fetchInvoices', {
        q: searchQuery.value,
        perPage: perPage.value,
        page: currentPage.value,
        sortBy: sortBy.value,
        sortDesc: isSortDirDesc.value,
        status: statusFilter.value,
      })
      .then(response => {
        const { invoices, total } = response.data
        callback(invoices)
        totalInvoices.value = total
      })
      .catch(() => {
        toast({
          component: ToastificationContent,
          props: {
            title: "Error fetching invoices' list",
            icon: 'AlertTriangleIcon',
            variant: 'danger',
          },
        })
      })
  }

  return {
    perPageOptions,
    searchQuery,
    sortBy,
    isSortDirDesc, 
    statusFilter,  
    Columns,

  }
}
