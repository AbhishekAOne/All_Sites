<?php
define('WP_CACHE', true); // Added by WP Rocket


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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kronosb1_4b9' );

/** MySQL database username */
define( 'DB_USER', 'kronosb1_4b9' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ECFB3D61Agm2h5k4yv8p7ex9' );

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
define( 'AUTH_KEY',          'cW|{F*aI3nFQcL PaeQ~r)!O0[t$Zlzdkn4E>P&mL%4B,emJ~:vs7cmwUxQ^a<Up' );
define( 'SECURE_AUTH_KEY',   ';a&OQ%$~U<1%2a;CjPNOvWpbqf`rTeTz>Z34Eynn~;@P%), z:i(n_u}(}B8snAd' );
define( 'LOGGED_IN_KEY',     '(bYDIw^z#Gv,Rsok>]x_<{R.?ezT%q94][o/=~Hq:{$9`BHJ.dMWepAdv|o[wroK' );
define( 'NONCE_KEY',         '!<5Z{@z.Jr%^5_HHD[[/],/XxBbEX}Y!h:*+]DKDTvc/l>6{eR^H7/l|ljl03:E:' );
define( 'AUTH_SALT',         'GE<N:Uey_66}s9JyYab~Utl{3M@Pq,72<z%wyX_H0]>xw|Ocu=X3vdz*q-_Z-4ma' );
define( 'SECURE_AUTH_SALT',  'AL~Fzdf XMQ%h_3{yv(!j*/_RErwGv|n$X)PwlTOJ1{3<Hi`V)t$}$/#}Cf)|+HD' );
define( 'LOGGED_IN_SALT',    'A1T&@})Z$M69tcQw:-F5upI<LfK>i.bmsFZ`TWI2AV~5}i:aCGmt<J<wl1L|-.y-' );
define( 'NONCE_SALT',        'U /P4FDtH@t`tW0(7I[O?fb@N2x/@KVjxDrK9Y@k7pZyBHb3SS8HM|pWk_WcQ1+9' );
define( 'WP_CACHE_KEY_SALT', '#D>Oi]VI@GX]W[J7Z/W0as,T|rd$-0[gFPH@#E&Mk_.tL=.b^0~Aj#yl@k5dIirW' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '4b9_';



define( 'AUTOSAVE_INTERVAL',    300  );
define( 'WP_POST_REVISIONS',    5    );
define( 'EMPTY_TRASH_DAYS',     7    );
define( 'WP_AUTO_UPDATE_CORE',  true );
define( 'WP_CRON_LOCK_TIMEOUT', 120  );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
