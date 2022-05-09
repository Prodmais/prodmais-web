yii.allowAction = function ($e) {
    var message = $e.data('confirm');
    return message === undefined || yii.confirm(message, $e);
};
yii.confirm = function (message, ok, cancel) {
    // bootbox.confirm(message, function (confirmed) {
    //    if (confirmed) {
    //      !ok || ok();
    //    } else {
    //      !cancel || cancel();
    //    }
    // });



bootbox.confirm({
    message: message,
    buttons: {
        confirm: {
            label: '<i class="fa fa-check"></i> Confirmar',
            className: 'btn-success'
        },
        cancel: {
            label: '<i class="fa fa-times"></i> Cancelar',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        // console.log('This was logged in the callback: ' + result);

        if (result == true) {
            ok();
        }
        // ok();
    }
});

    return false;
}