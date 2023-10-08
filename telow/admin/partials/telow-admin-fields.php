<?php 
$telow_account = get_option('telow_account');

?>
<h4>Instance ID</h4>
<small style="display: block; margin-bottom: 5px">For Telow to track bugs, you must enter your Instance ID. This information is in your Telow Instance.</small>
<input type="text" name="telow_account" value="<?php echo $telow_account;?>" id="telow_licence_field"><br>