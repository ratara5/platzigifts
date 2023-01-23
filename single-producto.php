<!--En la jerarquía wordpress, esta será la plantilla seleccionada para mostrar las entradas o posts o "los ejemplares" (Comillas nuestras) de la categoría (o taxonomía [también puede ser etiqueta]) creada. Esta plantilla en particular se diferencia de la single (en primer lugar) en que no contiene los enlaces de navegación inferiores-->

<?php get_header(); ?>
    <main class='container my-3'>
        <?php if(have_posts()){
            while(have_posts()){
                the_post();
                $taxonomy = get_the_terms(get_the_ID(), 'categoria-productos') //Obtener todos los términos de las taxonomía 'categoria-productos' [El slug, no el nombre]] donde está el post               
                ?>
                <h1 class="my-3 text-center"><?php the_title();?></h1>
                <div class="row text-center">
                    <div class="col-md-6 col-12">
                        <?php the_post_thumbnail('large');?>
                    </div>
                    <div class="col-md-6 col-12">
                        <?php echo do_shortcode('[contact-form-7 id="45" title="Formulario de contacto 1"]')?> <!--Escrito el fragmento de invocación de código (shortcode) para un formulario de contacto que se envíe por correo. Este shortcode, se creó al crear el formulario de contacto con el Plugin Contact Form 7. También es necesario instalar el plugin Contact Form 7 Database Addon-->
                        <!--Si se envía un mensaje, pues aparece el mensaje 'Gracias por tu mensaje. Ha sido enviado' en la página. No obstante, si se va al MailHog [que intercepta todas las peticiones de correo], se ve que llegó un correo pero sin contenido. Esto es por que a parte de crear el Formulario hay que configurar el correo electrónico con el contenido [con los tags usados en la creación del formulario] -->
                        <!--Instalar y Activar el Plugin Easy WP SMTP-->
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
                //en 'tax_query' se pueden efectuar consultas para múltiples taxonomías y condiciones, se puede hacer con más arrays(?)
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
                                    <a href="<? the_permalink(); ?>">
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