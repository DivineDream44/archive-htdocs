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
define( 'DB_NAME', 'ezyro_41293680_bd_wp' );

/** Database username */
define( 'DB_USER', 'ezyro_41293680' );

/** Database password */
define( 'DB_PASSWORD', '1bd1852898a' );

/** Database hostname */
define( 'DB_HOST', 'sql303.ezyro.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'J7_nCs8`G~3:WVX>*.r|WvKwe_L#0<NdX{$*CKun>-%DNqtaK^E.a6VUv^%+OJ50' );
define( 'SECURE_AUTH_KEY',  '9Jme^{~_iN~0r0{LxAn]8}d_PWGj/t]NtRDZYsm)sw~,i,KZHJ/4j^Td7o@gCU x' );
define( 'LOGGED_IN_KEY',    'B#9{H3QN[ygdf1tS+qnIIn(kED(6;;,!3^S.jQyo4XY@Ay/lQ~UwHf}u=y|MG6ko' );
define( 'NONCE_KEY',        'dfM5I]$5g%XP;We&Mo7.Tb!)n<XqTks/pE};A3U=[6nG[,hLjtS.-- x1N.c}:FT' );
define( 'AUTH_SALT',        'UIsIL5{!5Q1YD&bb,LL4>FwHm=e1`2]Pgx? hLoJ?*-?;!9tZTaLuYvh!/wYvRjO' );
define( 'SECURE_AUTH_SALT', 'W;GCmq=ITmvMu)W*qSA0u5a;0NA9jM3A4z3CF(<Ui=AxQC}|cn(b+/9{yF1Wk$7n' );
define( 'LOGGED_IN_SALT',   'g>=uuSHMH`IPh.0DflL9n~ F<&}fN4Cm`^C#uLqxWZ6!=SFQgFxh4-;OQI<E*}7B' );
define( 'NONCE_SALT',       'IA<k1VJcvYa&CYgjpD5a4GE2]8CKn5*e<sqk{kw+2<]Ph,QW6c[Er5p{b~f} CE{' );

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
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
