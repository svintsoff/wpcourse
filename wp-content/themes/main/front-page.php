<?php get_header(); ?>
    <section class="title">
        <h1 class="title__main"><?php bloginfo('name') ?></h1>
        <p class="title__desc"><?php bloginfo('description') ?></p>
        <div class="title__add">
            <p>Available for freelance work</p>
            <img src="/wp-content/uploads/2023/03/scroll.png" alt="">
        </div>
    </section>
    <section class="blocks">
        <?php
            global $post;

            $myposts = get_posts([
                'numberposts' => -1,
                'category_name' => "blocks"
            ]);

            if ($myposts) {
                foreach ($myposts as $post) {
                    setup_postdata($post);
        ?>

            <div class="blocks__block">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
                <div class="block__links">
                    <?php the_tags("", "", ""); ?>
                </div>
            </div>

        <?php }} wp_reset_postdata(); ?>
    </section>

    <?php
        global $post;

        $myposts = get_posts([
            'numberposts' => -1,
            'category_name' => "cases"
        ]);

        if ($myposts) {
            foreach ($myposts as $post) {
                setup_postdata($post);
    ?>
    <section class="case">
        <div class="case__info">
            <div class="info__upside">
                <p class="upside__cat">CASE STUDY</p>
                <p class="upside__title"><?php the_title(); ?></p>
                <div class="upside__cats">
                    <?php the_tags("", "", ""); ?>
                </div>
            </div>
            <div class="info__downside">
                <?php the_content(); ?>
                <?php the_shortlink("SEE CASE STUDY"); ?>
            </div>
        </div>
        <img src="/wp-content/uploads/2023/03/korba.png" alt="">
    </section>

    <?php }} wp_reset_postdata(); ?>
<?php get_footer(); ?>