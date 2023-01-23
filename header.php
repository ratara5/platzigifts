<!--Encabezado. Inicializar el encabezado-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?> <!--Trae todas las dependencias que se cargan en el encabezado. Esta función trae todas las funciones o código propio que hacen referencia a wp_head()-->
</head>
<body>

<header>
    <div class="container">

        <!--Este es el top de la página (ES UNA FILA) INICIO-->
        <div class="row align-items-center">
            <div class="col-4">
                <img src="<?php echo get_template_directory_uri()?>/assets/img/logo.png" alt="Loading">
            </div>
           <div class="col-8">
                <!--A continuación se coloca el menú. Primero se registró en init_template() (functions.php) con register_nav_menu y luego se creó en el escritorio de wordpress-->
                <nav>
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'top_menu',
                            'menu_class' => 'menu-principal', //clase del ul que contendrá todos los elementos del nav
                            'container_class' => 'container-menu' //clase del div que tendrá el ul
                        )
                        //nav será el padre de div que a su vez será el padre de ul
                    ); ?>
                </nav>
           </div>
        </div>
        <!--Este es el top de la página (ES UNA FILA) FIN -->
    </div>
</header>
<!--body y html fueron cortados para poder cerrarlos en el footer-->