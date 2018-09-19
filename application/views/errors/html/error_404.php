<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Pagina No Encontrada</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
<style type="text/css">
    .error-container {
        text-align: center;
        font-size: 180px;
        font-family: 'Catamaran', sans-serif;
        font-weight: 800;
        margin: 20px 15px;
    }
    .error-container > span {
        display: inline-block;
        line-height: 0.7;
        position: relative;
        color: #FFB485;
    }
    .error-container > span > span {
        display: inline-block;
        position: relative;
    }
    .error-container > span:nth-of-type(1) {
        perspective: 1000px;
        perspective-origin: 500% 50%;
        color: #F0E395;
    }
    .error-container > span:nth-of-type(1) > span {
        transform-origin: 50% 100% 0px;
        transform: rotateX(0);
        animation: easyoutelastic 8s infinite;
    }
    .error-container > span:nth-of-type(3) {
        perspective: none;
        perspective-origin: 50% 50%;
        color: #D15C95;
    }
    .error-container > span:nth-of-type(3) > span {
        transform-origin: 100% 100% 0px;
        transform: rotate(0deg);
        animation: rotatedrop 8s infinite;
    }
    @keyframes easyoutelastic {
        0% {
            transform: rotateX(0);
        }
        9% {
            transform: rotateX(210deg);
        }
        13% {
            transform: rotateX(150deg);
        }
        16% {
            transform: rotateX(200deg);
        }
        18% {
            transform: rotateX(170deg);
        }
        20% {
            transform: rotateX(180deg);
        }
        60% {
            transform: rotateX(180deg);
        }
        80% {
            transform: rotateX(0);
        }
        100% {
            transform: rotateX(0);
        }
    }

    @keyframes rotatedrop {
        0% {
            transform: rotate(0);
        }
        10% {
            transform: rotate(30deg);
        }
        15% {
            transform: rotate(90deg);
        }
        70% {
            transform: rotate(90deg);
        }
        80% {
            transform: rotate(0);
        }
        100% {
            transform: rotateX(0);
        }
    }
</style>
<section class="error-container" style="margin-top: 20%; text-align: center;">
    <span><span>4</span></span>
    <span>0</span>
    <span><span>4</span></span>
</section>
<!--
	<div id="container">
		<h1><?php //echo $heading; ?></h1>
		<?php //echo $message; ?>
	</div>
-->
</body>
</html>