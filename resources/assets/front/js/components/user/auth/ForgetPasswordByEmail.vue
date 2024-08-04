<template>
<div class="panel panel-default">
    <div class="panel-heading">Reset Password <select class="pull-right" v-on:change="forgPassLocation()"><option value="email">Email</option><option value="mobile">Mobile</option></select></div>
    <div class="panel-body">
        <form method="post"  v-on:submit.prevent="sendToken()">
        <div class="form-group clearfix">
            <input type="text" class="form-control" placeholder="Enter registered Email id..." v-model="sendTokenData.email" name="email">
            <p class="text-danger" v-for="error in errors.email">{{ error }}</p>
        </div>
        
        <div class="form-group clearfix text-center">
            <button type="submit" class="btn btn-primary "><i v-bind:class="{ 'fa-spinner': isActive }" class="fa fa-spin"></i>Send Request</button>
        </div>
        
    </form>
    </div>
</div>

</template>

<script>
    export default {
        data(){
            return{
                errors: [],
                model:{},
                sendTokenData:{'email':''},
                isActive:false,
            }
        },
        methods:{
            sendToken(){
                var vm = this;
                vm.errors ='';
                vm.isActive = true;
                axios.post('email/request',vm.sendTokenData)
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
