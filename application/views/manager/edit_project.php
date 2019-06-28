<br />
<?php extract($project);
 ?>
<form class='form-style-5'  action="<?= base_url(); ?>manager/project/update_project/<?php echo $project_id; ?>" method="post">
    <h2>Edit Company</h2>
    <hr />
    <!-- show error messages if the form validation fails -->
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-danger">
            <?=$this->session->flashdata('errors'); ?>
        </div>
    <?php }
    
     ?>
    <div class="form-group">
        <label for="name">Project Name</label>
        <input type="text" name="project_name" required class="form-control" value="<?php echo $project_name;?>" id="company_name">
    </div>

    <div class="form-group">
        <label for="email">Start Date</label>
        <input type="date" name="start_date" required class="form-control" id="email" value="<?php echo $start_date;?>">
    </div>
	<div class="form-group">
        <label for="postal_code">End Date:</label>
        <input type="text" name="end_date" required class="form-control" id="end_date" value="<?php echo $end_date;?>">
    </div>
	<div class="form-group">
        <label for="deliverables">Deliverables</label>
        <input type="text" name="town" required class="form-control" id="deliverables" value="<?php echo $deliverables;?>">
    </div>
    <div>

    <input class="btn btn-primary" type="submit" value="Update">
</div>
</form>
