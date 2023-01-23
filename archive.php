<!--No basta con crear una categoría. Para visualizarla dentro del sitio web, se hace necesario crear archive.php-->
<?php get_header(); ?>

<div class="container my-4">
    <div class="row">
        <div class="col-12 text-center">
            <h1><?php the_archive_title(); ?></h1> <!--Este será el nombre del term (Categoría o Etiqueta)-->
        </div>
        <!--Loop para los post del term-->
        <?php if(have_posts()){
            while(have_posts()){
                the_post();
                ?>
                <div class="col-4 text-center-single-archive">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large'); ?>
                        <h4><?php the_title(); ?></h4>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<!--Cada term categoría ya se incluye como opción para agregar al menú dentro de la opción 'Categorías' -->

<?php get_footer(); ?>