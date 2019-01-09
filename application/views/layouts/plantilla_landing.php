<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 17-11-2018
 * Time: 19:45
 */
?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delysoft</title>
    <link rel="shortcut icon" href="<?php echo base_url('/public/img/icon.png') ?>" >
    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url('/public/standout/css/base.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/standout/css/vendor.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/standout/css/main.css') ?>">

    <!-- script
    ================================================== -->
    <script src="<?php echo base_url('/public/standout/js/modernizr.js') ?>"></script>
    <script src="<?php echo base_url('/public/standout/js/pace.min.js') ?>"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

<div id="preloader">
    <div id="loader"></div>
</div>


<!-- header
================================================== -->
<header class="s-header">

    <div class="header-logo">
        <a class="site-logo" href="index.html">
            <img src="<?php echo base_url('/public/standout/images/logo_juntos.svg') ?>" alt="Homepage">
        </a>
    </div>

    <nav class="row header-nav-wrap wide">
        <ul class="header-main-nav">
            <li class="current"><a class="smoothscroll" href="#home" title="intro">Inicio</a></li>
            <li><a class="smoothscroll" href="#about" title="about">Nosotros</a></li>
            <li><a class="smoothscroll" href="#download" title="descargar">Descargar App</a></li>
            <li><a href="registro" title="registro">Registro</a></li>
            <li><a href="https://www.infest.cl/login" title="login">Login</a></li>
        </ul>

        <ul class="header-social">
            <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
    </nav>

    <a class="header-menu-toggle" href="#"><span>Menu</span></a>
    <link rel="manifest" href="/manifest.json" />
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "90a9d020-87d2-4dd4-9884-72b404d341b2",
            });
        });
    </script>
</header> <!-- end header -->


<!-- home
================================================== -->
<section id="home" class="s-home target-section">

    <div class="home-image-part"></div>

    <div class="home-content">

        <div class="row Zhome-content__main wide">

            <h1>
                Delysoft <br>

            </h1>

            <h3>
                Encuentra los locales y restaurantes que realicen entregas cerca de tu ubicación
            </h3>


        </div> <!-- end home-content__main -->

        <a href="#about" class="home-scroll smoothscroll">
            <span class="home-scroll__text">SEGUIR</span>
            <span class="home-scroll__icon"></span>
        </a>

    </div> <!-- end home-content -->

</section> <!-- end s-home -->


<!-- about
================================================== -->
<section id="about" class="s-about target-section">

    <div class="row section-header narrower align-center" data-aos="fade-up">
        <div class="col-full">
            <h1 class="display-1">
                Una App creada para el mundo moderno.
            </h1>
            <p class="lead">
                Una solución de mercado que apunta a mejorar el sistema de Delivery de pequeños y medianos locales
                de comida.
                En estos tiempos de Hiperconectividad, donde las noticias se propagan a la velocidad de Internet
                los escasos tiempos de colación, los ritmos acelerados de la vida, ya no representarán un problema.

            </p>
        </div>
    </div> <!-- end section-header -->

    <div class="row about-desc" data-aos="fade-up">
        <div class="col-full slick-slider about-desc__slider">

            <div class="about-desc__slide">

                <h3 class="item-title">¿Cuándo usarlo?</h3>

                <p>
                    Si estás ubicado en un sector desconocido,
                    y con la necesidad de realizar un pedido,
                    usando Delysoft podrás conocer los diferentes
                    locales capaces de realizar un envío hasta tu ubicación.
                    Contando al mismo tiempo con información relevante respecto al local.
                </p>

            </div>  <!-- end about-desc__slide -->

            <div class="about-desc__slide">
                <h3 class="item-title">¿Cómo lo uso?</h3>

                <p>

                    Instala nuestra <a href="#download" style="color: #FFFFFF; " class="smoothscroll">APP</a> , crea tu cuenta,
                    selecciona alguno de los productos
                    disponibles, configura tu pedido, envialo
                    y recibe tu comida.

                </p>
            </div>  <!-- end about-desc__slide -->

            <div class="about-desc__slide">
                <h3 class="item-title">Tipos de pagos</h3>

                <p>
                    En Delysoft el unico medio de pago,
                    es el efectivo, y en su defecto solo se tendrá que especificar
                    el monto con el cual se cancelará, para efectos de vuelto. </br></br>
                    El realizar los pedidos mediante DelySoft no tiene costo adicional.
                </p>
            </div>  <!-- end about-desc__slide -->

            <div class="about-desc__slide">
                <h3 class="item-title"></h3>

                <p>

                </p>
            </div>  <!-- end about-desc__slide -->

        </div> <!-- end about-desc__slider -->
    </div> <!-- end about-desc -->

    <div class="row about-bottom-image" data-aos="fade-up">
        <img src="<?php echo base_url('/public/standout/images/app-screen-1400.png') ?>"
             srcset="<?php echo base_url('/public/standout/images/app-screen-600.png') ?> 600w,
                         <?php echo base_url('/public/standout/images/app-screen-1400.png') ?> 1400w,
                         <?php echo base_url('/public/standout/images/app-screen-2800.png') ?> 2800w"
             sizes="(max-width: 2800px) 100vw, 2800px"
             alt="App Screenshots">
    </div>

</section> <!-- end s-about -->


<!-- process
================================================== -->
<section id="process" class="s-process">

    <div class="row">
        <div class="col-full text-center" data-aos="fade-up">
            <h2 class="display-2">¿Como Trabajar con Delysoft?</h2>
        </div>
    </div>

    <div class="row process block-1-4 block-m-1-2 block-tab-full">
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Registrarse</h3>
                <p>
                    Luego de crear tu cuenta de usuario ponte en contacto con nosotros,
                    mediante nuestro correo <a href="mailto:#0" class="footer__mail-link">delysoft@infest.cl</a>
                    y así evaluar tu incorporación a DelySoft.
                </p>
            </div>
        </div>
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Configurar</h3>
                <p>
                    Ingresa nombre, descripción, ubicación de tu local,
                    y crea o vincula los perfiles de tus trabajadores.

                    Agrega todo tipo de productos que ofrece tu local.
                </p>
            </div>
        </div>
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Personalizar</h3>
                <p>
                    Delimita zonas de reparto y agrega
                    los productos y costos asociados a estas zonas.
                </p>
            </div>
        </div>
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Administrar</h3>
                <p>
                    Activa o desactiva productos o zonas en tiempo real,
                    revisa los estados de los pedidos y visualiza en forma
                    gráfica estadísticas con información relevante a tu local.

                </p>
            </div>
        </div>
    </div> <!-- end process -->

</section> <!-- end s-process -->

<!-- download
================================================== -->
<section id="download" class="s-download">

    <div class="row download-content">
        <div class="col-six md-seven download-content__text pull-right" data-aos="fade-up">
            <h1 class="display-2">
                Descarga la App Ahora!
            </h1>
            <p>
                La comida que necesitas, ahora está al alcance de tu mano.</br>
                No te quedes fuera de esta revolución.
            </p>
            <ul class="download-content__badges">
                <li><a href="#0" title="" class="badge-appstore">App Store</a></li>
                <li><a href="#0" title="" class="badge-googleplay">Play Store</a></li>
            </ul>
        </div>
        <div class="download-content__image" data-aos="fade-up">
            <img src="<?php echo base_url('/public/standout/images/telefono_pedido_opt-550.png') ?>"
                 srcset="<?php echo base_url('/public/standout/images/telefono_pedido_opt-550.png') ?> 1x,
                 <?php echo base_url('/public/standout/images/telefono_pedido_opt-1100.png') ?> 2x"
            style="background-color: #blue;">
        </div>
    </div>

</section> <!-- end s-download -->


<!-- footer
================================================== -->
<footer class="s-footer footer">

    <div class="row footer__top">
        <div class="col-five tab-full">
            <div class="footer__logo">
                <a href="index.html">

                    <img src="<?php echo base_url('/public/standout/images/logo_juntos.svg') ?>" alt="Homepage">
                </a>
            </div>

            <p>
                Tesis presentada a la Universidad Tecnológica de Chile INACAP
                para optar al título profesional de Ingeniero Informático
                con grado académico de Licenciado (a) en Informática.
            </p>

            <ul class="footer__social">
                <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </div>

        <div class="col-six tab-full end">
            <ul class="footer__site-links">
                <li><a class="smoothscroll" href="#home" title="intro">Inicio</a></li>
                <li><a class="smoothscroll" href="#about" title="about">Nosotros</a></li>
                <li><a class="smoothscroll" href="#download" title="descargar">Descargar App</a></li>
                <li><a href="blog.html" title="registro">Registro</a></li>
                <li><a href="blog.html" title="login">Login</a></li>
            </ul>

            <p class="footer__contact">
                ¿Tienes una duda? Envianos un mensaje a: <br>
                <a href="mailto:#0" class="footer__mail-link">delysoft@infest.cl</a>
            </p>

            <div class="cl-copyright">
                    <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                  target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</span>
            </div>
        </div>
    </div>

    <div class="go-top">
        <a class="smoothscroll" title="Volver al Inicio" href="#top"></a>
    </div>

</footer> <!-- end s-footer -->


<!-- Java Script
================================================== -->
<script src="<?php echo base_url('/public/standout/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('/public/standout/js/plugins.js') ?>"></script>
<script src="<?php echo base_url('/public/standout/js/main.js') ?>"></script>
</body>
