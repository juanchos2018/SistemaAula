import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {

    fecthVsStudents(ctx,url,queryParams=null){ 
      //    this.url_base + "product/list/" + search + "?page=" + this.currentPage;
      return new Promise((resolve, reject) => {       
        axios
          .get(url)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    
  },
}
