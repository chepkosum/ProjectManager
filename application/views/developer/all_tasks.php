<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
<?php foreach($all_tasks as $task){?>
<div class="card">
  <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width:100%">
  <div class="container">
    <h4><b><?php echo $task->task_name; ?></b></h4> 
    <p><strong>Start Date</strong>::<?php echo $task->start_date; ?></p>
    <p><strong>End Date</strong><?php echo $task->end_date; ?></p> 
    <p>
    	 <a href="<?php echo base_url() ?>project/edit_project/<?php echo $company->project_id; ?>"class="btn btn-primary">Edit Project</a>
         <a href="<?php echo base_url() ?>project/delete_project/<?php echo $company->project_id; ?>" class="btn btn-primary">Delete Project</a>
    </p>
  </div>
</div>
<?php 
}
?>
