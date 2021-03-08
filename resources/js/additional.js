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

window.modalKeyValue = function (key, value,classes=null) {
    var code = null;
    return code = '<ul>\n' +
        '<li class="text-right pr-2">' + key + ' : </li>\n' +
        '<li class="text-left pl-2 '+classes+'">' + value + '</li>\n' +
        '</ul>';
}
window.openModalShipmentList = function (thiss, shipmentId, route) {
    spinnerAppend(thiss);
    var baseModal = $('.bd-example-modal-list-lg');
    var baseTitle = baseModal.find('.modal-title');
    var baseBody = baseModal.find('.modal-body');
    var baseFooter = baseModal.find('.modal-footer');

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



            if(fullData.response.data.accessId === 'denied'){
                newBody = '<div class="col-md-12 flex-wrap d-flex">\n' +
                    '<div class="col-md-4 ">\n' +
                    '<div class="ship_div card  border border-light text-center">\n' +
                    '<span\n' +
                    'class="shipmentTitles-main d-block card-header text-light bg-dark text-right p-2 border-bottom">aw dawd</span>\n' +
                    '<div class="card-body p-0">';


                newBody = newBody + modalKeyValue('کد', fullData.response.data.id);
                newBody = newBody + modalKeyValue('نوع تحویل', fullData.response.data.deliveryType);
                newBody = newBody + modalKeyValue('دسترسی شما', fullData.response.data.access,'text-danger');
                newBody = newBody + modalKeyValue('تاریخ درخواست', fullData.response.data.created_at.date);
                newBody = newBody + modalKeyValue('ساعت درخواست', fullData.response.data.created_at.time);

                newBody = newBody+'</div>\n' +
                    '</div>\n' +
                    '</div></div>';


            }else{
                originAddress = JSON.parse(fullData.response.data.originAddress);
                destinationAddress = JSON.parse(fullData.response.data.destinationAddress);
                receiverInformation = JSON.parse(fullData.response.data.receiverInformation);
                postalInformation = JSON.parse(fullData.response.data.postalInformation);
            }



           /* newBody = '<div class="row justify-content-center"><div class="col-md-10">';

            newBody = newBody + modalKeyValue('کد', fullData.response.data.id);
            newBody = newBody + modalKeyValue('نوع تحویل', fullData.response.data.deliveryType);
            newBody = newBody + modalKeyValue('آدرس مبداء', originAddress.string);
            newBody = newBody + modalKeyValue('آدرس مقصد', destinationAddress.string);
            newBody = newBody + modalKeyValue('نام درخواست کننده', fullData.response.data.user.name);
            newBody = newBody + modalKeyValue('نام خانوادگی درخواست کننده', fullData.response.data.user.family);
            newBody = newBody + modalKeyValue('شماره تماس درخواست کننده', fullData.response.data.user.mobile);
            newBody = newBody + modalKeyValue('کد ملی درخواست کننده', fullData.response.data.user.nationalCode);
            newBody = newBody + modalKeyValue('نام تحویل گیرنده', receiverInformation.name);
            newBody = newBody + modalKeyValue('نام خانوادگی تحویل گیرنده', receiverInformation.family);
            newBody = newBody + modalKeyValue('شماره تماس تحویل گیرنده', receiverInformation.mobile);
            newBody = newBody + modalKeyValue('کد ملی تحویل گیرنده', receiverInformation.nationalCode);
            newBody = newBody + modalKeyValue('نام مرسوله', postalInformation.name);
            newBody = newBody + modalKeyValue('تعداد مرسولات', postalInformation.count);
            newBody = newBody + modalKeyValue('وزن مرسوله', postalInformation.weight);
            newBody = newBody + modalKeyValue('حجم مرسوله', postalInformation.volume);
            newBody = newBody + '</div></div>';*/
            baseBody.html(newBody);


            var baseTitle_main = baseModal.find('.shipmentTitles-main');
            baseTitle.html('درخواست مرسوله شماره ' + fullData.response.data.id);
            baseTitle_main.html('اطلاعات پایه');

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
            let fullData = null;
            try {
                fullData = JSON.parse(data);

            } catch (e) {
                fullData = data;
            }

            var i;
            var options;
            for (i = 0; i < fullData.response.data.length; i++) {
                if (fullData.response.data[i].title !== 'undefined') {
                    options = options + '<option value="' + fullData.response.data[i].id + '">' + fullData.response.data[i].title + '</option>';
                }
            }
            $(targetResultData).html(options);
        },
        error: function (error) {
            console.log(error);

        }
    });

}


