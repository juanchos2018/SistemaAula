import { ref, watch, computed } from '@vue/composition-api'
import store from '@/store'

// Notification
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function useModule() {
  // Use toast
  const toast = useToast()

  const refInvoiceListTable = ref(null)


  let grupo1=ref([]);   
  let grupo2=ref([]);   
  let grupo3=ref([]);   
  // Table Handlers

  const Columns = [
  
    { label:'Año',key: 'PERIOS', sortable: false },
    { label:'Estudiante',key: 'LAS_NM', sortable: false },
    { label:'Tipo Id',key: 'IDTYPE', sortable: false },
    { label:'No ID.',key: 'IDE_NO', sortable: false },
    { label:'Estado',key: 'ESTATU', sortable: false },
    { label:'Seccion',key: 'SEC_NM', sortable: false },   
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

 
  
  const fecthVsStudents = (ctx, callback) => {
    let a ="";
      let sea="";
      let search = a == "" ? "all" : sea;
   // let  url = "/vsstudent/records"+"?search="+currentPage.value; 
   // let  url = "/vsstudent/records"+"/"+currentPage.value; 
    let  url = "/vsstudent/records/"+search+"?page="+currentPage.value; 
    //this.url_base + "product/list/" + search + "?page=" + this.currentPage;
    store.dispatch('vstudent/fecthVsStudents',url)
      .then(response => {
      //  console.log(response);
        const { result,total } = response.data                
        totalInvoices.value = result.per_page     
        //currentPage.value=result.currentPage
      //  perPage.value=result.per_page  
        console.log("res:",response)
        console.log("total",totalInvoices.value);
        callback(result.data)

      })
      .catch((error) => {
        console.log(error);
        toast({
          component: ToastificationContent,
          props: {
            title: 'Error listar students',
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
    dataMeta,
    perPageOptions,
    searchQuery,
    sortBy,
    isSortDirDesc,
    refInvoiceListTable,

    statusFilter,


    refetchData,
    Columns,
    fecthVsStudents,
   
  }
}
