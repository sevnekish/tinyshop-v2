<header class="navbar navbar-default navbar-static-top">
  <div class="container">
  <!-- navbar -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
        <span class="sr-only">Open-navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a href="/" class="navbar-brand"><i class="fa fa-arrows-v"></i>Tiny Shop</a> -->
      <a href="/" class="navbar-brand"><img src="/content/images/TinyShopLogoW3.png" height="40"/></a>
    </div>
    <div class="collapse navbar-collapse" id="responsive-menu">

      <ul class="nav navbar-nav navigation navmenu">
        <li><a href="/">Home</a></li>
        <!-- <li><a href="/catalog"></a></li> -->
        <li class="dropdown">
          <a href="/catalog" class="dropdown-toggle" data-toggle="dropdown">Catalog <b class="caret"></b></a>
          <ul class="dropdown-menu">

            <? foreach ($categories as $id => $category):?>
              <li><a href="/catalog/<?=$category?>"><?=$category?></a></li>
            <? endforeach; ?>
              
          </ul>
        </li>
        <li><a href="/reviews">Reviews</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right navigation">

        <? if ($userparams['role'] === 'guest'): ?>
        <li class="dropdown">

          <a href="/logreg" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-sign-in"></i> Login / Registrate
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="/login">Login</a>
            </li>

            <li class="divider" ></li>
            
            <li>
              <a href="/registration">Registrate</a>
            </li>
          </ul>

        </li>
        <? endif;?>

        <? if ($userparams['role'] === 'user'): ?>
        <li>
          <a href="/account/userinfo">
            <i class="fa fa-user"></i> <? echo $userparams['email']?>
          </a>
        </li>
        <? endif;?>

        <? if ($userparams['role'] === 'admin'): ?>
        <li>
          <a href="/adminbar">
            <i class="fa fa-wrench"></i> Administrator
          </a>
        </li>
        <? endif;?>


        <li class="<?if ($userparams['role'] === 'admin'):?>disabled<?endif;?>">
          <a class="cart" href="/cart">
            <i class="fa fa-shopping-cart"></i> Cart: <?=$cart_count?>
          </a>
        </li>

      </ul>

    </div>

  </div>
</header>