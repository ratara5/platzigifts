<!--Pie de página-->
<footer>
    <div class="container">
        <!--A continuación se inserta un widget. Primero se registró en sidebar() (functions.php) con register_sidebar y luego se creó en el escritorio de wordpress. Entre paréntesis, el valor al que apunta la llave id del array del register_sidebar-->
        <?php dynamic_sidebar('footer'); ?>
    </div>
</footer>
<?php wp_footer()?>

<!--body y html que se abren en el header, se cierran acá-->
</body>
</html>