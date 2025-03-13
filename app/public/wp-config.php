<?php
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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'U-~lpbERn:ZlcjWa!iB0qC!]%!f2,1 c;/b(=-;[BSX/Hw)J}+bwsD|A0ZX99`x,' );
define( 'SECURE_AUTH_KEY',   '3zs4|b7i[URr%Vv+g%EiHlEovH=*7R&_lAn!=??eS}#u}6.,rb)Py$~h_CTkr2#q' );
define( 'LOGGED_IN_KEY',     'gCKCDO]t4u~VucPu7-wmy6;|SYuY eGcZR>K;gs~-p?EMBYC#vQL_iG+hm(-joL0' );
define( 'NONCE_KEY',         ':|C#Zn0DkB#Q@ kB//_Dm}TKeMAwXC=oyb #Gl@Hvkc_V^lU(<B16z?#&%LRc{K@' );
define( 'AUTH_SALT',         '{A)&!2Nm>;yA0HS;):#<>3@|Az{kLPt[C|Pijva Ad U+R/1h*U1/_HaE,*d.JWq' );
define( 'SECURE_AUTH_SALT',  '1WurmyuY|Sa+Eq:JMFI>fq}WCg/y98Z=DeeSh};.N|25)UK8C^c&2j@.75N-w|SZ' );
define( 'LOGGED_IN_SALT',    'Ow.NJr2<WSY%XwK0Ria_BuG@B!%_@&8YPXek{8Gk]C@o=u9*{&Ak0g!}8S7]S?l9' );
define( 'NONCE_SALT',        'Fb_qqR(qCf?H!rv}n+F1<|^%1LOZ9a40g4ja>=-5`9 9x$JN*8B`lOu[m5&CDe,0' );
define( 'WP_CACHE_KEY_SALT', 'N[G;$/P6L,}iTLXh[L YNB`!5=Q2HB1vfvqo|.z%Hlpl}XJ^%XS)EG=g~wIIp@Vj' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
define( 'WP_DEVELOPMENT_MODE', 'theme' );

define( 'DUPLICATOR_AUTH_KEY', 'jzOgT?HXgIdo%BJ>iT?/1I0hq6*,_*h[}DNE(:+`c)^^ULmy3fK.Z;?txC*[bG$S' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
