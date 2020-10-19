<!DOCTYPE html>
<html lang="ru-RU">
<head id="idheader">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Smart Home..и другие плюшки">
<meta name="author" content="(c) 2020-<?php echo date("Y") ?> by Gribov Pavel">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="generator" content="yarus">
<title><?= $cfg->sitetitle ?></title>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/vendor/components/jqueryui/themes/base/all.css">
<link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/smarthome.css">
<link rel="stylesheet" href="/css/bootstrap4-toggle.min.css">

<script src="/vendor/components/jquery/jquery.min.js"></script>
<script src="/vendor/components/jqueryui/jquery-ui.min.js"></script>
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/js/bootstrap4-toggle.min.js"></script>
 <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
 <link href="/css/smarthome.css" rel="stylesheet">    
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#"><img src="/images/homepic.png" alt="аватарка дома"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/client/index">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/client/grafs">Графики</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/client/actions">Сценарии</a>
      </li>            
    </ul>
    <div class="form-inline my-2 my-lg-0">      
      <a href="/client/index&defaultFormLogout=true" class="btn btn-secondary my-2 my-sm-0" type="submit">Выйти</a>
    </div>
  </div>
</nav>        
<main role="main" class="container">
<div class="main-template">