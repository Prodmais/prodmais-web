<header class="main-header">
   <nav class="navbar navbar-static-top">
      <div class="container">
         <div class="navbar-header">
            <a href="/boards" class="navbar-brand"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;PROD<b>+</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
               <i class="fa fa-bars"></i>
            </button>
         </div>
         <div style="float: right;" class=" navbar-collapse collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
               <li>
                  <a href="<?= Yii::$app->urlManager->createUrl(['/site/logout']) ?>">
                     <span><strong>LOGOUT</strong> <small class="hidden-xs">(<?= strtolower(Yii::$app->user->identity->getNomeSolo()) ?>)</small></span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
</header>