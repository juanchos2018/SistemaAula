export default [
 
  {
    path: '/Vsemplox',
    name: 'ficha-Personal',
    component: () => import('@/views/Docente/Vsemplox/ListFicha.vue'),   
  },

  {
    path: '/Vssecmat',
    name: 'malla-curricular',
    component: () => import('@/views/Docente/Vssecmat/ListMalla.vue'),   
  },
  {
    path: '/Vstudent',
    name: 'ficha-estudent',
    component: () => import('@/views/Docente/Vstudent/List.vue'),   
  },
  {
    path: '/Vsabsent',
    name: 'lista-asistencia',
    component: () => import('@/views/Docente/VsAbsent/List.vue'),
  },
  {
    path: '/Vsnotify',
    name: 'lista-notificacion',
    component: () => import('@/views/Docente/Vsnotify/List.vue'),
  },
  {
    path: '/Vschedul',
    name: 'aula-virtual',
    component: () => import('@/views/Aula/index.vue'),
  },
  {
    path: '/Vslibstd',
    name: 'boletin-estudiante',
    component: () => import('@/views/Docente/vslibstd/List.vue'),
  },
  {
    path: '/Vslibsec',
    name: 'boletin-seccion',
    component: () => import('@/views/Docente/vslibsec/List.vue'),
  },

  {
    path: '/Vsactsav',
    name: 'registrar-calificacion',
    component: () => import('@/views/Docente/vsactsav/List.vue'),
  },
  {
    path: '/Vsactmat',
    name: 'informe-calificaciones',
    component: () => import('@/views/Docente/VsAcmat/List.vue'),
  },



 
  
  // {
  //   path: '/apps/acta/:id',
  //   name: 'apps-acta',
  //   component: () => import('@/views/Docente/Vstudent/Acta.vue'),
    
  // },
  // {
  //   path: '/apps/todo/:filter',
  //   name: 'apps-todo-filter',
  //   component: () => import('@/views/apps/todo/Todo.vue'),
  //   meta: {
  //     contentRenderer: 'sidebar-left',
  //     contentClass: 'todo-application',
  //     navActiveLink: 'apps-todo',
  //   },
  //   beforeEnter(to, _, next) {
  //     if (['important', 'completed', 'deleted'].includes(to.params.filter)) next()
  //     else next({ name: 'error-404' })
  //   },
  // },
  // {
  //   path: '/apps/todo/tag/:tag',
  //   name: 'apps-todo-tag',
  //   component: () => import('@/views/apps/todo/Todo.vue'),
  //   meta: {
  //     contentRenderer: 'sidebar-left',
  //     contentClass: 'todo-application',
  //     navActiveLink: 'apps-todo',
  //   },
  //   beforeEnter(to, _, next) {
  //     if (['team', 'low', 'medium', 'high', 'update'].includes(to.params.tag)) next()
  //     else next({ name: 'error-404' })
  //   },
  // },


 






  // {
  //   path: '/apps/users/list',
  //   name: 'apps-users-list',
  //   component: () => import('@/views/apps/user/users-list/UsersList.vue'),
  // },
  // {
  //   path: '/apps/users/view/:id',
  //   name: 'apps-users-view',
  //   component: () => import('@/views/apps/user/users-view/UsersView.vue'),
  // },
  // {
  //   path: '/apps/users/edit/:id',
  //   name: 'apps-users-edit',
  //   component: () => import('@/views/apps/user/users-edit/UsersEdit.vue'),
  // },

  // // Invoice
  // {
  //   path: '/apps/invoice/list',
  //   name: 'apps-invoice-list',
  //   component: () => import('@/views/apps/invoice/invoice-list/InvoiceList.vue'),
  // },
  // {
  //   path: '/apps/invoice/preview/:id',
  //   name: 'apps-invoice-preview',
  //   component: () => import('@/views/apps/invoice/invoice-preview/InvoicePreview.vue'),
  // },
  // {
  //   path: '/apps/invoice/add/',
  //   name: 'apps-invoice-add',
  //   component: () => import('@/views/apps/invoice/invoice-add/InvoiceAdd.vue'),
  // },
  // {
  //   path: '/apps/invoice/edit/:id',
  //   name: 'apps-invoice-edit',
  //   component: () => import('@/views/apps/invoice/invoice-edit/InvoiceEdit.vue'),
  // },


]
