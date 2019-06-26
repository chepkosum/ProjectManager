<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
<?php foreach($all_projects as $project){?>
<div class="card">
  <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width:100%">
  <div class="container">
    <h4><b><?php echo $project->project_name; ?></b></h4> 
    <p><strong>Start Date</strong>::<?php echo $project->start_date; ?></p>
    <p><strong>End Date</strong><?php echo $project->end_date; ?></p>
    <p><strong>Project Manager Name</strong><?php echo $project->manager; ?></p>
    <p><strong>Deliverables</strong>::<?php echo $project->deliverables; ?></p> 
    <p>
    	 <a href="<?php echo base_url() ?>project/edit_project/<?php echo $company->project_id; ?>"class="btn btn-primary">Edit Project</a>
         <a href="<?php echo base_url() ?>project/delete_project/<?php echo $company->project_id; ?>" class="btn btn-primary">Delete Project</a>
    </p>
  </div>
</div>
<?php 
}
?>
