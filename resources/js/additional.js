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
window.checkStep=function (target){

    var status=0;
    var parent=target.parent().parent();
    var stepPhase=Number(parent.attr('stepPhase'));
    parent.find('input').each(function (){
        if($(this).val() === ''){
            status=1;
            return false;
        }
    });
    if(status === 0){
        var newStepPhase = stepPhase + 1;
        $('[stepPhase="'+newStepPhase+'"]').removeClass('divDisabled');

    }

    //
    // var counter=0;
    // $('.stepPhase .'+target+':not(:first-child)').each(function (){
    //     $(this).addClass('divDisabled');
    //     counter+1;
    // });
}
