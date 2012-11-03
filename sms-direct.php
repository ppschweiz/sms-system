<?php
  require_once("lib.php");
?>
﻿<html>
<head><title>Pirate-SMS</title>
<script language="JavaScript" type="text/javascript" src="script.js" /></script>


</head>

<body>
<form action="" method="post" onSubmit="return testChars()">
<table><tr><td>

<?php


  $f = postdef("reciever");
  if (!empty($f)) {
	$msg = postdef("content");
    SMS::send(array($f),$msg);
    echo "<p style='color:#F00'>Message <i>$msg</i> sent to the following mobile phone: $f";
    echo "</p>";
  }

  
  echo "<b>Remaining credits: ".SMS::credits()."</b>";
?>
  <p>

  Reciever<br>
  00<input type="text" name="recipient" value="417">
  </p>

  <!--Sender:<br>
  <input type="text" name="originator" value="sms@st-urs.org">
  </p>-->
  
  <p>

  Text:<br>
  <textarea name="content" id="content" rows="6" cols="33" wrap="soft" onKeyUp="return showChars(this.form);"></textarea>
  </p>
  <p>
    characters:
    <input name="charsCount" value="0" size="3" disabled> (max 160)
  </p>

  <input type="submit" name="send" value="send SMS">

</td><td>

<?php
//$all->prnt();
?>
</td>
</tr>
</table>
</form>
</body>
</html>
