<?php use yii\helpers\Html; ?>

<div style="margin-top: 3em;" class="form-group">
    <div id="div-loader-ajax" style="display: none;">
        <?php echo Html::button('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>', [
            'class' => Html::encode($classButton) ]) ?>
    </div>
    <div id="div-button-submit">
        <?php echo Html::submitButton(Html::encode($text), [
            'id' => '',
            'class' => Html::encode($classButton)
            ]) ?>
    </div>
</div>

<?php
  $this->registerJsFile(
    'web/custom/js/auto-button-ajax-form.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
  );
?>