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
  <body>
    <?php $this->beginBody() ?>
      <!-- Loader -->
      <?php echo \app\widgets\loader\LoaderWidget::widget() ?>
      <!-- Navbar -->
      <?php echo \app\widgets\navbar\NavbarWidget::widget() ?>
      <!-- Alert -->
      <?php echo Alert::widget() ?>
      <!-- Content -->
      <?= $content ?>
      <!-- Footer -->
      <?php echo \app\widgets\footer\FooterWidget::widget() ?>
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>