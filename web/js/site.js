// аДаОаДаАб аМбаКб аДаО аКаОбаИаКаА
$('.add-oil-to-cart-button').click(function() {
    var itemId = $(this).data('item-id'),
        url = $(this).data('url'),
        messageSuccess = $(this).data('success-message'),
        messageError = $(this).data('error-message');
        
        var mixCount;
        var mixCountInput = $(this).prev('.add-oil-to-cart-number');
        mixCount = mixCountInput.val();
        
        var priceId;
        var priceInput = $(this).prev().prev('.volume-select');;
        priceId = priceInput.val();

    // аВаИаКаЛаИаКаАбаМаО аПаО аАаДаЖаАаКбб аВбаДаПаОаВбаДаНаИаЙ аЕаКбаН
    $.ajax({
        url: url,
        data: {itemId: itemId, count: mixCount, priceId: priceId},
        type: 'POST',
        success: function (data) {
            if (data.success) {
                $.notify({
                    message: messageSuccess
                }, {
                    type: 'success'
                });
                if (mixCountInput.length > 0) {
                    mixCountInput.val(1);
                }
                // баЕаПаЕб ббаЕаБаА аОаНаОаВаИбаИ аЛаЕаЙаБаЕаЛ аЗ аКбаЛбаКбббб аМбаКббаВ б аКаОбаЗаИаНб
                $('#card-count-badge').html(data.newCount);
            } else {
                $.notify({
                    message: messageError
                }, {
                    type: 'danger'
                });
            }
        },
        error: function (jxhr, msg, err) {
            $.notify({
                message: messageError
            }, {
                type: 'danger'
            });
        }
    });
});

// аМбаНбб аКбаЛбаКбббб баОаВаАббаВ б аКаОбаИаКб
$('.card-change-item-count-button').click(function() {
    var itemId = $(this).data('item-id'),
        priceId = $(this).data('price-id'),
        url = $(this).data('url'),
        count = $(this).parent().prev('th').children('input').val(),
        messageError = $(this).data('error-message');

    // аВаИаКаЛаИаКаАбаМаО аПаО аАаДаЖаАаКбб аВбаДаПаОаВбаДаНаИаЙ аЕаКбаН
    $.ajax({
        url: url,
        data: {itemId: itemId, priceId:priceId, count: count},
        type: 'POST',
        success: function (data) {
            if (data.success) {
                location.reload(true);
            } else {
                $.notify({
                    message: messageError
                }, {
                    type: 'danger'
                });
            }
        },
        error: function (jxhr, msg, err) {
            $.notify({
                message: messageError
            }, {
                type: 'danger'
            });
        }
    });
});

// аВаИаДаАаЛбб баОаВаАб аЗ аКаОбаИаКаА
$('.card-delete-item-button').click(function() {
    var itemId = $(this).data('item-id'),
        priceId = $(this).data('price-id'),
        url = $(this).data('url'),
        messageError = $(this).data('error-message');

    // аВаИаКаЛаИаКаАбаМаО аПаО аАаДаЖаАаКбб аВбаДаПаОаВбаДаНаИаЙ аЕаКбаН
    $.ajax({
        url: url,
        data: {itemId: itemId, priceId:priceId},
        type: 'POST',
        success: function (data) {
            if (data.success) {
                location.reload(true);
            } else {
                $.notify({
                    message: messageError
                }, {
                    type: 'danger'
                });
            }
        },
        error: function (jxhr, msg, err) {
            $.notify({
                message: messageError
            }, {
                type: 'danger'
            });
        }
    });
});