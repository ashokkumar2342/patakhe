	<template>
		<div class="panel panel-default">
	    	<div class="panel-heading">Account Activation</div>
		    <div class="panel-body">
			    <form method="post" v-if="hasOtp  == true" v-on:submit.prevent="verify()">
			    	<div class="form-group clearfix">
                    	<div class="col-md-4">Mobile</div>
                    	<div class="col-md-8">
                    		<input type="text" v-model="verifyOTPData.mobile" placeholder="Enter your registered mobile no." class='form-control'>
                    		<p class="text-danger" v-for="error in errors.mobile">{{ error }}</p>
                    	</div>
	                </div>
			    	<div class="form-group clearfix">
                    	<div class="col-md-4">OTP</div>
                    	<div class="col-md-8">
                    		 <input type="text" v-model="verifyOTPData.otp" placeholder="Enter otp" class='form-control'>
                    		 <p class="text-danger" v-for="error in errors.otp">{{ error }}</p>
                    	</div>
	                </div>
			    	<div class="form-group clearfix">
                    	<div class="col-md-4">Captcha</div>
                    	<div class="col-md-8">
                    		<input type="text" v-model="verifyOTPData.captcha" autocomplete="off" placeholder="Enter captcha" class="form-control">
                    		<p class="text-danger" v-for="error in errors.captcha">{{ error }}</p>
                    		<br><img :src="captchaSrc" > &nbsp;&nbsp; <a href="" v-on:click.prevent="refreshCaptcha" class="rotate"><i class="fa fa-refresh " v-bind:class="{ 'fa-spin': spiner }"></i></a><br>
                    	</div><br>
	                </div>
		            
		            <div class="form-group clearfix text-center">
		            	<div class="col-md-8 col-sm-8">
		            		Not recived otp ?<a href="" v-on:click.prevent="hasOtp = false">  Resend Otp </a>
		            	</div>
		            	<div class="col-md-4 col-sm-4">
		            		<button type="submit" class="btn btn-primary "><i v-bind:class="{ 'fa-spinner': isActive }" class="fa   fa-spin"></i> Verify Account </button>
		            	</div>
		                
		                
		            </div>
		        </form>
		        <form method="post" v-if="hasOtp  == false" v-on:submit.prevent="resendOtp()">
			    	<div class="form-group clearfix">
                    	<div class="col-md-4">Mobile</div>
                    	<div class="col-md-8">
                    		<input type="text" v-model="resendOTPData.mobile" placeholder="Enter your registered mobile no." class='form-control'>
                    		<p class="text-danger" v-for="error in errors.mobile">{{ error }}</p>
                    	</div>
	                </div>
	                <div class="form-group clearfix">
                    	<div class="col-md-4">Password</div>
                    	<div class="col-md-8">
                    		<input type="password" v-model="resendOTPData.password" placeholder="Enter your password" class='form-control'>
                    		<p class="text-danger" v-for="error in errors.password">{{ error }}</p>
                    	</div>
	                </div>
			    	<div class="form-group clearfix">
                    	<div class="col-md-4">Enter Captcha</div>
                    	<div class="col-md-8">
                    		<input type="text" v-model="resendOTPData.captcha" autocomplete="off" placeholder="Enter captcha" class="form-control">
                    		<p class="text-danger" v-for="error in errors.captcha">{{ error }}</p>
                    		<br><img :src="captchaSrc" > &nbsp;&nbsp; <a href="" v-on:click.prevent="refreshCaptcha" class="rotate"><i class="fa fa-refresh " v-bind:class="{ 'fa-spin': spiner }"></i></a><br>
                    	</div>
                    	<br>                        
	                </div>
		            
		            <div class="form-group clearfix text-center">
			            <div class="col-md-8 col-sm-8">
			            	have you recived otp ? <a href="" v-on:click.prevent="hasOtp = true">  verify account </a>
			            </div>
		            	<div class="col-md-4 col-sm-4">
		            		<button type="submit" class="btn btn-primary "><i v-bind:class="{ 'fa-spinner': isActive }" class="fa fa-spin"></i> Get OTP </button>
		            	</div>
		                
		                
		            </div>
		        </form>
		    </div>
		</div>
	</template>
	
	<script>
	export default {
	
	  name: 'AccountActivation',
	 mounted(){
            var vm = this;
            axios.put('../get-captcha').then(response=>{
                vm.captchaSrc = response.data;
            });
        },
        data(){
            return{
                errors: [],
                verifyOTPData:{'otp':'','mobile':'','captcha':''},
                resendOTPData:{'mobile':'','password':'','captcha':''},
                model:{},
              	isActive:false,
                captchaSrc:'',
                hasOtp:true,
                spiner:false
            }
        },
        
        methods:{
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
            verify(){
            	var vm = this;
            	vm.isActive = true;
            	axios.post('/user/account/verify',vm.verifyOTPData)
                    .then(function(response){
                        if (response.data.status === 'OK') {
                            window.location.href=__dirname;
                            toastr.success(response.data.message);
                        }
                        else{
                            toastr.error(response.data.message);   
                        }
                        vm.isActive = false;
                        vm.refreshCaptcha();
                    },function (error){
                        vm.errors = error.response.data;
                        if(vm.errors.captcha[0] == 'validation.captcha'){
                            vm.errors.captcha[0] = 'Invalid captcha ! Please try again.';
                        }
                        vm.isActive = false;
                        vm.refreshCaptcha();
                    });
            },
            resendOtp(){
            	var vm = this;
            	vm.isActive = true;
            	axios.put('/user/account/resend/otp',vm.resendOTPData)
                    .then(function(response){
                        if (response.data.status === 'OK') {
                        	vm.hasOtp = true;   
                        	verifyOTPData.mobile = resendOTPData.mobile;         
                            toastr.success(response.data.message);
                        }
                        else{
                            toastr.error(response.data.message);  
                        }
                        vm.isActive = false;
                        vm.refreshCaptcha();
                    },function (error){
                        vm.errors = error.response.data;
                        if(vm.errors.captcha[0] == 'validation.captcha'){
                            vm.errors.captcha[0] = 'Invalid captcha ! Please try again.';
                        }
                        vm.isActive = false;
                        vm.refreshCaptcha();
                    });
            }
	 	}
	};
	</script>
	
	<style lang="css" scoped>
	</style>