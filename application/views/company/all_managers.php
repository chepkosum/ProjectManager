<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>
<?php foreach($all_managers as $manager){?>
<div class="card">
  <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width:100%">
  <div class="container">
    <h4><b><?php echo $manager->full_name; ?></b></h4> 
    <p><strong>Email</strong>:: <?php echo $manager->email; ?></p> 
    <p><strong>Address</strong>::<?php echo $manager->address." ".$manager->postal_code." ".$manager->town; ?></p> 
    <p>
    	 <a href="<?php echo base_url() ?>company/manager/edit_manager/<?php echo $manager->user_id; ?>"class="btn btn-primary">Edit Project Manager</a>
         <a href="<?php echo base_url() ?>company/manager/delete_manager/<?php echo $manager->user_id; ?>" class="btn btn-primary">Delete Project Manager</a>
    </p>
  </div>
</div>
<?php 
}
?>
