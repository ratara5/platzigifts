<!--Establecer página de inicio, primero 1. CREAR una página  2. Ir a Ajustes/Ajustes de lectura y marcar 'Una página estática' en 'Tu página de inicio muestra'-->
<?php get_header(); ?>

<main class='container'>
    <?php if(have_posts()){
        while(have_posts()){
            the_post();
            ?>
            <h1 class='my-3'><?php the_title(); ?>!!</h1>
            <?php the_content(); ?>
            <?php
        }
    }?>

    <!--Custom loop para listar las entradas del custom post type-->
    <div class="lista-productos my-5">
        <h2 class='text-center'>PRODUCTOS</h2>

        <div class="row my-3">
            <div class="col-12">
                <select class="form-control" name="categorias-productos" id="categorias-productos">
                    <option value="">Todas las categorías</option>
                    <?php
                    $terms=get_terms('categoria-productos',array('hide_empty'=>true));
                    foreach($terms as $term){
                        echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <!--Custom loop para el custom post type-->
        <div id="resultado-productos" class="row">
            <?php
            $args=array(
                'post_type' => 'producto',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            );
            $productos = new WP_Query($args);
            if($productos->have_posts()){
                while($productos->have_posts()){
                    $productos->the_post();
                    ?>
                    <div class="col-md-4 col-12 my-3">
                        <figure>
                            <?php the_post_thumbnail('large'); ?>
                        </figure>
                        <h4 class='my-3 text-center'>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>    
                            </a>
                        </h4>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>