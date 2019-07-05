<br />
 <div class="col-md-6 col-lg-6" style="margin-left: 20px;">
<form class='form-style-5'  action="<?= base_url(); ?>developer/Developer_profile/change_password" method="post">
    <h2>Change password</h2>
    <hr />
    <!-- show error messages if the form validation fails -->
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-danger">
            <?=$this->session->flashdata('errors'); ?>
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php }
    
     ?>
    <div class="form-group">
        <label for="name">Old password</label>
        <input type="password" name="old_password" required class="form-control">
    </div>

    <div class="form-group">
        <label for="email">New password</label>
        <input type="password" name="new_password" required class="form-control">
    </div>
     <div>

    <input class="btn btn-primary" type="submit" value="CHANGE PASSWORD">
</div>
	

</form>
</div>
