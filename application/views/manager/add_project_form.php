<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="deliverables[]" value=""/><a href="javascript:void(0);" class="remove_button">remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<br />
<div class="col-md-6 col-lg-6" style="margin-left: 20px;">
<form class='form-style-5'  action="<?= base_url(); ?>manager/project/insert_project" method="post">
    <h2>Add Project</h2>
    <hr />
    <!-- show error messages if the form validation fails -->
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-danger">
            <?=$this->session->flashdata('errors'); ?>
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
        <input type="text" name="deliverables[]" value=""/>
        <a href="javascript:void(0);" class="add_button" title="Add field">ADD</a>
    </div>
</div>
    </div>
    <div>

    <input class="btn btn-primary"  type="submit" value="Add Project">
</div>
</form>
</div>
