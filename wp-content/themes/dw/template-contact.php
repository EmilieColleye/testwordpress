<?php /* Template Name: Contact page template */ ?>
<?php get_header()?>
<?php if(have_posts()):while (have_posts()): the_post();?>
    <main class="layout singleContact">
        <h2 class="singleContact__title"><?= get_the_title()?></h2>
        <div class="singleContact__content">
            <?= get_the_content()?>
        </div>
        <div class="contact__form">
            <?= apply_filters('the_content', '[contact-form-7 id="39" title="Contactez moi"]')?>
        </div>
    </main>
<?php endwhile; endif;?>
<?php get_footer()?>