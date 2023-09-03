#!/bin/bash

wp core update --allow-root
wp core update-db --allow-root
wp theme enable default --allow-root
wp plugin uninstall hello akismet --allow-root
wp theme delete twentysixteen twentyseventeen twentynineteen --allow-root
wp plugin install timber-library wp-content/themes/default/plugins/advanced-custom-fields-pro.zip wp-content/themes/default/plugins/wp-user-guide.zip onelogin-saml-sso disable-comments ga-google-analytics --activate --allow-root
wp plugin update --all --allow-root
