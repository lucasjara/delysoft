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

</header> <!-- end header -->


<!-- home
================================================== -->
<section id="home" class="s-home target-section">

    <div class="home-image-part"></div>

    <div class="home-content">

        <div class="row home-content__main wide">

            <h1>
                Delysoft <br>
                Una App para todos.
            </h1>

            <h3>
                Voluptatem ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                Nemo enim ipsam voluptatem quia.
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
                Una App creada para las Pymes.
            </h1>
            <p class="lead">
                Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                omnis ea.
            </p>
        </div>
    </div> <!-- end section-header -->

    <div class="row about-desc" data-aos="fade-up">
        <div class="col-full slick-slider about-desc__slider">

            <div class="about-desc__slide">
                <h3 class="item-title">Crecimiento.</h3>

                <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                </p>
            </div>  <!-- end about-desc__slide -->

            <div class="about-desc__slide">
                <h3 class="item-title">Adaptación.</h3>

                <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                </p>
            </div>  <!-- end about-desc__slide -->

            <div class="about-desc__slide">
                <h3 class="item-title">Reinvención.</h3>

                <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                </p>
            </div>  <!-- end about-desc__slide -->

            <div class="about-desc__slide">
                <h3 class="item-title">Seguridad.</h3>

                <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
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
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo
                    non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                </p>
            </div>
        </div>
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Configurar</h3>
                <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo
                    non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                </p>
            </div>
        </div>
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Personalizar</h3>
                <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo
                    non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                </p>
            </div>
        </div>
        <div class="col-block item-process" data-aos="fade-up">
            <div class="item-process__text">
                <h3>Administrar</h3>
                <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo
                    non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                </p>
            </div>
        </div>
    </div> <!-- end process -->

    <div class="row process-bottom-image" data-aos="fade-up">
        <img src="<?php echo base_url('/public/standout/images/phone-app-screens-1000.png') ?>"
             srcset="<?php echo base_url('/public/standout/images/phone-app-screens-600.png') ?> 600w,
                         <?php echo base_url('/public/standout/images/phone-app-screens-1000.png') ?> 1000w,
                         <?php echo base_url('/public/standout/images/phone-app-screens-2000.png') ?> 2000w"
             sizes="(max-width: 2000px) 100vw, 2000px"
             alt="App Screenshots">
    </div>

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
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat.
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

                    <img src="<?php echo base_url('/public/standout/images/logo.svg') ?>" alt="Homepage">
                </a>
            </div>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat.
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
