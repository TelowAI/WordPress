<?php 
$telow_account = get_option('telow_account');

?>
<h4>Account ID</h4>
<small style="display: block; margin-bottom: 5px">For Telow to track bugs, you must enter your Account ID. This information is in your Telow dashboard.</small>
<input type="text" name="telow_account" value="<?php echo $telow_account;?>" id="telow_licence_field"><br>