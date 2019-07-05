 <script>

  setInterval(function() {
    $.ajax({
    type: "GET",
    url: '<?php echo base_url(); ?>/ari/company_count',
    success: function(data){
         $("#companies").html(data);
    }
});
  //your jQuery ajax code
}, 10000 ); // where X is your every X minutes

   setInterval(function() {
    $.ajax({
    type: "GET",
    url: '<?php echo base_url(); ?>/ari/manager_count',
    success: function(data){
         $("#managers").html(data);
    }
});
  //your jQuery ajax code
}, 10000 ); // where X is your every X minutes

    setInterval(function() {
    $.ajax({
    type: "GET",
    url: '<?php echo base_url(); ?>/ari/developer_count',
    success: function(data){
         $("#developers").html(data);
    }
});
  //your jQuery ajax code
}, 10000 ); // where X is your every X minutes
     setInterval(function() {
    $.ajax({
    type: "GET",
    url: '<?php echo base_url(); ?>/ari/task_count',
    success: function(data){
         $("#tasks").html(data);
    }
});
  //your jQuery ajax code
}, 10000 ); // where X is your every X minutes

</script>
 <div  class="container-fluid mt-4"> 
      <!-- Breadrumb -->
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Overview</li>
      </ul>
 <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card bg-primary text-white h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-comments fa-5x"></i></div>
              <div class="mr-5"><span id="companies"></span> Companies</div>
            </div>
            <a href="#" class="card-footer clearfix small text-white"><span class="float-left">View Details</span><span class="float-right"><i class="fa fa-angle-right"></i></span></a> </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card bg-warning text-white h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-list fa-5x"></i></div>
              <div class="mr-5"><span id="managers"></span> Project Managers</div>
            </div>
            <a href="#" class="card-footer clearfix small text-white"><span class="float-left">View Details</span><span class="float-right"><i class="fa fa-angle-right"></i></span></a> </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card bg-success text-white h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-shopping-cart fa-5x"></i></div>
              <div class="mr-5"><span id="developers"></span> Developers</div>
            </div>
            <a href="#" class="card-footer clearfix small text-white"><span class="float-left">View Details</span><span class="float-right"><i class="fa fa-angle-right"></i></span></a> </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card bg-danger text-white h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-life-ring fa-5x"></i></div>
              <div class="mr-5"><span id="tasks"></span> Tasks!</div>
            </div>
            <a href="#" class="card-footer clearfix small text-white"><span class="float-left">View Details</span><span class="float-right"><i class="fa fa-angle-right"></i></span></a> </div>
        </div>
      </div> 