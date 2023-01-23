<!--Si no se creara esta plantilla, la página institucional usaría por defecto la plantilla page.php-->
<!--Se genera un template por cada estructura diferente que queramos utilizar en nuestro sitio-->
<?php 
/*
Template Name: Página Institucional
*/
//El anterior comentario crea una nueva opción 'Página Institucional' para el campo 'Atributos de página' en el modo de edición de la página  
get_header(); 

//Se debe instalar el plugin Advance Custom Fields que permite generar campos personalizados para cualquier elemento de nuestro Wordpress.
//Regla: Mostrar este grupo de campos si Plantilla de Página es igual a Página Institucional
//Campos a Crear: Título, Imagen [Formato de Retorno: URL de la imagen]
//Se puede ver en el modo de edición de la página que se pueden cargar un título y una imagen. Y aunque se escriban, no se muestran (están cargados, pero no presentados en la plantilla).
$fields = get_fields();
//La función get_fileds() recupera el array de campos creados con el plugin mencionado
?>

<main class='container'>
    <?php if(have_posts()){
        while(have_posts()){
            the_post();?>
            <h1 class='my-3'><?php echo $fields['titulo']; ?></h1>
            <img src="<?php echo $fields['imagen']; ?>" alt="Imagen">
            <hr>
            <?php the_content();?>
        <?php
        }
    }?> 
</main>

<?php get_footer(); ?>