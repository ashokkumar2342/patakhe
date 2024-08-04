<template>
	<div>
		<header class="panel-heading">
          	All Seller List
      		<span class="pull-right">
          		<button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
          		<a href="http://admin.icaps.dev/seller/new" class=" btn btn-success btn-xs"> New Seller Registration</a>
      		</span>
        </header>
        <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                  <div class="input-group"><input type="text" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
                  <button type="button" class="btn btn-sm btn-success"> Go! </button> </span></div>
              </div>
          </div>
        </div>
        <table class="table table-hover p-table table-responsive">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Seller Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th width="100px">Status</th>
                    <th width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" >
                    <td>{{ user.created_at }}</td>
                    <td class="p-name">{{ user.first_name }}</td>
                    <td >{{ user.mobile }}</td>
                    <td >{{ user.email }}</td>
                    <td>
                        <span class="label label-success"></span>
                    </td>
                    <td>
                        <a href="" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>  </a>
                        <a href="" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>  </a>
                        <a v-on:click.stop.prevent="userDelete(user)" v-bind:class="{ 'disabled': isActive }" class="btn btn-danger btn-xs"><i v-bind:class="[isLoader==user.id ? 'fa-spin fa-spinner' : 'fa-trash-o' ]" class="fa "></i>  </a>
                    </td>
                </tr>
            </tbody>
        </table> 
        
    </div>
</template>

<script>
export default {

    name: 'UserList',

    data () {
        return {
        	users:[],
            isActive:false,
            isLoader:false
        };
    },
    created(){
        this.userList();
    },
    methods:{
  		userList(){
  			axios.get('user/list').then(response => {
		        this.users = response.data;
		    });
        
  		},
        userDelete(user){
           var vm = this;
            if(confirm('Are you sure to delete this item')){
               vm.isLoader = user.id; 
                axios.delete('user/delete/'+user.id).then(response => {
                    if (response.data.status === 'OK' ) {
                        this.users.splice(this.users.indexOf(user),1);
                        toastr.success(response.data.message); 
                    }
                    else{
                        toastr.error(response.data.message); 
                        vm.isLoader = false;
                    }
                    
                });
            }
        }
    }


};
</script>

<style lang="css" scoped>
</style>