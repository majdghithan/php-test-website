

$(document).ready(function(){


    ChangeDiv(33);

    function ChangeDiv(value) {
       
            
    }

    // $(".testtt").load(
    //     '/oop-php/payment.php',
    //     {
    //         Name: 'Majd',
    //         Last:'Ghithan',
    //     },
    //     function(){
    //         alert("");
    //     }
    //     )

})


$(document).ready(function(){

   $('input:radio[name=paymentMethod]').change(function(){

    var WhatIsChecked= $(".checked").text();
    console.log("Inner div: " +WhatIsChecked);

    var gg = $(this).prop("checked");
    console.log($(this).val() + " checked:" + gg);

       if(($(this).val() == "paypal" && $(this).prop("checked")) ){
           $("#paypall").show();
           $("#n-paypal").hide();
           console.log('PAYPAL SELECTED CHECKED');
           $(this).prop('checked', 'checked');
        //    $(".checked").text('PAAAAAAAAAAAAAAYPAL');

        $.ajax({
            url: 'payment.php',
            method: 'POST',
            data:{name:'majdd'},
            success:function(data){
                // $(".page").html(data);
            }
        })


       }
       else if(($(this).val() == "card" && $(this).prop("checked")) ){
        $("#paypall").hide();
        $("#n-paypal").show();
        console.log('CREDIT CARD SELECTED CHECKED');
        $(this).prop('checked', 'checked');

        // $('.testtt').load(
        //     '/',
        //     {
        //     name:"majd",
        //     lastname:'K',
        //     },
        //     function () {
        //         alert ('hi');
        //     }
        // )



       }
       else{
           
        $("#paypall").hide();
        $("#n-paypal").hide();
        $(this).removeProp("checked");
        console.log('ee');
    
       }

       

   

   }).trigger( "change" );

})