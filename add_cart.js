$(document).ready(function(){
    $("button").click(function(event){
        var addCart = $(event.target);
        if(addCart.hasClass("addCart")==true){
            addCart=$(event.target).val();//pairnoume to product id
        }else{
            return;
        }
        $.post("addcart.php",{
            CartItem: addCart
        },function(data,status){
            $("#AddNoti").html(data);
        });
    });
});