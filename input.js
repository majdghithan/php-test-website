
$(document).ready(function(){

    $('#quantity').keyup(function(){
     
     var value = $("#quantity").val();
   
     if(value == ''){
       console.log("cant be empty");
     }
     else{
         
       $.ajax({
         type: 'POST',
         url: 'cart.php', 
         cache:false,
         data:{
           value:$("#quantity").val(),
           name:$('#product_name').text(),
         },
         success: function(data){
           console.log('done');
         },
         
       })

       
     }
   
    })
   
   })