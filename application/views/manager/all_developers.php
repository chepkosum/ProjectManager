<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>
<?php foreach($all_developers as $developer){?>
<div class="record">
  <img src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width:100%">
  <div class="container1">
    <h4><b><?php echo $developer->full_name; ?></b></h4> 
    <p><strong>Email</strong>:: <?php echo $developer->email; ?></p> 
    <p><strong>Address</strong>::<?php echo $developer->address." ".$developer->postal_code." ".$developer->town; ?></p> 
    <p>
    	 <a href="<?php echo base_url() ?>manager/developer/edit_manager/<?php echo $developer->user_id; ?>"class="btn btn-primary">Edit Project Developer</a>
         <a href="<?php echo base_url() ?>manager/developer/delete_manager/<?php echo $developer->user_id; ?>" class="btn btn-primary">Delete Project Developer</a>
    </p>
  </div>
</div>
<?php 
}
?>
