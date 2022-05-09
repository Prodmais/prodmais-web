$('.sidebar-toggle').click(function () {

  jQuery(document).ready(function() {
     if( $(window).width() >= 760){ // faz o crop
      const div = document.querySelector('.user-panel>.image>img');
      if (div.classList.contains('custom-user-panel')) {
        $(".user-panel>.image>img").removeAttr("style");
        $('.user-panel>.image>img').css("height", "45px");
        $('.user-panel>.image>img').removeClass('custom-user-panel');
      } else { // nao faz o crop
        $(".user-panel>.image>img").removeAttr("style");
        $('.user-panel>.image>img').css("height", "auto");
        $('.user-panel>.image>img').addClass('custom-user-panel');
      }
     }
  });
});


$(document).ready(function() {

  // jQuery(document).ready(function() {
  //    if( $(window).width() >= 760){ // exibe
  //     $('div.has-feedback>input').removeAttr("style");
  //    } else { // oculta
  //     $('.dataTables_length').hide();
  //     $('div.has-feedback>input').css("width", "150px");
  //    }
  // });

});