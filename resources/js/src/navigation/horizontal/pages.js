export default [
  {
    header: 'Pages',
    icon: 'FileTextIcon',
    children: [
      {
        title: 'Authentication',
        icon: 'LockIcon',
        children: [
          {
            title: 'Login v1',
            route: 'auth-login-v1',
            target: '_blank',
          },
          {
            title: 'Login v2',
            route: 'auth-login-v2',
            target: '_blank',
          },
          {
            title: 'Register v1',
            route: 'auth-register-v1',
            target: '_blank',
          },
          {
            title: 'Register v2',
            route: 'auth-register-v2',
            target: '_blank',
          },
          {
            title: 'Forgot Password v1',
            route: 'auth-forgot-password-v1',
            target: '_blank',
          },
          {
            title: 'Forgot Password v2',
            route: 'auth-forgot-password-v2',
            target: '_blank',
          },
          {
            title: 'Reset Password v1',
            route: 'auth-reset-password-v1',
            target: '_blank',
          },
          {
            title: 'Reset Password v2',
            route: 'auth-reset-password-v2',
            target: '_blank',
          },
        ],
      },
      {
        title: 'Account Settings',
        route: 'pages-account-setting',
        icon: 'SettingsIcon',
      },
      {
        title: 'Profile',
        route: 'pages-profile',
        icon: 'UserIcon',
      },     
      {
        title: 'Knowledge Base',
        route: 'pages-knowledge-base',
        icon: 'AlertCircleIcon',
      },

      

    

      // {
      //   title: 'Mail Templates',
      //   icon: 'MailIcon',
      //   children: [
      //     {
      //       title: 'Welcome',
      //       href: 'https://pixinvent.com/demo/vuexy-mail-template/mail-welcome.html',
      //     },
      //     {
      //       title: 'Reset Password',
      //       href: 'https://pixinvent.com/demo/vuexy-mail-template/mail-reset-password.html',
      //     },
      //     {
      //       title: 'Verify Email',
      //       href: 'https://pixinvent.com/demo/vuexy-mail-template/mail-verify-email.html',
      //     },
      //     {
      //       title: 'Deactivate Account',
      //       href: 'https://pixinvent.com/demo/vuexy-mail-template/mail-deactivate-account.html',
      //     },
      //     {
      //       title: 'Invoice',
      //       href: 'https://pixinvent.com/demo/vuexy-mail-template/mail-invoice.html',
      //     },
      //     {
      //       title: 'Promotional',
      //       href: 'https://pixinvent.com/demo/vuexy-mail-template/mail-promotional.html',
      //     },
      //   ],
      // },

    
    ],
  },
]
