<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\nofilter\wp-content\plugins\wp-super-cache/' );
define('DB_NAME', 'nofilter');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xUB0.SGm+F|0kW.*&1qAf248_gv%~GxOsp$PedcxHAsnI4Io,GZr6(.`e&H2&{rO');
define('SECURE_AUTH_KEY',  '~x(F)7cI&(?v$8drk8:NR`ZvUFouipu*[*C=1o9kp:^[QJwz[_]}av24t7s8o53x');
define('LOGGED_IN_KEY',    'E6MwQ&!Eci,&|(+,*D4?vjy@8$A|4IG{:C0HvvWakZb@tnVF*8B8Mnvo&CukIXDx');
define('NONCE_KEY',        'hAxEgR<*dy+{H&9V^d4#*MuKlSUc`UQ+x?4gq9Oi-;?S).0Xm81rYt|[NI1$lM`.');
define('AUTH_SALT',        'P9.,B0glk^[F=MTR:f4YZUz->Zevw]L]WLHfySJj_^Ht,eY75d.,Ph.s^S#[Y)22');
define('SECURE_AUTH_SALT', '2K?-_R<LEVYL,qLnD?AB5hjVU>C>R(0_2~%xB}t_$gcS@SxZ,-_HwIFWB9ig]Gj?');
define('LOGGED_IN_SALT',   'Oo{D6f=J6peT1d){47[Bf4i [iAjx1 `FeZ+s-grjqP(CKxx28F,`g|n{?tiBc;X');
define('NONCE_SALT',       'IYSVxto`[c^&f$KEfyfe)p?Xx20f j9a/+vX~*F1Mzrn2@zdYHvQW?K[e?yRCVwa');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');