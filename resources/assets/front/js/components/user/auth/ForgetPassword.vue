<template>
<div class="panel panel-default">
    <div class="panel-heading">Reset Password <select class="pull-right" v-model="locVal"  ><option value="email">Email</option><option value="mobile">Mobile</option></select></div>
    <div class="panel-body">
    	<div class="col-md-12" v-if="locVal == 'mobile'">
    		<form method="post" v-if="userStatus  == 'getOTP'" v-on:submit.prevent="getOTP()">
	            <div class="form-group clearfix">
	            	<label class="col-md-3 control-label">Mobile No.</label>
	                <div class="col-md-9">
	                	<input type="text" class="form-control" placeholder="Enter registered mobile no." v-model="getOTPData.mobile" name="mobile">     
                        <p class="text-danger" v-for="error in errors.mobile">{{ error }}</p>                   
	                </div>	                
	            </div>
                <div class="form-group clearfix">
                    <div class="col-md-9 col-md-offset-3">
                        <img :src="captchaSrc" > &nbsp;&nbsp; <a href="" v-on:click.prevent="refreshCaptcha" class="rotate"><i class="fa fa-refresh " v-bind:class="{ 'fa-spin': spiner }"></i></a><br><input type="text" v-model="getOTPData.captcha" autocomplete="off" name="captcha">
                        <p class="text-danger" v-for="error in errors.captcha">{{ error }}</p>
                    </div>
                </div>
	            
	            <div class="form-group clearfix text-center">
	                <button type="submit" class="btn btn-primary "><i v-bind:class="{ 'fa-spinner': isActive }" class="fa   fa-spin"></i> Get OTP </button>
	            </div>
	        </form>
	        <form method="post" v-if="userStatus == true" v-on:submit.prevent="matchOTP()">
	            <div class="form-group clearfix">
	            	<label class="col-md-3 control-label">Mobile No.</label>
	            	<div class="col-md-9">
	                	<input type="text" class="form-control" placeholder="Enter registered mobile no." v-model="getOTPData.mobile" name="mobile">
	                </div>
	                <p class="text-danger" v-for="error in errors.mobile">{{ error }}</p>
	            </div>
	            <div class="form-group clearfix" >
	            	<label class="col-md-3 control-label">OTP</label>
	            	<div class="col-md-9">
	            		<input type="text" class="form-control" size="7" placeholder="Enter OTP" v-model="getOTPData.otp"  name="otp">
	            	</div>	                
	                <p class="text-danger" v-for="error in errors.otp">{{ error }}</p>
	            </div>
	            <div class="form-group clearfix text-center">
	                <button type="submit" class="btn btn-primary loader"> <i v-bind:class="{ 'fa-spinner': isActive }" class="fa  fa-spin"></i>Send Request</button>
	            </div>
	        </form>
	        <form method="post" v-if="passForm == true" v-on:submit.prevent="changePass()">
	            <div class="form-group clearfix">
	            	<label class="col-md-3 control-label">Password</label>
	            	<div class="col-md-9">
	                	<input type="password" class="form-control" placeholder="Enter your Password ..." v-model="passFormData.password" name="password">
	                </div>
	                <p class="text-danger" v-for="error in errors.password">{{ error }}</p>
	            </div>
	            <div class="form-group clearfix" >
	            	<label class="col-md-3 control-label">Confirm Password</label>
	            	<div class="col-md-9">
	                	<input type="password" class="form-control" placeholder="Confirm Your Password ..." v-model="passFormData.password_confirmation"  name="password_confirmation">
	                </div>
	                <p class="text-danger" v-for="error in errors.password_confirmation">{{ error }}</p>
	            </div>
	            <div class="form-group clearfix text-center">
	                <button type="submit" class="btn btn-primary loader"> <i v-bind:class="{ 'fa-spinner': isActive }" class="fa  fa-spin"></i> Change Password </button>
	            </div>
	        </form>
    	</div>
        <div class="col-md-12">
        	<form method="post" v-if="locVal == 'email'"  v-on:submit.prevent="sendToken()">
		        <div class="form-group clearfix">
		        	<label class="col-md-3 control-label">Email Id</label>
		        	<div class="col-md-9">
		            	<input type="text" class="form-control" placeholder="Enter registered Email id..." v-model="sendTokenData.email" name="email">
		            </div>
		            <p class="text-danger" v-for="error in errors.email">{{ error }}</p>
		        </div>
		        <div class="form-group clearfix text-center">
		            <button type="submit" class="btn btn-primary "><i v-bind:class="{ 'fa-spinner': isActive }" class="fa fa-spin"></i> Send Request </button>
		        </div>
		        
		    </form>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted(){
            var vm = this;
            axios.put('../get-captcha').then(response=>{
                vm.captchaSrc = response.data;
            });
        },
        data(){
            return{
                errors: [],
                model:{},
                getOTPData:{'mobile':'','otp':'','getOTPData':''},
                userStatus:'getOTP',
                isActive:false,
                sendTokenData:{'email':''},
                passForm:false,
                passFormData:{'password':'','password_confirmation':'','mobile':'','otp':''},
                locVal:'mobile',
                captchaSrc:'',
                spiner:false
            }
        },
        
        methods:{
            getOTP(){
                var vm = this;
                vm.isActive = true;
                vm.errors ='';
                axios.post('forget-password/mobile/otp',vm.getOTPData)
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
                        if(vm.errors.captcha[0] == 'validation.captcha'){
                            vm.errors.captcha[0] = 'Invalid captcha ! Please try again.';
                            vm.refreshCaptcha();
                        }
                    });
            },
            refreshCaptcha(){
                this.spiner = true;
                axios.put('../get-captcha').then(response=>{
                    if(this.captchaSrc = response.data){
                        this.spiner = false;
                    }
                    else{
                        this.spiner = false;
                    }
                });
            },
            matchOTP(){
                var vm = this;
                vm.isActive = true;
                vm.errors ='' ;
                axios.post('forget-password/mobile/otp/match',vm.getOTPData)
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
                axios.post('forget-password/change',vm.passFormData)
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
            },
            sendToken(){
                var vm = this;
                vm.errors ='';
                vm.isActive = true;
                axios.post('forget-password/email/request',vm.sendTokenData)
                    .then(function(response){
                        if (response.data.status === 'OK') {                        
                            toastr.success(response.data.message);
                            vm.isActive = false;
                        }
                        else{
                            toastr.error(response.data.message);  
                            vm.isActive = false; 
                        }
                    },function (error){
                        vm.errors = error.response.data;
                        vm.isActive = false;
                    });
            }
        }
    }
</script>
