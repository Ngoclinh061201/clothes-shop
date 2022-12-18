
function addToCart(id, userId) {
  var domain = window.location.href
  let result = domain.replace(/[.*+?^${}()|[\]\\#]/gi, function (x) {
    return '';
  });
  if (typeof userId == 'undefined') {
    window.location.href = result + 'login';
  }
  let url = result.split("/");
  let lengthUrl = url.length;
  url.splice(lengthUrl - 2, lengthUrl - 1);
  let urlNew = url.join('/');
  urlNew = urlNew + '/add-cart'
  $.ajax({
    type: "post",
    url: urlNew,
    data: {
      'id': id,
      'user_id': userId
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