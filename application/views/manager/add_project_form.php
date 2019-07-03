<script type="text/javascript">
$(document).ready(function(){
    //group add limit
    var maxGroup = 10;
    
    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});
</script>
<br />
<div class="col-md-6 col-lg-6" style="margin-left: 20px;">
<form class='form-style-5'  action="<?= base_url(); ?>manager/project/insert_project" method="post">
    <h2>Add Project</h2>
    <hr />
    <!-- show error messages if the form validation fails -->
    <?php  if ($this->session->flashdata()) { ?>
        <div class="alert alert-danger">
            <?=$this->session->flashdata('errors'); ?>
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="name">Project Name</label>
        <input type="text" name="project_name" required class="form-control" id="company_name">
    </div>

    <div class="form-group">
        <label for="Start date">Start Date:</label>
        <input type="date" name="start_date" required class="form-control" id="start_date">
    </div>
	<div class="form-group">
        <label for="End Date">End Date</label>
        <input type="date" name="end_date" required class="form-control" id="end_date">
    </div>
	<div class="form-group">
        <label for="email">Deliverables:</label>
        <div class="field_wrapper">
    <div>
        <div class="form-group fieldGroup">
        <div class="input-group">
            <input type="text" name="deliverables[]" class="form-control" placeholder="Enter Deliverable name"/>
            <select name="developers[]">
                <?php foreach ($developers as $developer) {?>
                    <option value="<?php echo $developer->user_id?>"><?php echo $developer->full_name?></option>
                <?php
                }
                ?>
                
            </select>
            <div class="input-group-addon"> 
                <a style="width:70px" href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    </div>
</div>
    </div>
    <div>

    <input class="btn btn-primary"  type="submit" value="Add Project">
</div>
</form>
</div>
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
       <input type="text" name="deliverables[]" class="form-control" placeholder="Enter Deliverable name"/>
            <select name="developers[]">
                <?php foreach ($developers as $developer) {?>
                    <option value="<?php echo $developer->user_id;?>"><?php echo $developer->full_name?></option>
                <?php
                }
                ?>
                
            </select>
        <div class="input-group-addon"> 
            <a style="width:70px" href="javascript:void(0)" class="btn btn-danger remove"><span  class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
        </div>
    </div>
</div>
