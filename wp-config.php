<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache


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
define('DB_NAME', 'vjsloopc_wor12');

/** MySQL database username */
define('DB_USER', 'vjsloopc_509');

/** MySQL database password */
define('DB_PASSWORD', 'JQPfk17B');

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
define('AUTH_KEY', 'YT+f%K}JNV-iRxuFJOL|l<-^jbCFRA^r-%>S*{kB$N$$*fQ(_kaqwTl*CUsV=DskW&j&&lD-=Whl}J{K![?}D}%v=M_p?B$$!+h{>qcNL^IsaPdfXA-BaUUK]hH]fnL%');
define('SECURE_AUTH_KEY', 'z<lNF(LqB{zhqfUG=({sZ??cMWmvJqZU(/O]lUE?Bur!at!PPp|aEJmkeSng)+iTLGirdIfGAqbhJ(u?$(?WXQT@Wsv[=Xl;S{CS!VHGwS&H=T$XT>%T(&!S}%W}+w/)');
define('LOGGED_IN_KEY', 'x_n^G>bzO_[RlezhNotoPKw}i>N;lH|XlPQihWUITK&-sEDu=ev]EtsYjnG&&wJ>yH&mD+o>L;jtr[<?^oz>j>hN<^?SP&mGPEIonpz<n}]}^A]?$qJ+F?gs$lG|Yxo|');
define('NONCE_KEY', '{DIi/ezsJN}%;UJl^M%}etqS]N|O[ffu^);yEMf-z@{SMF<l<|VQXLW[LqJzsThM)D/NCynVcg{!ps%IfzcSO[;A@_ScmlfZWy!icisQ{RB&yhc{{vc_rb;T{/LbE|Gi');
define('AUTH_SALT', 'bzf!ErV(o%^SFb]d/bk)VEBOl]j@Y%!z||YvFje|AV|/CBLIcKLKcNiLxt]U*A_KqzisGftvMbv|?Z-d-$|%k;iQ!d=KEVM?X[B=J/KT(pD)|D=I_UAUh;oe@/h)%C-l');
define('SECURE_AUTH_SALT', 'fB&vic>WgJ>s?t@XSo-cCP|F_GHBN%<lUPP%{fKLipx*[mlzncK!JbFS%*rjv&^e*J&@zXS!q=WBs;/wRBa&(wcKjNsu@uhbrwos;Ojl(f|tC|gLrUEEw|YoOPZLg)|t');
define('LOGGED_IN_SALT', 'z^sRSOK_@dmsgl[+l{axJ}gawm^z{vGvP[aI^q[LU?%T(me]Dr@w{/s%bLZDoFvmdLB-)+VOqxWIouky{);cNJl^Y-EPGBLT^<UXNAxw{CUM[Z@j%BKs?bLjt[|GdgxK');
define('NONCE_SALT', '<zlHb=mUdv&ia=uEiZEBG%=BJF[&XLrY=&B)c)ykL*w{<+oNN_Rm&bPrx(&;xMDlbK(!;SAEa+>oFkpFiFHM}^TP>z!i)Gf{Gef&hVa?ooMEadJkV(R=|t[nPA?S|Z{{');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_higj_';

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
