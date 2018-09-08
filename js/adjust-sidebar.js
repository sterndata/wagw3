function wagw_adjust_sidebar() {
  var divh = document.getElementById('primary').clientHeight;
  var sb1 = document.getElementById('secondary').clientHeight;
  if ((sb1 < divh) && (document.getElementById('page').clientWidth > 600)) {
     document.getElementById('secondary').style.height=divh+"px";
  }
}
