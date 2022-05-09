<?php
  use app\widgets\Alert;
  use app\assets\AppAsset;
  AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">
  <!-- Head -->
  <?php echo \app\widgets\head\HeadWidget::widget() ?>

  <link rel="stylesheet" href="../web/template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../web/template/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="../web/template/plugins/pace/pace.min.css">
  <link rel="stylesheet" href="../web/template/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../web/template/bower_components/Ionicons/css/ionicons.min.css">

  <body class="hold-transition login-page" style="background:url('../web/custom/img/img_site/bg.png') no-repeat; background-size:cover;">

    <?php $this->beginBody() ?>
      <!-- Loader -->
      <?php echo \app\widgets\loader\LoaderWidget::widget() ?>

      <div class="login-box">
          <?php echo Alert::widget() ?>
          <?= $content ?>
      </div>

    <?php $this->endBody() ?>

    <script src="../web/template/bower_components/PACE/pace.min.js"></script>

  </body>
</html>
<?php $this->endPage() ?>