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
define( 'DB_NAME', 'wpblog' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'GA*`6iaVYpb1L@oD4(B1p#se[cD|yyNSnfZM&@{j.&uY*tK& 8 7zvWPrp.j_IPk' );
define( 'SECURE_AUTH_KEY',  '^owKN(`zNJFz[*XjR-Wk=$;+Mj;->Fc!h^]E:p{GJ!a !PViO9}Cx+DiLNx@U5Sz' );
define( 'LOGGED_IN_KEY',    'AK`ea&kHCHj}^-gGA,F;OfnLHBJF8S]!|&l7v=Jsw+S`z1ao8&Sw}M%ERD>)7~vj' );
define( 'NONCE_KEY',        'XUhankWKFGv&$]iGyQ8C,8Az33/ K[}8KXj({$&F4v|+$Z.T-rD1-fO/ s2OC;,[' );
define( 'AUTH_SALT',        '<$d$` CJI%RlfH1jxjX8M-8<Vl>#^TGf%Ey8q!R$Xh@m.=Jae6L%$IR5+EG;rPx}' );
define( 'SECURE_AUTH_SALT', 'o Lj=Qtr5b3Y.#zb(]awc]#g`0RZyWw]rcWE|xdVB$8=>a@.8FG768,9^ymlJGR2' );
define( 'LOGGED_IN_SALT',   'L}lzG:4~u#hSgY(s=p-aq|Ud[_QsrjDfPK;Ra,17mh.|x(h]%~od|nd7Vtn8~bzN' );
define( 'NONCE_SALT',       '(4F*WOr =./^g2esl%CjBbZ9BY[3j?H:Yi5bg!5ta&#zNDN<osy Y4X&vkp_<hfu' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
