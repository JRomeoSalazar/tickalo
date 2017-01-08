<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wordpress');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'wordpress');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '123456');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'Q-J#n;u&c:+Y}}[ZeR$6J-qjZ<p+Mv{:4CGw>e;/yy`32]n7|8`GGbA[hWEGYaCX');
define('SECURE_AUTH_KEY', '@Z1BI?_W&=2V7:X8&_88RUg7jAD%sG;-V9y@Q; Ns9jM@c=*qGkBIK+z&aBQ8@Ly');
define('LOGGED_IN_KEY', '~_/7{N-U_.rnDF=0*&*e40WN8HO^REB,zx{E:9@W7gkTD?C?t}8.>SIMa%l`xn.@');
define('NONCE_KEY', 'B?-`e7B{u9S`K{15E)5El}Y/%%T~y(%/RbzV_=?V|s|DM.9^01L?~EX>:D2#Y/q`');
define('AUTH_SALT', 'oEUtY6]G5eBN#<Xxr9`=yM|@Y&i/}R%Hu0A=-)6cr%Od?~Nu0r3?@#8-&{V/s%{l');
define('SECURE_AUTH_SALT', 'pk(hj-H $i(TJQv!rFX$szuEt$aYmW,PNqEJLNE+w^WS&uPZG<0OI]Xykuby~3Er');
define('LOGGED_IN_SALT', ')$t^9SR=1 &!!rK.>rxR>|vQOU[F)Y#DkuyV:]*2-,+KO$m[IOVvee{( Dya-CB1');
define('NONCE_SALT', 'r^N3bBk|*-W>TC8|e|r5x K1dtu#,3^~BF(H1.U8P)#(a).m(|gU}3;+zYVQEj=<');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

