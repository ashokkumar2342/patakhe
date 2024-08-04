<template>
  <!--body wrapper start-->
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
                    <th>Date</th>
                    <th>Seller Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th width="100px">Status</th>
                    <th width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="seller in sellers">
                    <td>2017-04-26 19:41:06</td>
                    <td class="p-name">Amar kumar  singh h</td>
                    <td >9386495527</td>
                    <td >developeramarkumar@gmail.com</td>
                    <td>
                        <span class="label label-success">Active</span>
                    </td>
                    <td>
                        <a href="" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>  </a>
                        <a href="" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>  </a>
                        <a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
                    </td>
                </tr>
            </tbody>
        </table>      
    </div>
    <!--body wrapper end-->

</template>

<script>
export default {

  	name: 'SellerList',

  	data () {
	    return {
	    	sellers:[],
	    };
  	},
  	created(){
    	this.sellerList();
  	},
  	methods:{
  		sellerList(){
  			axios.get('seller/list').then(response => {
		        this.sellers = response.data;
		    });
  		}
  	}
};
</script>

<style lang="css" scoped>
</style>