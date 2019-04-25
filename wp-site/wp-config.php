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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpressdb');

/** MySQL database username */
define('DB_USER', 'wpuser');

/** MySQL database password */
define('DB_PASSWORD', 'Password1');

/** MySQL hostname */
define('DB_HOST', 'database.sysopsdatabase.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(6!|^R>uTnQ|<hV5JwvK5jW{dDBn{mtDjgp.K2f)Quu0qGObW=<_+t&[ +o`Ni2F');
define('SECURE_AUTH_KEY',  'pqr<UQPE>m-9G&Xcf*f<=%rHw><*P@c_:rB>#9-|XXW]&&Y;1[Hpc}o,}G6gKzJD');
define('LOGGED_IN_KEY',    '1)=Id`HrHsh@8flVN91(jWOd}zz&o=*GFE)Qy6qWj@ 33@2QZ`&7r:V;,JE>(L*o');
define('NONCE_KEY',        'Vt0sy0$/J8Cwe0xcl{}P?03(ikHAQT>d6Q/ 3-7>gf|.g~-lLI9V^EE;e+k/qf3j');
define('AUTH_SALT',        '|[AxhfLPSyr<xpF*Lz{N8c@5Rf&>ZPRM58I)Dt-<hS>XQ$3%wj|F#8NK_`_J0c.0');
define('SECURE_AUTH_SALT', 'JBUf80h%~g:9w%+)vRi/691-81wa=FMfXx?xdRI<N7`)*ui.^ySome>E;I{D~t:t');
define('LOGGED_IN_SALT',   'JG5Ea,;5WQpryyoE(t}1C_!p%Z4C~e%.`obGIags!o7N0(Vf`HIHN@/E$yG234L$');
define('NONCE_SALT',       '>Q#%R=cDKJO$`]O&$vegeTp{|9_)tKOi4rmFr,ObY[&K:!3v*f:j9)0 I%pQb:?C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD','direct');
