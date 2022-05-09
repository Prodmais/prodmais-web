
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>v1.0.1</b>
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
          $('.flash-message-user').slideUp(200).delay(5).queue(function(){
          $('.close').trigger('click');
          });
          initializeTimeStamp();
        }, 3000);
      }
  });", \yii\web\View::POS_READY);
?>