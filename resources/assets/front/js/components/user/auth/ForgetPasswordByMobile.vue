<template>
<div class="panel panel-default">
    <div class="panel-heading">Reset Password <select class="pull-right" v-model="locVal" v-on:change="forgPassLocation()"><option value="forgetPasswordByMobile">Email</option><option value="forgetPasswordByEmail">Mobile</option></select></div>
    <div class="panel-body">
        <form method="post" v-if="userStatus  == 'getOTP'" v-on:submit.prevent="getOTP()">
            <div class="form-group clearfix">
                <input type="text" class="form-control" placeholder="Enter registered mobile no..." v-model="getOTPData.mobile" name="mobile">
                <p class="text-danger" v-for="error in errors.mobile">{{ error }}</p>
            </div>
            
            <div class="form-group clearfix text-center">
                <button type="submit" class="btn btn-primary "><i v-bind:class="{ 'fa-spinner': isActive }" class="fa   fa-spin"></i>Get OTP</button>
            </div>
            
        </form>
        <form method="post" v-if="userStatus == true" v-on:submit.prevent="matchOTP()">
            <div class="form-group clearfix">
                <input type="text" class="form-control" placeholder="Enter registered mobile no..." v-model="getOTPData.mobile" name="mobile">
                <p class="text-danger" v-for="error in errors.mobile">{{ error }}</p>
            </div>
            <div class="form-group clearfix" >
                <input type="text" class="form-control" placeholder="Enter otp by sent on registered mobile no..." v-model="getOTPData.otp"  name="otp">
                <p class="text-danger" v-for="error in errors.otp">{{ error }}</p>
            </div>
            <div class="form-group clearfix text-center">
                <button type="submit" class="btn btn-primary loader"> <i v-bind:class="{ 'fa-spinner': isActive }" class="fa  fa-spin"></i>Send Request</button>
            </div>
            
        </form>
        <form method="post" v-if="passForm == true" v-on:submit.prevent="changePass()">
            <div class="form-group clearfix">
                <input type="password" class="form-control" placeholder="Enter your Password ..." v-model="passFormData.password" name="password">
                <p class="text-danger" v-for="error in errors.password">{{ error }}</p>
            </div>
            <div class="form-group clearfix" >
                <input type="password" class="form-control" placeholder="Confirm Your Password ..." v-model="passFormData.password_confirmation"  name="password_confirmation">
                <p class="text-danger" v-for="error in errors.password_confirmation">{{ error }}</p>
            </div>
            <div class="form-group clearfix text-center">
                <button type="submit" class="btn btn-primary loader"> <i v-bind:class="{ 'fa-spinner': isActive }" class="fa  fa-spin"></i>Change Passwordt</button>
            </div>
            
        </form>
    </div>
</div>
</template>

<script>
    export default {
        mounted(){
        },
        data(){
            return{
                errors: [],
                model:{},
                getOTPData:{'mobile':'','otp':''},
                userStatus:'getOTP',
                isActive:false,
                passForm:false,
                passFormData:{'password':'','password_confirmation':'','mobile':'','otp':''},
                locVal:'',
            }
        },
        
        methods:{
            forgPassLocation(){
                router.push({ name: this.locVal});                
            },
            getOTP(){
                var vm = this;
                vm.isActive = true;
                vm.errors ='';
                axios.post('mobile/otp',vm.getOTPData)
                    .then(function(response){
                        if (response.data.status === 'OK') {
                            vm.userStatus = true;
                            vm.isActive = false;                            
                            toastr.success(response.data.message);
                        }
                        else{
                            vm.userStatus = false;
                            vm.isActive = false;   
                            toastr.error(response.data.message);   
                        }
                    },function (error){
                        vm.errors = error.response.data;
                        vm.isActive = false;
                    });
            },
            matchOTP(){
                var vm = this;
                vm.isActive = true;
                vm.errors ='' ;
                axios.post('mobile/otp/match',vm.getOTPData)
                    .then(function(response){
                        if (response.data.status === 'OK') {
                            vm.isActive = false;
                            vm.userStatus = false
                            vm.passForm = true;
                            vm.passFormData.mobile = vm.getOTPData.mobile;
                            vm.passFormData.otp = vm.getOTPData.otp;
                             toastr.success(response.data.message);
                        }
                        else{
                            vm.isActive = false;
                            toastr.error(response.data.message);
                        }
                    },function (error){
                        vm.errors = error.response.data;
                        vm.isActive = false;
                    });
            },
            changePass(){
                var vm = this;
                vm.isActive = true;
                vm.errors ='' ;
                axios.post('change',vm.passFormData)
                    .then(function(response){
                        if (response.data.status === 'OK') {
                            vm.isActive = false;
                             toastr.success(response.data.message);
                            window.location.href=__dirname;
                        }
                        else{
                            vm.isActive = false;
                            toastr.error(response.data.message);
                        }
                    },function (error){
                        vm.errors = error.response.data;
                        vm.isActive = false;
                    });
            }
        }
    }
</script>
