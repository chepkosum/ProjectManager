<br >
<div class="col-md-6 col-lg-6" style="margin-left: 20px;">
<?php
     extract($user);
?>
<h1> Hello,<?php echo $email;?><br> ,Enter username and password to activate your account</h1>
<form class="form-style-5" action="<?= base_url(); ?>activate/credentials/<?php echo $activation_key;?>" method="post">
    <h2></h2>
    <hr />
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="email">Username:</label>
        <input type="text" name="username" required class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" required class="form-control" id="pwd">
    </div>
    <span> <button class="btn btn-primary" type="submit">Submit</button></span>
</form>
</div>
