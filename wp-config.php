<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'FGQJ qrM,+=$3kENhaYo5Onh0X}Tq6 =KCwtlMNQK[(@jjb28MDI}g*el]M6FY>,' );
define( 'SECURE_AUTH_KEY',  'N]K[J~$UJzVCB=!VersgT9|O)<{l^o%tgeAK6,0b5L/$%%9@tN{JsvoWHOWd8PBV' );
define( 'LOGGED_IN_KEY',    'ft.6n}axPIYDiK5LJ~W!BP)nYQ1C-NfiVxwk9f/3fnf99IkkJLDb:j1#gqi,ooEQ' );
define( 'NONCE_KEY',        '||h[rOOcZw9l![t4m}HHmo,AZ6z`.PIhm#XgJH6U3B_X*Wb]WuHu/b!g}%%-5nt)' );
define( 'AUTH_SALT',        'qe6=d.H&s$443ouZ`ib0c?^Nd<!@`(E&^/hD/9pH81tej*:6r<,khew&H*+y7%i[' );
define( 'SECURE_AUTH_SALT', 'POUXgtsY%`5psJV^>06;h36e5Hr(PIs!fmO*g[Vg,c=4*4w6b!H4}jq}=;iRI8nu' );
define( 'LOGGED_IN_SALT',   'l94,p%Fkp_<HZ:g?|rRQ~B:I`2 IEr-M)33gNXrB|<7,y:d_8[kTvR1Cqn]W,b65' );
define( 'NONCE_SALT',       'Jt@Bw$t7-OAdxu@+w0v+AeJd?0h/[Ls]LREF{N}B~%zSu2A>C(LYVJpSW-3ZJo](' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
