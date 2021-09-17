<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'FbPxp9xw5geA5LkLdYjluJsQ6707c7H5gXQAp6G2d0cXgF8/nW26CmEjeXt+PqLz47A38PPyhiCNIga44YhhMg==');
define('SECURE_AUTH_KEY',  '8/fsIpW5S0QEUkoMN9bovl+bEHlGfLqIJOpzHumOenxGBNDGEh7MRxtF3oibmdmxXWuss5+BqQhfvgwZdSz9Ng==');
define('LOGGED_IN_KEY',    'Hdl9005AjzJptoqQuDsFCu3BMmJ+pk+Ncp7KY+WHE4q795dhxCO0K8rgHIc7Wmkc4WHMpKLME7MT8/dahlUmWA==');
define('NONCE_KEY',        '27rVswABaR7lv5xwaGUvmn0B3lyqg+PEXjSzWDIN3OYvWl2U3Pt+X52wCiz/AYjCsiOpgaJ+MzzzAvLCjcYuCg==');
define('AUTH_SALT',        'pW3M0aLSkh8CAbW1Cc1dNc6rMmRJajDzVDt1TYL50Ke+Yv2Tck6CkJQsatcAmAEcq33cZ2UmHyK/SDQxaEojFw==');
define('SECURE_AUTH_SALT', 'LIQ2qNKAgvfz4ZL+f1CJK6FUY07Kff6nn57l99FYqbrAuTENs/cWJ0Keptzcvcry5iAzffPrBlzId7QOOMoeJw==');
define('LOGGED_IN_SALT',   'rdtUbqv2enB0ETI7rzqLR1VfY8KbHIRrq4A35Zy6r921pTX8cSIoGCAsDVaD9T+ui/JTJAMYw4OAndj1m//JnA==');
define('NONCE_SALT',       'YuXHOFVUPDyYSsSEaWNoVuXFfyiDc3QU3CkiKJZzEy7W6x7qhVEExeuZGASTmPpDN/gsxTvwsijiXnmHkV3k2g==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
