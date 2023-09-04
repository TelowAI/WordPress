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
    <h1>Telow</h1>
    <form action="options.php" method="post" novalidation="novalidation">
        <?php settings_fields('telow') ?>
        <?php do_settings_fields('telow', 'default')?>
        <?php submit_button(); ?>
    </form>
</div>