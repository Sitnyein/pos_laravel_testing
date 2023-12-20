$(document).ready(function() {

    $("#subname").trigger(summary() );



   $('.btn-plus').click(function() {
   $parentNode = $(this).parents("tr");
   $price = $parentNode.find("#price").text().replace("mmk","") * 1 ;
   $qty = $parentNode.find("#qty").val();
   $parentNode.find('#totalprice').html($price * ($qty*1) + " mmk");
   summary();
   })

   $('.btn-minus').click(function() {
    $parentNode = $(this).parents("tr");
    $price = $parentNode.find("#price").text().replace("mmk","") * 1 ;
   $qty = $parentNode.find("#qty").val();
   $parentNode.find('#totalprice').html($price * ($qty*1) + " mmk");
    summary();
})

//btn remove
$('.btnremove').click(function() {
    $parentNode = $(this).parents("tr");
    $parentNode.remove();
    summary();
})

function summary() {
     $pricetotal = 0;
   $('#datatable tbody tr').each(function(index,row) {
       $pricetotal += Number($(row).find('#totalprice').text().replace("mmk",""));
   })

  $('#subtotal').html($pricetotal + " mmk");
  $('#finalprice').html($pricetotal + 3000 * 1 +  " mmk")
}

})
