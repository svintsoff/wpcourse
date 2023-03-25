<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title('«', true, 'right'); ?><?php bloginfo('name') ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="wrapper">
        <header>
            <a href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt=""></a>
            <?php wp_nav_menu(array('menu' => 'top-menu', 'menu_class' => 'top-menu')); ?>
            <a href="/talk" class="talk">LET'S TALK</a>
        </header>