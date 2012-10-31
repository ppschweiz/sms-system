<?php

/*header("Content-Type: text/html; charset=utf-8");
ini_set  ( "mbstring.internal_encoding","utf-8");
/*iconv_set_encoding("internal_encoding", "utf-8");
iconv_set_encoding("output_encoding", "utf-8");
iconv_set_encoding("input_encoding", "utf-8");*/
  include("contacts.php");
  include("config.php");
  include("lib.php");
  
?>
<html>
<head>
<title>Pirate-SMS</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<script language="JavaScript" type="text/javascript" src="script.js" /></script>


</head>

<body>
<b>Be aware: These numbers are not for public use if not stated otherwise!</b>
<form action="" method="post" onSubmit="return testChars()">
<table><tr><td>

<?php
  $allContacts = addContacts();
  
  $recievers = postdef("reciever");
  if (!empty($f)) {
    $msg = postdef("content");
    $queue=array();
    $i=0;
    $allContacts->trysend($queue,$recievers,$i);
    echo "<div style='background-color:#DDD'><p style='color:#0D0'>Sending message <i>$msg</i> to the following mobile phone(s): ";
    foreach ($queue as $q) {
      echo "<li>".$q->caption()."</li>";
	}
    echo "</ul></p></div>";
    SMS::send($queue,$msg);
    //echo $msg;
  }
  
  echo "<b>Remaining credits: ".SMS::credits()."</b>";
?>
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
$allContacts->prnt();
?>
</td>
</tr>
</table>
</form>
</body>
</html>
