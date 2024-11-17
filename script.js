function checkout() {
  var x = new XMLHttpRequest();
  x.onreadystatechange = function () {};
  x.open("GET", "checkout.php", true);
  x.send();
}
