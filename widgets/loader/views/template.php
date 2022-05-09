<div class="div-loader" style="">
  <div class="loader"></div>
</div>

<?php
  $this->registerJs('
  $(document).ready(function(){
    $(".div-loader").hide();
  });', \yii\web\View::POS_READY);
?>