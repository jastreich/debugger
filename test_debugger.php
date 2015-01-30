Test Debbuger.

<?php

  require_once('debugger.inc.php');
  $m = new bit_field();
  if(isset($_GET['debug']))
  {
    $m->set(EMAIL);
    $m->set(CONSOLE);
    $m->set(STREAM);
    $m->set(FILE);
  }
  $debug = new debugger($m,'jastreich@gmail.com','test_dbg');
  $debug->message('Hello World.');
  $debug->dump(array( 'a' => 'apple', 'b' => 'banana', 'c' => 'cat' ));
?>