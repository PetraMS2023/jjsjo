<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u780943782_GcbiW' );

/** Database username */
define( 'DB_USER', 'u780943782_BMkg5' );

/** Database password */
define( 'DB_PASSWORD', 'zezUsSy2oL' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '!:w25jby}1h,dMs m+vy]d`}os,+t@l6NAx/$zhc43Xtk$:J:0lAds)%Y|j:faJK' );
define( 'SECURE_AUTH_KEY',   '&|c31)vr[&ddPvIA6, $lLYs- M2VKmKJ^5OB<NDoPS]Zz>(ijxw*jrN{SpK6yxQ' );
define( 'LOGGED_IN_KEY',     'E^h%iWH>iCMM0MUSpiTx6o+Do@0~La+Lz[6k[%.:J_VULTs}h1%^tFWZVtBM1QuI' );
define( 'NONCE_KEY',         'Yl}Sy332|1XRu*$T(c7/@}_4=Wk7+td.I#:Cl1%<v2.vjMzT1DWS>e0,@2hub!>4' );
define( 'AUTH_SALT',         'q.zh;:E%T~4lU8e|%~?bf5~zcd:f7vtB^GF6z$tCn!BP;qP(I1]Doc#I@Ik.Nae/' );
define( 'SECURE_AUTH_SALT',  'meG`H$D:xHr7r*IH;9%M6ofk/G.a%#B@OAuN]afqxoBn`q~7adx2eqUb[Kn?EpQ5' );
define( 'LOGGED_IN_SALT',    'd/bPL[`^AZ0FRMXJlLr!aALurd6P?RkXv@i(*0MVS=;^~5X5E*[8IcqZ[XKb$d~j' );
define( 'NONCE_SALT',        'UCnb<oS{*95]%Y~/{ch9*l_31Gg<XNP0YY7!D.H}FO)?YJIotP^di~~7HggM<kw{' );
define( 'WP_CACHE_KEY_SALT', ', .Dt?/2# TLv/&83](8fuRhT2Pf7|2BLqvqgRNA;/G0f)G#X_j:Y/d1Z^KZwdy-' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
