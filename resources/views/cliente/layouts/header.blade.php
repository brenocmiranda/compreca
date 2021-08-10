<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <meta name="application-name" content="<x-nome/> - <x-frase/>" />
  <meta name="author" content="<x-nome/>">
  <meta name="mobile-web-app-capable" content="yes" />
  <meta name="description" content="Preço baixo e as melhores ofertas de smartphones, notebooks, TV LED, geladeiras, móveis, tablets e etc. Compre hoje e receba hoje!.">
  <meta name="keywords" content="compras, lojas, vendas, compreca, marketplace, produtos, preco baixo, smartphones, celulares, roupas, acessorios, entrega rapida, ofertas, promocoes">

  <title>@if(Request::segment(1) != "") @yield('title') &#183 <x-nome/> @else <x-nome/> - <x-frase/> @endif</title>

  <!-- Icons -->
  <link rel="shortcut icon" href="<x-icone/>" type="image/x-icon">

  <!-- Template CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/css/bootstrap.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/bootstrap/css/bootstrap.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/fonts/font-awesome-4.7.0/css/font-awesome.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/fonts/themify/themify-icons.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/fonts/Linearicons-Free-v1.0.0/icon-font.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/fonts/elegant-font/html-css/style.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/animate/animate.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/css-hamburgers/hamburgers.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/animsition/css/animsition.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/select2/select2.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/daterangepicker/daterangepicker.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/slick/slick.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/vendor/lightbox2/css/lightbox.min.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/css/util.css').'?'.rand() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/cliente/css/main.css').'?'.rand() }}">
</head>

<body class="animsition">
