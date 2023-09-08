
function addToCart(id, userId) {
  var size = $('#size-product').val();
  var quantity = $('#product-quantity').val();
  $.ajax({
    type: "post",
    url: DOMAIN_URL + 'add-cart',
    data: {
      'id': id,
      'user_id': userId,
      'size': size,
      'quantity': quantity
    },
    dataType: "json",
    success: function (result) {
      if (result) {
        alert('add cart successfully');
      }
    },
    error: function (e) {
      console.log(e);
    }
  });
}