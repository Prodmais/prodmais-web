<?php
  // $this->registerCssFile('@web/fontawesome/fontawesome_all.min.css', [
  //   'position' => \yii\web\View::POS_HEAD
  // ]);

  // $this->registerJsFile('@web/fontawesome/fontawesome_all.min.js', [
  //   'position' => \yii\web\View::POS_HEAD
  // ]);

  // $this->registerCssFile('@web/fontawesome/font_google.css', [
  //   'position' => \yii\web\View::POS_HEAD
  // ]);
?>

<?php
   use yii\helpers\Html;
?>
<head>

   <link rel="shortcut icon" href="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('favicon-purple.png', 'img_site')) ?>" type="image/x-icon" />

   <meta charset="<?= Yii::$app->charset ?>">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php $this->registerCsrfMetaTags() ?>
   <title><?= Html::encode($this->title) ?></title>
   <?php $this->head() ?>
</head>