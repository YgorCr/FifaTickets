<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="GustavoBrito, Igor Malheiros, Ygor Crispim">

    <title>FifaTickets</title>

    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/css/fifatickets.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?a=home">FifaTickets</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li 
              <?php if($ac=="home" || $ac=="partidas"){ ?> class="active" <?php } ?>
               ><a href="?a=home">Partidas</a></li>

            <li 
              <?php if($ac=="comprador"){ ?> class="active" <?php } ?>
               ><a href="?a=comprador"> <?php if($comprador) echo "Minha conta"; else echo "Meu cadastro"; ?> </a></li>

            <li 
              <?php if($ac=="sobre"){ ?> class="active" <?php } ?>
               ><a href="?a=sobre">Sobre</a></li>

            <li 
              <?php if($ac=="comprador.login"){ ?> class="active" <?php } ?>
               >

               <?php if(!$comprador){ ?>
                <a href="?a=comprador.login">Login</a>
              <?php } else { ?>
                <a href="#"><?php echo $comprador->get("nome"); ?></a>
              <?php } ?>

             </li>

             <?php if($comprador) { ?>
             <li>
              <a href="?a=logout">Sair</a>
             </li>
             <?php } ?>

          </ul>

          <form class="navbar-form navbar-right" role="search" action="">
            <div class="form-group">
              <input type="hidden" name="a" value="buscar"/>
              <input type="hidden" name="by" value="nome" />
              <input type="text" class="form-control" placeholder="Buscar partida" name="q">
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
          </form>

        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container" id="container">
