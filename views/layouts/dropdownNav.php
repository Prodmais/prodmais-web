<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
   <div class="container">
      <div class="navbar-header">
         <a href="/boards/meus" class="navbar-brand"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;PROD<b>+</b></a>
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
         <i class="fa fa-bars"></i>
         </button>
      </div>
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
         <ul class="nav navbar-nav">
            <li style="display: none;" id="" class="
               site-index
               site-create
               site-update
               site-view
               ">
               <a href="<?= Yii::$app->urlManager->createUrl(['/site']) ?>">
               <span>Início</span>
               </a>
            </li>
         </ul>
         
      </div>
      <div style="" class="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
               <a href="<?= Yii::$app->urlManager->createUrl(['/site/logout']) ?>">
               <span class="hidden-xs">Logout <small>(<?= Yii::$app->user->identity->getNomeSolo() ?>)</small></span>
               </a>
            </li>
         </ul>
      </div>
   </div>
</nav>