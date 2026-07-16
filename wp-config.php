<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gulshan');
define('DB_USER', 'gulshan');
define('DB_PASSWORD', 'nDQ5i66kVKORJkKmKmZC');
define('DB_HOST', 'wordpress-gulshan-ne37gp');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '65rsfw6ma5a3isej2o12umhymqf1xlxxzeetrfqwnj3szzzd6fb5xno4riv1i3vq' );
define( 'SECURE_AUTH_KEY',  'ccoluikesfuok3a1s92ueihu907pxzv9sqylcrmv8pvplgfovyslvpgkcgevjfk3' );
define( 'LOGGED_IN_KEY',    'woxaiiseffywzpc7er0htum0siyizqmhampcesnhl1prlhfem4917m95fprb7zds' );
define( 'NONCE_KEY',        'czsqeukqc2myvxr2nhozcgx8i4hmjdfbvi2ukio99xtbuqnuihjkbpazqgouvlpv' );
define( 'AUTH_SALT',        'm5immff3pcepc66ejezyetzjwxwdd8815su23runh4dixxicax2m8uikzunp3e8c' );
define( 'SECURE_AUTH_SALT', 'z3yy75zemyu90umgjglhfilmplnqcbolrfrhncao1gbvmenagafvisvxstrjjzha' );
define( 'LOGGED_IN_SALT',   'squq61a9ppw7savyeb1vk8ycrmpjsplhnmrzqdg2704a5xm3xmuuaxuod2ux5yqw' );
define( 'NONCE_SALT',       '0zmfr5ixrkjwbzi7djkkq0jfvgmhxezcrcows5xr26bl4fyc3najrcmqe9fswcfo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wpgl_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

define( 'WP_AUTO_UPDATE_CORE', 'minor' );

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


/* Add any custom values between this line and the "stop editing" line. */

if (
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'
) {
    $_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */
