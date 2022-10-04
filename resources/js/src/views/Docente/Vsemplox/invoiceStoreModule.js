import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fecthVsEmplox(ctx,url){
      console.log("url:",url);
      return new Promise((resolve, reject) => {       
        axios
          .get(url)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },      
  },
}
