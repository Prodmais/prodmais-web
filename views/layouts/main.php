<?php
  use app\widgets\Alert;
  use yii\helpers\Html;
  use yii\bootstrap\Nav;
  use yii\bootstrap\NavBar;
  use yii\widgets\Breadcrumbs;
  use app\assets\AppAsset;
  
  AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
   <head>

      <link rel="shortcut icon" href="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('favicon.png', 'img_site')) ?>" type="image/x-icon" />
      <meta charset="<?= Yii::$app->charset ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../web/template/bower_components/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="../web/template/bower_components/Ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="../web/template/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="../web/template/bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <link rel="stylesheet" href="../web/template/plugins/pace/pace.min.css">
      <?= Html::csrfMetaTags() ?>
      <title><?= Html::encode('Prodmais | você no controle') ?></title>
      <?php $this->head() ?>
      <link rel="stylesheet" href="../web/template/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="../web/template/plugins/iCheck/square/blue.css">
      
   </head>
   <body class="layout-top-nav skin-purple pace-done">
      <?php $this->beginBody() ?>

      <!-- Loader -->
      <?php // \app\widgets\loader\LoaderWidget::widget() ?>
      <!-- Loader -->
      <div class="div-loader" style="">
         <div class="loader"></div>
      </div>

      <div class="wrapper">
         <header class="main-header">
            <?php include_once('dropdownNav.php') ?>
         </header>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <section class="content">
               <!-- <section class="content"> -->
               <?=
                  Breadcrumbs::widget([
                    'homeLink' => [
                      'label' => Yii::t('yii', 'Inicio'),
                      'url' => Yii::$app->homeUrl,
                    ],
                  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                  ])
                ?>
               <!-- Alert -->
               <?php echo Alert::widget() ?>
               <!-- Conteudo -->
               <?= $content ?>
            </section>
         </div>
         <!-- /.content-wrapper -->
         <?php echo \app\widgets\footer\FooterWidget::widget() ?>
      </div>

      <?php
         $this->registerJs('
         $(document).ready(function(){
            $(".div-loader").hide();
         });', \yii\web\View::POS_READY);
      ?>

      <?php $this->endBody() ?>
      <!-- responsavel pelo bootbox -->
      <script src="../web/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="../web/template/bower_components/PACE/pace.min.js"></script>
      <script src="../web/template/dist/js/adminlte.min.js"></script>
   </body>
</html>
<?php $this->endPage() ?>