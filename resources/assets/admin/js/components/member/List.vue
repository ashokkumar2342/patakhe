<template>
    <div class="wrapper">
        <header class="panel-heading">
          All Seller List
          <span class="pull-right">
              <button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
              <a href="" class=" btn btn-success btn-xs"> New Seller Registration</a>
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
                    <th>Id</th>
                    <th>Date</th>
                    <th>Member Name</th>
                    <th>Customer Id</th>
                    <th>Member Type</th>                        
                    <th>Mobile</th>
                    <th width="100px">Status</th>
                    <th width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="member in members">
                    <td>66</td>
                    <td>2017-04-27 09:38:29</td>
                    <td class="p-name">Naveen  Bajaj</td>
                    <td >46531811</td>
                    <td>Green</td>
                    <td >9896088885</td>
                    
                    <td>
                        <span class="label label-success">Active</span>
                    </td>
                    <td>
                        <a href="" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>  </a>
                        <a href="" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>  </a>
                        <a href="" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i>  </a>
                        
                    </td>
                </tr>
            </tbody>
        </table>      
    </div>

</template>

<script>
export default {

	name: 'MemberList',

  	data () {
	    return {
	    	members:[],
	    };
  	},
  	created(){
    	this.memberList();
  	},
  	methods:{
  		memberList(){
  			axios.get('member/list').then(response => {
		        this.members = response.data;
		    });
  		}
  	}
};
</script>

<style lang="css" scoped>
</style>