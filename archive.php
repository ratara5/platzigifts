<!--No basta con crear una categoría. Para visualizarla dentro del sitio web, se hace necesario crear archive.php-->
<!--Aunque se puedan crear templates para las taxnomías lo más común es usar el mismo archive.php-->

<!--Comentario personal:
            PostType: Post (Entrada)
                Taxonomia: Categorías
                        Term: Novedades
                            Posts: Novedad 1, Novedad 2, Novedad 3
                        Term: Uncathegorized
                            Posts: Hello world!
            PostType:
                Taxonomia: Etiquetas
                    Terms:  
                        Posts:
            PostType: Producto
            Taxonomia: Categorías de Productos
                    Term: Indumentaria
                        Posts: Camiseta, Buzo
                    Term: Souvenirs
                        Posts: Pin, Taza-->
<?php get_header(); ?>

<div class="container my-4">
    <div class="row">
        <div class="col-12 text-center">
            <h1><?php the_archive_title(); ?></h1> <!--Este será el nombre de la taxonomía (Categoría o Etiqueta o Categorías de Productos)-->
        </div>
        <!--Loop para los post de la taxonomía-->
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
<!--Cada taxonomía categoría ya se incluye como opción para agregar al menú dentro de la opción 'Categorías' -->

<?php get_footer(); ?>