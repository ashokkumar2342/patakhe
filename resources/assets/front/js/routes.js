import ForgetPassword from './components/user/auth/ForgetPassword.vue';
import AccountActivation from './components/user/auth/AccountActivation.vue';
export default [
    {
        path: '/user/password/forget-password',
        component: ForgetPassword,
        name: 'ForgetPassword'
    },
    {
        path: '/user/account/verify',
        component: AccountActivation,
        name: 'AccountActivation'
    },
]
