<br />
<form class='form-style-5'  action="<?= base_url(); ?>register/doRegister" method="post">
    <h2>Registration</h2>
    <hr />
    <!-- show error messages if the form validation fails -->
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-danger">
            <?=$this->session->flashdata('errors'); ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="name">Full Name:</label>
        <input type="text" name="full_name" required class="form-control" id="full_name">
    </div>

    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" name="email" required class="form-control" id="email">
    </div>
	<div class="form-group">
        <label for="adderss">Address</label>
        <input type="text" name="address" required class="form-control" id="address">
    </div>
	<div class="form-group">
        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" required class="form-control" id="postal_code">
    </div>
	<div class="form-group">
        <label for="email">Town:</label>
        <input type="text" name="town" required class="form-control" id="town">
    </div>
	<div class="form-group">
        <label for="email">Username:</label>
        <input type="text" name="username" required class="form-control" id="username">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" required class="form-control" id="pwd">
    </div>
    <div>

    <input type="submit" value="Register">
    <span class="log"><a href="<?= base_url() . 'login'; ?>" class="btn btn-primary">Already Registered,Login</a></span>
</div>
</form>
