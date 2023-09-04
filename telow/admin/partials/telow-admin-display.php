<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://telow.com
 * @since      1.0.0
 *
 * @package    Telow
 * @subpackage Telow/admin/partials
 */
?>

<div class="wrap">
    <a href="https://telow.com" target="_blank">
        <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/logo.svg'; ?>" width="180px"  alt="Telow Logo">
    </a>
    <form action="options.php" method="post" novalidation="novalidation">
        <?php settings_fields('telow') ?>
        <?php do_settings_fields('telow', 'default')?>
        <?php submit_button(); ?>
    </form>
</div>