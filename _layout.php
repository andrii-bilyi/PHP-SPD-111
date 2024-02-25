<?php
  session_start();
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $interval = time() - $_SESSION['auth-moment'];
    if($interval > 30) {
      unset($_SESSION['user']);
      unset($_SESSION['auth-moment']);
      $user = null;
    }
    else{
      $user = $_SESSION['user'];
      $_SESSION['auth-moment'] = time();
    }
  }
  else{
    $user = null;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP SPD-111</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!--Import Google Icon Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
  <!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/css/site.css"/>
</head>
<body>
    <nav>
    <div class="nav-wrapper orange">
        <a href="/" class="brand-logo"><img src="/img/php.png"/></a>
        <ul id="nav-mobile" class="right ">
          <!-- <li><a href="basics">Основи</a></li>
          <li><a href="layout">Шаблонізація</a></li> -->

          <?php foreach( [
            'basics' => 'Основи',
            'layout' => 'Шаблонізація',
            'api' => 'API',
            'signup' => '<i class="material-icons">person_add</i>',
        ] as $href => $name ) : ?>
            <li <?= $uri==$href ? 'class="active"' : '' ?> ><a href="/<?= $href ?>"><?= $name ?></a></li>
        <?php endforeach ?>  
        <!-- Modal Trigger -->
        <li><a href="#auth-modal" class="modal-trigger"><i class="material-icons">key</i></a></li>
        <!-- <li><a href="/signup"><i class="material-icons">person_add</i></a></li> -->
    </div>
    </nav>

  Auth in <?= $interval ?> sec
  <div class="container">
    <?php include $page_body ; ?>   
  </div>  
  <footer class="page-footer orange">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2024 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
		
	

  <!-- Modal Structure -->
  <div id="auth-modal" class="modal">
  <div class="col s12">
    <div class="modal-content">
      <h4>Введіть e-mail та пароль для входу</h4>
      <div class="input-field col s6">
          <i class="material-icons prefix">email</i>
          <input id="user-input-email" type="text" class="validate" name="auth-email">
          <label for="user-input-email">Email</label>
      </div>
      <div class="input-field col s6">
          <i class="material-icons prefix">lock</i>
          <input id="user-input-password" type="password" class="validate" name="auth-password">
          <label for="user-input-password">Password</label>
      </div>
    </div>
    <div class="modal-footer">
      <button class="modal-close btn-flat grey">Закрити</a>
      <button class="btn-flat orange" style="margin-left:15px" id="auth-button">Вхід</button>
    </div>
  </div>

</div>


    <!-- Compiled and minified JavaScript -->    
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/site.js"></script>
</body>


</html>

