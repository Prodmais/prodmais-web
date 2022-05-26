
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>v1.1.6</b>
  </div>
  <?= DATE('Y') ?>
</footer>

<!-- flash messages -->
<?php
  $this->registerJs("
    $(document).ready(function(){
      initializeTimeStamp();
      function initializeTimeStamp() {
        setTimeout(function(){
          $('.alert').slideUp(200).delay(1).queue(function(){
          $('.close').trigger('click');
          });
          initializeTimeStamp();
        }, 5000);
      }
  });", \yii\web\View::POS_READY);
?>