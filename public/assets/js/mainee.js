$(".menu-list li a").mouseover( function() { // Changes the .image-holder's img src to the src defined in .list a's data attribute.
    var value=$(this).attr('data-src');
    $(".menu-image-holder img").attr("src", value);
})

  $(".menu-list li a").mouseout( function() {
    $( '.menu-image-holder img' ).attr("src","https://cdn11.bigcommerce.com/s-pl8vz9wzk5/product_images/uploaded_images/richloomcontract-woodblues.jpg?t=1578333795&_ga=2.211657687.376859109.1578324369-774153706.1570131906");
  });


 

