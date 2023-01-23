<!--Setear vista para la entrada o para un custom posttype (en caso de que no se cree un .php asociado). Vista de posttype entrada o custom (en caso de que no se cree un .php asociado)-->
<?php get_header(); ?>
    
    <main class='container my-3'>
        <?php if(have_posts()){
            while(have_posts()){
                the_post();
                ?>
                <!--Cada post con: 1. un título y 2. una fila con a. una imagen y b. un contenido-->
                <h1 class="my-3"><?php the_title();?></h1>
                <div class="row">
                    <div class="col-6">
                        <?php the_post_thumbnail('large');?> <!--La imagen (destacada) y su tamaño entre paréntesis-->
                    </div>
                    <div class="col-6">
                        <?php the_content();?> <!--El contenido-->
                    </div>
                    <!--12 es el peso máximo de una columna (ocupa todo el ancho de contenedor). Luego 6 quiere significar el 50% del ancho del contenedor)-->
                </div>
                <!--Recordar cambiar el formato del enlace en Ajustes/Enlaces_permanentes-->
                <?php get_template_part('template-parts/post','navigation'); ?>
                <?php
            }
        }?>
    </main>

<?php get_footer(); ?>