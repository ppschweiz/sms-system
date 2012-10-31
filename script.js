function doChild(me,childID){
  //alert("- "+me+" -");
  if (me) {
    hide(childID);
  } else {
    show(childID);
  }
}
//////////////////////////////////////////////////////////////
function hide(childID) {
	document.getElementById(childID).style.display = 'none';
}
//////////////////////////////////////////////////////////////
function show(childID) {
	document.getElementById(childID).style.display = 'block';
}
//////////////////////////////////////////////////////////////
function testChars() {
  var f=document.getElementById("content");
  var value = f.value.length;
  if (value<6) {
    alert("The message must have at least 6 chars.");
    return false;
  }
  if (value>160) {
    alert("The message cannot have more than 160 chars.");
    return false;
  }
    return true;
}
//////////////////////////////////////////////////////////////
function showChars(f) {
    f.charsCount.value = f.content.value.length;
    return true;
}