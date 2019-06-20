<br />
<?php extract($company);
 ?>
<form class='form-style-5'  action="<?= base_url(); ?>ari/update_company/<?php echo $company_id; ?>" method="post">
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
        <label for="name">Company Name</label>
        <input type="text" name="company_name" required class="form-control" value="<?php echo $company_name;?>" id="company_name">
    </div>

    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" name="email" required class="form-control" id="email" value="<?php echo $email;?>">
    </div>
	<div class="form-group">
        <label for="adderss">Address</label>
        <input type="text" name="address" required class="form-control" id="address" value="<?php echo $address;?>">
    </div>
	<div class="form-group">
        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" required class="form-control" id="postal_code" value="<?php echo $postal_code;?>">
    </div>
	<div class="form-group">
        <label for="email">Town:</label>
        <input type="text" name="town" required class="form-control" id="town" value="town">
    </div>
    <div>

    <input class="btn btn-primary" type="submit" value="Update">
</div>
</form>
