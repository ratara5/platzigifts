<!--Setear vista para la página. Vista de posttype página-->
<?php get_header(); ?>

<main class='container'> <!--La clase container sirve para alinear header, contenido y footer (cada una de estas secciones tiene dicha clase)-->
    <?php if(have_posts()){
        while(have_posts()){
            the_post();?>
            <h1 class='my-3'><?php the_title();?></h1>
            <?php the_content();?>
        <?php
        }
    }?> 
</main>

<?php get_footer(); ?>