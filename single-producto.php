<!--En la jerarquía wordpress, esta será la plantilla seleccionada para mostrar las entradas o posts o "los ejemplares" (Comillas nuestras) de la categoría (o term [también puede ser etiqueta]) creada. Esta plantilla en particular se diferencia de la single (en primer lugar) en que no contiene los enlaces de navegación inferiores-->

<?php get_header(); ?>
    <main class='container my-3'>
        <?php if(have_posts()){
            while(have_posts()){
                the_post();
                $taxonomy = get_the_terms(get_the_ID(), 'categoria-productos')               
                ?>
                <h1 class="my-3 text-center"><?php the_title();?></h1>
                <div class="row text-center">
                    <div class="col-md-6 col-12">
                        <?php the_post_thumbnail('large');?>
                    </div>
                    <div class="col-md-6 col-12">
                        <?php echo do_shortcode('[contact-form-7 id="45" title="Formulario de contacto 1"]')?>
                    </div>
                    <div class="col-12">
                        <?php the_content();?>
                    </div>
                </div>

                <!--Loop para visualizar productos relacionados-->
                <!--Array para filtrar resultados-->
                <?php  $args=array(
                    'post_type' => 'producto',
                    'posts_per_page' => 6,
                    'order' => 'ASC',
                    'order_by' => 'title',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categoria-productos',
                            'field' => 'slug',
                            'terms' => $taxonomy[0]->slug
                        )   
                    )
                );
                //Loop sobre los productos
                $productos=new WP_Query($args); //$productos como objeto
                if($productos->have_posts()){ //$productos como objeto al que le aplicamos el método have_posts()
                    ?>
                    <div class="row justify-content-center text-center my-5 productos-relacionados">
                        <div class="col-12">
                            <h3>Productos Relacionados</h3>
                        </div>
                        <?php 
                        while($productos->have_posts()){
                           $productos->the_post();
                           ?>
                           <div class="col-2 my-3 text-center">
                                <?php the_post_thumbnail('thumbnail') ?>
                                <h5>
                                    <a href="<? get_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                           </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
        }?>
    </main>

<?php get_footer(); ?>