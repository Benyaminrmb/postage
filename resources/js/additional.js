$(document).ready(function () {
    stepPhase('card');
});
window.stepPhase=function (target){

    var counter=1;
    $('.stepPhase .'+target).each(function (){
        $(this).attr('stepPhase',counter);
        if(counter !== 1){
            $(this).addClass('divDisabled');
        }
        counter=counter+1;
    });
}
window.checkValue=function(target) {
    if (target.val() === '') {
        target.addClass('is-invalid');
        target.keydown(function () {
            target.removeClass('is-invalid');
        })
        return false;
    }
    return true;
}
window.checkStep=function (target){

    var status=0;
    var parent=target.parent().parent();
    var stepPhase=Number(parent.attr('stepPhase'));

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

    parent.find('input').each(function (){

        if(checkValue($(this)) === false){
            status=1;
            return false;
        }else{
            stepAddOrRemove();
        }
    });
    if(status === 0){

        var newStepPhase = stepPhase + 1;
        $('[stepPhase="'+newStepPhase+'"]').removeClass('divDisabled');
    }else{
        parent.parent().find('input').each(function (){
            stepAddOrRemove();
        });
    }

}

window.spinnerAppend=function (targert,status=true){
    if(!status){
        targert.find('.spinner-border').remove();
        targert.find('.detail').removeClass('d-none');
    }else{
        targert.find('.detail').addClass('d-none');
        targert.append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    }
}

window.modalKeyValue=function (key,value){
    var code=null;
    return code='<div class="w-100 d-block border-bottom p-2"><span>'+key+' : </span><span>'+value+'</span></div>';
}
window.openModalShipmentList=function (thiss,shipmentId,route){
    spinnerAppend(thiss);
    var baseModal=$('.bd-example-modal-list-lg');
    var baseTitle=baseModal.find('.modal-title');
    var baseBody=baseModal.find('.modal-body');
    var baseFooter=baseModal.find('.modal-footer');

    $.ajax({
        url : route,
        type:'POST',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
            id:shipmentId
        },
        success : function(data){
            spinnerAppend(thiss,false);
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
            originAddress = JSON.parse(fullData.response.data.originAddress);
            destinationAddress = JSON.parse(fullData.response.data.destinationAddress);
            receiverInformation = JSON.parse(fullData.response.data.receiverInformation);
            postalInformation = JSON.parse(fullData.response.data.postalInformation);


            baseTitle.html('درخواست مرسوله شماره'+fullData.response.data.id);

            var newBody=null;
            newBody='<div class="row justify-content-center"><div class="col-md-10">';

            newBody=newBody+modalKeyValue('کد',fullData.response.data.id);
            newBody=newBody+modalKeyValue('نوع تحویل',fullData.response.data.deliveryType);
            newBody=newBody+modalKeyValue('آدرس مبداء',originAddress.string);
            newBody=newBody+modalKeyValue('آدرس مقصد',destinationAddress.string);
            newBody=newBody+modalKeyValue('نام درخواست کننده',fullData.response.data.user.name);
            newBody=newBody+modalKeyValue('نام خانوادگی درخواست کننده',fullData.response.data.user.family);
            newBody=newBody+modalKeyValue('شماره تماس درخواست کننده',fullData.response.data.user.mobile);
            newBody=newBody+modalKeyValue('کد ملی درخواست کننده',fullData.response.data.user.nationalCode);
            newBody=newBody+modalKeyValue('نام تحویل گیرنده',receiverInformation.name);
            newBody=newBody+modalKeyValue('نام خانوادگی تحویل گیرنده',receiverInformation.family);
            newBody=newBody+modalKeyValue('شماره تماس تحویل گیرنده',receiverInformation.mobile);
            newBody=newBody+modalKeyValue('کد ملی تحویل گیرنده',receiverInformation.nationalCode);
            newBody=newBody+modalKeyValue('نام مرسوله',postalInformation.name);
            newBody=newBody+modalKeyValue('تعداد مرسولات',postalInformation.count);
            newBody=newBody+modalKeyValue('وزن مرسوله',postalInformation.weight);
            newBody=newBody+modalKeyValue('حجم مرسوله',postalInformation.volume);
            newBody=newBody+'</div></div>';
            baseBody.html(newBody);
        },
        error : function(error){
            console.log(error);

        }
    });
}