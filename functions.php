<!--Acá se agrega todo el código propio. Fue creado en 5to lugar despues de index, style, header y footer-->
<?php

function init_template(){
    add_theme_support('post-thumbnails'); //Para que en todas las entradas de páginas podamos usar una imagen destacada
    add_theme_support('title-tag'); //Imprime en el wp_header el title de la página

    //Esto después de ir a style.css y escribir estilos
    //Registrar una localización, ie, un lugar donde el admin de wordpress pueda insertar un menú
    register_nav_menus(
        array(
            'top_menu'=>'Menú Principal'
            )
        );
}

add_action('after_setup_theme','init_template'); //Cuando alguien ingresa al sitio, wordpress elije el tema para mostrarle. No olvidar ponerle al tema un screenshot que será la imagen de previsualización del tema jpg 880x660
//Después de esto crear el menú en el escritorio de wordpress. Luego, ir a header.php

//Librerías
function assets(){
    //Registrar estilo como dependencia
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css', '', '4.4.1', 'all'); //'bootstrap' corresponde a cualquier nombre dado por nosotros. el '' corresponde a las dependencias (en esta ocasión no le pasamos ninguna), el 'all' corresponde al media, ie, en qué resoluciones se va a ejecutar (all significa en todos las resoluciones[dispositivos]). El enlace se tomo de GET STARTED de la página de bootsrap

    //Registrar estilo como dependencia
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', '', '1.0', 'all'); //El enlace se tomó de la página de google fonts

    //Poner estilo en cola (poner=cargar)
    //Las dos anteriores se pusieron como dependencias por que queremos que se carguen antes que nuestro archivo de estilos
    wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap', 'montserrat'), '1.0', 'all'); //get_stylesheet_uri() apunta al style.css que hay en la raíz de nuestro proyecto. Después de este comando ya se pueden ingresar valores en style.css para modificar la estetica del tema

    //Registrar una dependencia: Algunos componentes de bootstrap requieren del uso de Javascript
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', '', '1.16.0', true);
    //Poner script (de bootsrap) en cola
    wp_enqueue_script('bootstraps', 'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js', array('jquery', 'popper'), '4.4.1', true); //bootrstrap requiere como dependencias a jquery (que ya wordpress tiene registrado por defecto y no requiere nuevo registro) y a popper (que se registró con el anterior comando). Mejor usar nombres (el primer argumento) diferentes para lo que se pone en cola (aunque no deberían pisarse si son scripts y estilos). true quiere decir que sí se cargue en el footer

    //Poner script (propio) en cola
    wp_enqueue_script( 'custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true); //get_template_directory_uri() hace referencia a la raíz de nuestro proyecto. Se usa para cargar el archivo de forma dinámica

    wp_localize_script('custom', 'pg', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'assets'); //El hook

//Widget: Es un componente de wordpress que nos permite mostrar contenido de diferentes formas en determinadas zonas llamadas sidebars (que son o una barra lateral o un pie de página). Los widget han venido cayendo en desuso aunque son una herramienta todavía a disposición
function sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de página',
            'id' => 'footer',
            'description' => 'Zona de widgets para pie de página',
            'before_title' => '<p>',
            'after_title' => '</p>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
        )
    );
}

add_action('widgets_init', 'sidebar'); //El hook
//Después de esto crear el widget en el escritorio de wordpress. Luego, ir a footer.php o a la página donde se quiere colocar el widget

//Código propio para crear un custom post_type
function productos_type(){
    //Array para personalizar mensajes en el administrador acerca del custom post type
    $labels=array(
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'menu_name' => 'Productos'
    );
    //Array de características del custom post type
    $args=array(
        'label' => 'Productos',
        'description' => 'Productos de Platzi',
        'labels' => $labels,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions'
        ),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicy_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true
   ); //La clave 'supports' hace referencia a qué puede hacer o qué opciones que puede tener el custom post type ('revisions' permite que cada vez que se guarde una entrada del custom post type, tengamos un historial de cambios para reversar, por ejemplo). 'show in menu' permite que en las opciones de menú (del administrador?) podamos agregar las páginas que tengamos creadas del custom post type. 'publicy_queryable' permite que se pueda traer una entrada del custom post type con un custom query. 'rewrite' permite que el custom_post_type tenga una url asignada para que se pueda navegar así como se puede con las entradas. 'show_in_rest' para que los datos del custom_post_type pertenezcan al API.
   //Función para crear un custom post type.
    register_post_type('producto',$args); //Primer argumento es el nombre del custom post type (se recomienda que sea en singular). El segundo argumento es el array de datalles, configuraciones o características del custom post type.

}

add_action('init', 'productos_type'); //El hook para agregar la acción definida por la función anterior. El momento de agregarse la acción es en el init. init es despues del after_setup_theme

//Después de esto se puede crear la entrada del custom post type y se deben REFRESCAR LOS ENLACES PERMANENTES para poder visualizarla<- Esto último refresca el htaccess para poder visualizar
//Finalmente, pasar al front-page y agregar instrucciones para listar el custom post type a través de un custom loop.

function pg_register_tax(){
    $args= array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Categorías de Productos',
            'singular_name' => 'Categoría de Productos'
        ),
        'show_in_nav_menu' => true,
        'show_admin_column' => true,
        'rewrite' => array(
            'slug'=>'categoria-productos'
        )
    );
    register_taxonomy('categoria-productos', array('producto'), $args);
}

add_action('init','pg_register_tax');

add_action('wp_ajax_nopriv_pg_filtro_productos', 'pg_filtro_productos');
add_action('wp_ajax_pg_filtro_productos', 'pg_filtro_productos');
function pg_filtro_productos(){
    $args=array(
        'post_type' => 'producto',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'order_by' => 'title',
    );
    if ($_POST['categoria']){
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categoria-productos',
                'field' => 'slug',
                'terms' => $_POST['categoria']
            )
        );
    }
    $productos=new WP_Query($args);
    if($productos->have_posts()){
        while($productos->have_posts()){
            $productos->the_post();
            $return[] = array(
                'imagen' => get_the_post_thumbnail(get_the_ID(),'large'),
                'link' => get_the_permalink(),
                'titulo' => get_the_title()
            );
        }
    wp_send_json($return);
    }
}