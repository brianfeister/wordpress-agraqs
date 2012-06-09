<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'amalaraqs.com');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         't1=HIF,a]+z);s`oLZkm7;+U=KUXNH5_;+uUq)v-D:`%b>p({Tou4p~yl2<v=n#_');
define('SECURE_AUTH_KEY',  '[LA4F6o+D4YC/GYf~5q+%?roU3ll@9T4`f/79;:zawE!=7k.}dJi.T/;iXNS<0On');
define('LOGGED_IN_KEY',    '7twMsze@{G9k2NyQ.csVOB1f^ds][w`c-M.1-#XO?QVwiA./C)dQK:U5B|J`UFx*');
define('NONCE_KEY',        '||SVvxjCn%Izk$|Eg<>+<kbST90##-tj0]W$hjvyV0U;He/8[0pLiA> $?v54T,d');
define('AUTH_SALT',        'B~Zg&mB5x!+sPk~u=4>-xz3<b?~ZTQchrC/Hu^v0}UA)c1p.xN0-]5rU8Yej%%Sl');
define('SECURE_AUTH_SALT', '+I3Ot/0N[4Ib=GDO7;MLu/CF{D+nJjHGEetik|amSZYIOZrP>IAd@WW}_Mp E42t');
define('LOGGED_IN_SALT',   '8i,Ep[<f|R TkvW!_Le=]RdV+Y-]~y-dl5mR17MG+MPVN1$N.F1hC!;khL9Ef$^9');
define('NONCE_SALT',       ',t_cKR4(wm5u!w} xs|V([3F-0-F=%EX ,A5&MQ)<L@P<-sU}VHz/6HwKT}@rf<4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
