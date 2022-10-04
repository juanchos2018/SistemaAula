<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">

      <!-- Brand logo-->
      <b-link class="brand-logo">
        <vuexy-logo />
        <h2 class="brand-text text-primary ml-1">
          Sistema
        </h2>
      </b-link>
      <!-- /Brand logo-->

      <!-- Left Text-->
      <b-col
        lg="8"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
          <b-img
            fluid
            :src="imgUrl"
            alt="Login V2"
          />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Login-->
      <b-col
        lg="4"
        class="d-flex align-items-center auth-bg px-2 p-lg-5"
      >
        <b-col
          sm="8"
          md="6"
          lg="12"
          class="px-xl-2 mx-auto"
        >
          <b-card-title
            class="mb-1 font-weight-bold"
            title-tag="h2"
          >
            Bienvenido ! 👋
          </b-card-title>
          <b-card-text class="mb-2">
          Aplicación Integrada de Gestión Educativa
          </b-card-text>
<!-- 
          <b-alert
            variant="primary"
            show
          >
            <div class="alert-body font-small-2">
              <p>
                <small class="mr-50"><span class="font-weight-bold">Admin:</span> admin@demo.com | admin</small>
              </p>
              <p>
                <small class="mr-50"><span class="font-weight-bold">Client:</span> client@demo.com | client</small>
              </p>
            </div>
            <feather-icon
              v-b-tooltip.hover.left="'This is just for ACL demo purpose'"
              icon="HelpCircleIcon"
              size="18"
              class="position-absolute"
              style="top: 10; right: 10;"
            />
          </b-alert> -->

          <!-- form -->
          <validation-observer
            ref="loginForm"
            #default="{invalid}"
          >
            <b-form
              class="auth-login-form mt-2"
              @submit.prevent="loguear"
            >
              <!-- email -->
              <b-form-group
                label="Codigo"
                label-for="login-email"
              >
                <validation-provider
                  #default="{ errors }"
                  name="Email"             
                  rules="required"
                >
                  <b-form-input
                    id="login-email"
                    v-model="USU_ID"
                    :state="errors.length > 0 ? false:null"
                    name="login-email"
                    placeholder="john@example.com"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- forgot password -->
              <b-form-group>
                <div class="d-flex justify-content-between">
                  <label for="login-password">Contraseña</label>
                  <b-link :to="{name:'auth-forgot-password'}">
                    <small>Olvide Contraseña?</small>
                  </b-link>
                </div>
                <validation-provider
                  #default="{ errors }"
                  name="Password"
                  vid="password"
                  rules="required"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid':null"
                  >
                    <b-form-input
                      id="login-password"
                      v-model="password"
                      :state="errors.length > 0 ? false:null"
                      class="form-control-merge"
                      :type="passwordFieldType"
                      name="login-password"
                      placeholder="Password"
                    />
                    <b-input-group-append is-text>
                      <feather-icon
                        class="cursor-pointer"
                        :icon="passwordToggleIcon"
                        @click="togglePasswordVisibility"
                      />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- checkbox -->
              <b-form-group>
                <b-form-checkbox
                  id="remember-me"
                  v-model="status"
                  name="checkbox-1"
                >
                  Recordar
                </b-form-checkbox>
              </b-form-group>

              <!-- submit buttons -->
              <b-button
                type="submit"
                variant="primary"
                block
                :disabled="invalid"
              >
                Ingresar
              </b-button>
                 <b-button
                type="button"
                variant="primary"
                block
                @click="showToast('danger', 'adsfdsfsd','asdfdsfdsfds')"
             
              >
                mensaje
              </b-button>
            </b-form>
          </validation-observer>

          <!-- <b-card-text class="text-center mt-2">
            <span>New on our platform? </span>
            <b-link :to="{name:'auth-register'}">
              <span>&nbsp;Create an account</span>
            </b-link>
          </b-card-text>          -->

        
        </b-col>
      </b-col>
    <!-- /Login-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import VuexyLogo from '@core/layouts/components/Logo.vue'
import {
  BRow,
  BCol,
  BLink,
  BFormGroup,
  BFormInput,
  BInputGroupAppend,
  BInputGroup,
  BFormCheckbox,
  BCardText,
  BCardTitle,
  BImg,
  BForm,
  BButton,
  BAlert,
  VBTooltip,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import store from '@/store/index'
import { getHomeRouteForLoggedInUser } from '@/auth/utils'

import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
const axios = require("axios").default;
import jwt from 'jsonwebtoken'
export default {
  directives: {
    'b-tooltip': VBTooltip,
  },
  components: {
    BRow,
    BCol,
    BLink,
    BFormGroup,
    BFormInput,
    BInputGroupAppend,
    BInputGroup,
    BFormCheckbox,
    BCardText,
    BCardTitle,
    BImg,
    BForm,
    BButton,
    BAlert,
    VuexyLogo,
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      status: '',
      password: '1708782774',
      userEmail: 'admin@demo.com',
      USU_ID: '1708782774',
      sideImg: require('@/assets/images/pages/login-v2.svg'),

      // validation rules
      required,
      email,
       csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/pages/login-v2-dark.svg')
        return this.sideImg
      }
      return this.sideImg
    },
  },
  mounted(){
    //this.lisar();
   // console.log(this.csrf);
  },
  methods: {
      lisar(){
        console.log("vaa listar");
        let url="/bankers";
      axios({
            method: "GET",
            url: url, 
        })
        .then(function (response) {
            console.log(response)       
        })     
    },
    loguear(){
      let me =this;

      const jwtConfig = {
      secret: 'dd5f3089-40c3-403d-af14-d0c228b05cb4',
      refreshTokenSecret: '7c4c1c50-3230-45bf-9eae-c9b2e401c767',
      expireTime: '2m',
      refreshTokenExpireTime: '2m',
    }
      me.$refs.loginForm.validate().then(success => {
        if (success) {
            let url="/authenticates";
            let data2 ={
              USU_ID:'1708782774',
              USU_PAS:'1708782774',
            }
            let data={
              USU_ID:me.USU_ID,
              USU_PAS:me.password,
            }
         
            //   'X-CSRF-TOKEN': this.csrf
         axios({
              method: "POST",
              url: url, 
              data:data,
              headers: {
                'Authorization': `Basic ${me.csrf}`           
             }
          })
          .then(function (response) {
            let  {status,result}=response.data
              if (status==200) {
                let user =result.user;
                 const accessToken = jwt.sign({ id: user.USU_ID }, jwtConfig.secret, { expiresIn: jwtConfig.expireTime })
                 const refreshToken = jwt.sign({ id: user.USU_ID }, jwtConfig.refreshTokenSecret, {
                   expiresIn: jwtConfig.refreshTokenExpireTime,
                })
                console.log(response)       

              //  me.showToast('success','Mensaje',result.message); 
                let ability=[{action:"manage",subject:'all'}];
                let userData={
                  avatar:'/images/_/_/_/_/templateVueLaravel/resources/js/src/assets/images/avatars/13-small.png',
                  email:'admin@gmail.com',
                  fullName:user.ALI_NO,
                  id:1,
                  role:'admin',
                  username:user.ALI_NO,
                  ability:ability
                }
                  useJwt.setToken(accessToken)
                  useJwt.setRefreshToken(refreshToken)
                  localStorage.setItem('userData', JSON.stringify(userData))
                  me.$ability.update(userData.ability)
                 // me.$store.commit('app-ecommerce/UPDATE_CART_ITEMS_COUNT', userData.extras.eCommerceCartItemsCount)
                  me.$router.replace(getHomeRouteForLoggedInUser('admin')).then(() => {
                    me.$toast({
                      component: ToastificationContent,
                      position: 'top-right',
                      props: {
                        title: `Welcome ${user.ALI_NO || user.ALI_NO}`,
                        icon: 'CoffeeIcon',
                        variant: 'success',
                        text: `You have successfully logged in as ${userData.role}. Now you can start to explore!`,
                      },
                    })
                  })
                               
              }
              else if(status==400){
                  me.showToast('danger','Mensaje',result.message); 
              }else{
                 me.showToast('danger','Mensaje',"Error en el Servidor"); 

              }   

            // let {status,result }=response.data;
            // if (status ==200) {
            //   let admin='admin';
            //     if (result.USU_ROL==5) {
            //       }
            //     let accessToken ="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiaWF0IjoxNjYyMjU5MzQzLCJleHAiOjE2NjIyNTk5NDN9.DKUoP84hPlG6aoVIpl5lc2E6ith21RQi0fO6h7-3ZTk";
            //     let refreshToken ="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiaWF0IjoxNjYyMjU5MzQzLCJleHAiOjE2NjIyNTk5NDN9.8xF1oRJvmOjEg7Rxop6Dd32urwsH9jhSLjR9PIBCGG4";
            //     let ability=[{action:"manage",subject:'all'}];
            //     let userData={
            //       avatar:'/images/_/_/_/_/templateVueLaravel/resources/js/src/assets/images/avatars/13-small.png',
            //       email:'admin@gmail.com',
            //       fullName:result.USU_NM,
            //       id:1,
            //       role:'admin',
            //       username:result.USU_NM,
            //       ability:ability
            //     }
            //      useJwt.setToken(accessToken)
            //     useJwt.setRefreshToken(refreshToken)
            //     localStorage.setItem('userData', JSON.stringify(userData))
              
            //     me.$ability.update(userData.ability)

            //     me.$router.replace(getHomeRouteForLoggedInUser('admin')).then(() => {
            //     me.$toast({
            //       component: ToastificationContent,
            //       position: 'top-right',
            //       props: {
            //         title: `Welcome ${result.USU_NM || result.USU_NM}`,
            //         icon: 'CoffeeIcon',
            //         variant: 'success',
            //         text: `You have successfully logged in as ${admin}. Now you can start to explore!`,
            //       },
            //     })
            //   })
            // }else
            // {
            //   alert("no exise su usuario  we ");
            // }
         
          })     
          
        }
      })
    },
    showToast(variant, title,text) {
        console.log(text)     
      let position ='top-center';
      let me =this;
      me.$toast({
        component: ToastificationContent,
        props: {
          title: title,
          icon: 'InfoIcon',
          text: text,
          variant,
        },
      },
      {
        position,
      })
    },
   messageToast(toaster, append = false,title,text) {
     
        this.$bvToast.toast(`Toast ${this.counter} body content`, {
          title: `Toaster ${toaster}`,
          toaster: toaster,
          solid: true,
          appendToast: append
        })
      },
    login() {
      this.$refs.loginForm.validate().then(success => {
        if (success) {
          useJwt
            .login({
              email: this.USU_ID,
              password: this.password,
            })
            .then(response => {
              const { userData } = response.data
              console.log(response.data);
              console.log(userData);
              useJwt.setToken(response.data.accessToken)
              useJwt.setRefreshToken(response.data.refreshToken)
              localStorage.setItem('userData', JSON.stringify(userData))
              this.$ability.update(userData.ability)

              // ? This is just for demo purpose as well.
              // ? Because we are showing eCommerce app's cart items count in navbar
              this.$store.commit('app-ecommerce/UPDATE_CART_ITEMS_COUNT', userData.extras.eCommerceCartItemsCount)
              console.log(userData.role);
              // ? This is just for demo purpose. Don't think CASL is role based in this case, we used role in if condition just for ease
              this.$router.replace(getHomeRouteForLoggedInUser(userData.role)).then(() => {
             
             
             this.$toast({
                  component: ToastificationContent,
                  position: 'top-right',
                  props: {
                    title: `Welcome ${userData.fullName || userData.username}`,
                    icon: 'CoffeeIcon',
                    variant: 'success',
                    text: `You have successfully logged in as ${userData.role}. Now you can start to explore!`,
                  },
                })
              })
            })
            .catch(error => {
              this.$refs.loginForm.setErrors(error.response.data.error)
            })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '~@resources/scss/vue/pages/page-auth.scss';
</style>
