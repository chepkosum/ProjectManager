<br />
<div class="col-md-6 col-lg-6" style="margin-left: 20px;">
<form class='form-style-5'  action="<?= base_url(); ?>company/project/insert_project" method="post">
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
        <label for="owner">Project Owner</label>
        <input type="date" name="owner" required class="form-control" id="owner">
    </div>
	<div class="form-group">
        <label for="manager">Project Manager</label>
        <select class="form-control" name="manager">
            <?php foreach($manager as $manager) {?>
                 <option value="<?php echo $manager->full_name;?>"><?php echo $manager->full_name;?></option>
           <?php
            }
            ?>
           
        </select>
    </div>
	<div class="form-group">
        <label for="email">Deliverables:</label>
        <textarea class="form-control" rows="5" id="deliverables" required></textarea>
    </div>
    <div>

    <input class="btn btn-primary" type="submit" value="Add Project">
</div>
</form>
</div>
