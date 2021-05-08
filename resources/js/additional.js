$(document).ready(function () {
    stepPhase('card');
    $('.simpleSelect2').select2({
        dir: 'rtl',
        width: 'resolve',
    });
});
window.stepPhase = function (target) {

    var counter = 1;
    $('.stepPhase .' + target).each(function () {
        $(this).attr('stepPhase', counter);
        if (counter !== 1) {
            $(this).addClass('divDisabled');
        }
        counter = counter + 1;
    });
}
window.checkValue = function (target) {
    if (target.val() === '') {
        target.addClass('is-invalid');
        target.keydown(function () {
            target.removeClass('is-invalid');
        })
        return false;
    }
    return true;
}
window.checkStep = function (target) {

    var status = 0;
    var parent = target.parent().parent();
    var stepPhase = Number(parent.attr('stepPhase'));

    function stepAddOrRemove() {
        parent.parent().find('input').each(function () {
            if (checkValue($(this)) === false) {
                //.card ro inja statick zadam ...
                var thisStepPhase = Number($(this).parents('.card').attr('stepPhase'));
                var newThisStepPhase = thisStepPhase + 1;
                $('[stepPhase="' + newThisStepPhase + '"]').addClass('divDisabled');
                return false;
            }
        });
    }

    parent.find('input').each(function () {

        if (checkValue($(this)) === false) {
            status = 1;
            return false;
        } else {
            stepAddOrRemove();
        }
    });
    if (status === 0) {

        var newStepPhase = stepPhase + 1;
        $('[stepPhase="' + newStepPhase + '"]').removeClass('divDisabled');
    } else {
        parent.parent().find('input').each(function () {
            stepAddOrRemove();
        });
    }

}

window.spinnerAppend = function (targert, status = true) {
    if (!status) {
        targert.removeClass('disabled');
        targert.find('.spinner-border').remove();
    } else {
        targert.addClass('disabled');
        targert.find('.detail').append('<span class="mySpinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    }
}

window.modalKeyValue = function (key, value, classes = null) {
    var code = null;
    return code = '<ul>\n' +
        '<li class="text-right pr-2">' + key + ' : </li>\n' +
        '<li class="text-left pl-2 ' + classes + '">' + value + '</li>\n' +
        '</ul>';
}

window.removeBtnClasses = function (thiss) {
    thiss.removeClass('btn-danger' +
        ' btn-primary' +
        ' btn-success' +
        ' btn-info' +
        ' btn-warning' +
        ' btn-outline-info' +
        ' btn-outline-warning' +
        ' btn-outline-secondary' +
        ' btn-outline-success' +
        ' btn-outline-danger' +
        ' btn-secondary');
}
window.stepStatusClass = function (stepStatus) {
    if(stepStatus === 'notApproved'){
        return 'btn-outline-warning';
    }
    if(stepStatus === 'onProcess'){
        return 'btn-outline-warning';
    }
    if(stepStatus === 'getProduct'){
        return 'btn-outline-info';
    }
    if(stepStatus === 'onTheWay'){
        return 'btn-outline-primary';
    }
    if(stepStatus === 'receivedByTheRecipient'){
        return 'btn-outline-success';
    }
    if(stepStatus === ''){
        return 'btn-outline-success';
    }
}
window.changeModalBtnAction = function (thiss, action) {
    removeBtnClasses(thiss);
    thiss.prop('disabled', false);

    if (action === 'create') {
        thiss.addClass('btn-primary');
        thiss.find('.detail').html('ارسال درخواست');
        thiss.attr('data-order-action', 'create');
    }
    if (action === 'remove') {
        thiss.addClass('btn-danger');
        thiss.find('.detail').html('انصراف از درخواست');
        thiss.attr('data-order-action', 'remove');
    }
    if (action === 'granted') {
        thiss.prop('disabled', true);
        thiss.addClass('btn-success');
        thiss.find('.detail').html('دسترسی داده شد');
        thiss.attr('data-order-action', '');
    }
}
window.openModalShipmentList = function (thiss, shipmentId) {
    spinnerAppend(thiss);
    var baseModal = $('.bd-example-modal-list-lg');
    var route = thiss.attr('data-route');
    var baseTitle = baseModal.find('.modal-title');
    var baseBody = baseModal.find('.modal-body');
    var baseFooter = baseModal.find('.modal-footer');
    var orderBtn = baseModal.find('[data-name="sendShipmentOrder"]');
    var externalShipmentLink = $('#externalShipmentLink');
    externalShipmentLink.attr('href', externalShipmentLink.attr('data-route') + '/' + shipmentId);
    orderBtn.attr('data-shipment-id', shipmentId);

    if(thiss.hasClass('btn-info')){
        thiss.removeClass('btn-info');
    }

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: shipmentId
        },
        success: function (data) {
            spinnerAppend(thiss, false);
            $('.bd-example-modal-list-lg').modal('show');
            let fullData = null;
            try {
                fullData = JSON.parse(data);

            } catch (e) {
                fullData = data;
            }
            let originAddress = null;
            let destinationAddress = null;
            let receiverInformation = null;
            let postalInformation = null;
            var newBody = null;

            if (fullData.response.data.ordered_at === null) {
                changeModalBtnAction(orderBtn, 'create');
            } else {
                if (fullData.response.data.accessId === 'granted') {
                    changeModalBtnAction(orderBtn, 'granted');
                } else {
                    changeModalBtnAction(orderBtn, 'remove');
                }
            }

            if (fullData.response.data.accessId === 'denied') {
                newBody = '<div class="col-md-12 flex-wrap d-flex">\n' +
                    '<div class="col-md-4 mb-2">\n' +
                    '<div class="ship_div card  border border-light text-center">\n' +
                    '<span\n' +
                    'class="shipmentTitles-main d-block card-header text-light bg-dark text-right p-2 border-bottom">' +
                    'اطلاعات پایه' +
                    '</span>\n' +
                    '<div class="card-body p-0">';


                newBody = newBody + modalKeyValue('کد', fullData.response.data.id);
                newBody = newBody + modalKeyValue('نوع تحویل', fullData.response.data.deliveryType);

                newBody = newBody + modalKeyValue('دسترسی شما', fullData.response.data.access.title, fullData.response.data.access.class);
                newBody = newBody + modalKeyValue('تاریخ درخواست', fullData.response.data.created_at.date);
                newBody = newBody + modalKeyValue('ساعت درخواست', fullData.response.data.created_at.time);

                newBody = newBody + '</div>\n' +
                    '</div>\n' +
                    '</div></div>';


            }
            if (fullData.response.data.accessId === 'granted') {
                receiverInformation = JSON.parse(fullData.response.data.shipment.receiverInformation);


                newBody = '<div class="col-md-12 flex-wrap d-flex">\n' +
                    '<div class="col-md-12 mb-2">\n' +
                    '<div class="ship_div card  border border-light text-center">\n' +
                    '<span\n' +
                    'class="shipmentTitles-main d-block card-header text-light bg-dark text-right p-2 border-bottom">' +
                    'اطلاعات پایه' +
                    '</span>\n' +
                    '<div class="card-body p-0">';


                newBody = newBody + modalKeyValue('کد', fullData.response.data.id);
                newBody = newBody + modalKeyValue('نوع تحویل', fullData.response.data.deliveryType);

                newBody = newBody + modalKeyValue('دسترسی شما', fullData.response.data.access.title, fullData.response.data.access.class);
                newBody = newBody + modalKeyValue('تاریخ درخواست', fullData.response.data.created_at.date);
                newBody = newBody + modalKeyValue('ساعت درخواست', fullData.response.data.created_at.time);

                newBody = newBody + '</div>\n' +
                    '</div>\n' +
                    '</div>';


                newBody = newBody + '<div class="col-md-12 mb-2">\n' +
                    '<div class="ship_div card  border border-light text-center">\n' +
                    '<span\n' +
                    'class="shipmentTitles-main d-block card-header  text-light bg-dark text-right p-2 border-bottom">' +
                    'مشخصات درخواست کننده' +
                    '</span>\n' +
                    '<div class="card-body p-0">';


                newBody = newBody + modalKeyValue('نام', fullData.response.data.user.name);
                newBody = newBody + modalKeyValue('نام خانوادگی', fullData.response.data.user.family);
                newBody = newBody + modalKeyValue('کد ملی', fullData.response.data.user.nationalCode);
                newBody = newBody + modalKeyValue('جنسیت', fullData.response.data.user.gender);
                newBody = newBody + modalKeyValue('شماره همراه',
                    '<a title="شماره همراه" href="tel:' + fullData.response.data.user.mobile + '">'
                    + fullData.response.data.user.mobile +
                    '</a>', 'btn-link');

                newBody = newBody + modalKeyValue('شماره ثابت',
                    '<a title="شماره ثابت" href="tel:' + fullData.response.data.user.telephone + '">'
                    + fullData.response.data.user.telephone +
                    '</a>', 'btn-link');

                newBody = newBody + modalKeyValue('ایمیل',
                    '<a title="ایمیل" href="mailto:' + fullData.response.data.user.email + '">'
                    + fullData.response.data.user.email +
                    '</a>', 'btn-link');

                newBody = newBody + '</div>\n' +
                    '</div>\n' +
                    '</div>';


                newBody = newBody + '<div class="col-md-12 mb-2">\n' +
                    '<div class="ship_div card  border border-light text-center">\n' +
                    '<span\n' +
                    'class="shipmentTitles-main d-block card-header  text-light bg-dark text-right p-2 border-bottom">' +
                    'مشخصات دریافت کننده' +
                    '</span>\n' +
                    '<div class="card-body p-0">';


                newBody = newBody + modalKeyValue('نام', receiverInformation.name);
                newBody = newBody + modalKeyValue('نام خانوادگی', receiverInformation.family);
                newBody = newBody + modalKeyValue('کد ملی', receiverInformation.nationalCode);
                newBody = newBody + modalKeyValue('شماره همراه',
                    '<a title="شماره همراه" href="tel:' + receiverInformation.mobile + '">'
                    + receiverInformation.mobile +
                    '</a>', 'btn-link');


                newBody = newBody + '</div>\n' +
                    '</div>\n' +
                    '</div></div>';


            }
            baseBody.html(newBody);


            baseTitle.html('درخواست مرسوله شماره ' + fullData.response.data.id);

        },
        error: function (error) {
            console.log(error);

        }
    });
}

window.getStateCities = function (state_id, targetResultData, route) {
    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            state_id: state_id
        },
        success: function (data) {
            let fullData = getFullData(data);
console.log(fullData);

            var i;
            var options;
            for (i = 0; i < fullData.response.data.data.length; i++) {
                if (fullData.response.data.data[i].title !== 'undefined') {
                    options = options + '<option value="' + fullData.response.data.data[i].id + '">' + fullData.response.data.data[i].title + '</option>';
                }
            }
            $(targetResultData).html(options);
        },
        error: function (error) {
            console.log(error);

        }
    });

}

window.getFullData=function (data) {
    try {
        return JSON.parse(data);

    } catch (e) {
        return data;
    }
}

window.toastResponse= function (fullData,timer='3500') {
    swal.fire({
        toast: true,
        timerProgressBar:true,
        position: 'bottom-right',
        timer: timer,
        title: fullData.response.title,
        text: fullData.response.message,
        icon: fullData.response.status,
        confirmButtonText: 'باشه'
    });
}

window.sendShipmentOrder = function (thiss) {
    spinnerAppend(thiss, true);
    var shipment_id = thiss.attr('data-shipment-id');
    var orderAction = thiss.attr('data-order-action');
    var route = thiss.attr('data-' + orderAction);
    var listBtn = $('[data-btn-shipment-list-id="' + shipment_id + '"]');
    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            shipment_id: shipment_id
        },
        success: function (data) {
            spinnerAppend(thiss, false);
            let fullData = getFullData(data);

            if (fullData.response.data.ordered_at === null) {
                listBtn.removeClass('btn-warning');
                changeModalBtnAction(thiss, 'create');

            } else {
                listBtn.removeClass('btn-info').addClass('btn-warning');
                changeModalBtnAction(thiss, 'remove');
            }

            openModalShipmentList(listBtn, shipment_id);
            toastResponse(fullData);
        },
        error: function (error) {
            spinnerAppend(thiss, false);
            var fullError = getFullData(error.responseText);
            $('.bd-example-modal-list-lg').modal('hide');

            toastResponse(fullError);
        }
    });

}
window.changeStepStatus = function (thiss) {
    if(thiss.hasClass('disabled')){
        return false;
    }
    spinnerAppend(thiss, true);
    var thiss_input=thiss.find('input');
    var shipment_id = thiss_input.attr('data-shipment-id');
    var stepStatus = thiss_input.val();
    var route = thiss_input.attr('data-route');
    var listBtn = $('.btnStepStatusGroup');
    listBtn.find('label').each(function (){
        removeBtnClasses($(this));
        $(this).removeClass('active');
        $(this).addClass('disabled');
    });
    thiss.addClass('active');
    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            shipment_id: shipment_id,
            stepStatus: stepStatus
        },
        success: function (data) {
            spinnerAppend(thiss, false);
            let fullData = getFullData(data);

            listBtn.find('label').each(function (){
                removeBtnClasses($(this));
                $(this).addClass(stepStatusClass(fullData.response.data.stepStatus));
                $(this).removeClass('disabled');
            });
            toastResponse(fullData,1500);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
window.addShipmentOptions = function (thiss) {
    var baseShipmentOption=$('.baseShipmentOptionDiv:first');
    var Counter=$('.baseShipmentOptionDiv').length;
    var cloned=baseShipmentOption.clone();
    cloned.find('label').attr('for',cloned.find('label').attr('for')+'_'+Counter);
    cloned.find('input').attr('id',cloned.find('input').attr('id')+'_'+Counter);
    cloned.find('span.closeBtn').removeClass('d-none');
    cloned.find('input').val('');
    $('.baseShipmentOptionDiv:last').after(cloned);
}
window.closeShipmentOptions = function (thiss) {
    thiss.parent('.baseShipmentOptionDiv').remove();
}
window.shipmentTypeChange = function (thiss) {
    var box=$('.shipmentTypeSelectBox');
    if(thiss.val() === 'select'){
        box.removeClass('d-none');
    }else{
        if(!box.hasClass('d-none')){
            box.addClass('d-none')
        }
    }
}
