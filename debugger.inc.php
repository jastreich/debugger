<?php

require_once('bit_field.inc.php');

define('STREAM',1);
define('CONSOLE',2);
define('EMAIL',3);
define('FILE',4);

class debugger
{
  private $method;
  private $email_address;
  private $file_name;

  public function __construct($method = null,$email_address = null,$file_name = null)
  {
    if($method)
    {
      $this->method = $method;
    }
    else
    {
      $this->method = new bit_field();
    }
    $this->email_address = $email_address;
    $this->file_name = $file_name;
  }

  /**
   * Inspector and mutator for the method
   * @param bit_field $bf the bit_field we want to use. If null, the method is just an inspector. Default null.
   * @return the state of the method bit_field before any assignment happens.
   **/
  public function method($bf = null)
  {
    $ret = $this->method;
    if($bf !== null)
    {
      $this->method = $bf;
    }
    return $ret;
  }

  /**
   * Inspector and mutator for the file_name
   * @param string $fn the path to the file we want to use. If null, the method is just an inspector. Default null.
   * @return the state of the file_name before any assignment happens.
   **/
  public function file_name($fn = null)
  {
    $ret = $this->file_name;
    if($fn !== null)
    {
      $this->file_name = $fn;
    }
    return $ret;
  }

  /**
   * Inspector and mutator for the email_address
   * @param string $rm the email address we want to use. If null, the method is just an inspector. Default null.
   * @return the state of the method email address before any assignment happens.
   **/
  public function email_address($em = null)
  {
    $ret = $this->email_address;
    if($em == null)
    {
      $this->email_address = $em;
    }
    return $ret;
  }

  /**
   * Send message out.
   * @param string $str the message to send.
   **/
  public function message($str)
  {
    $str .= "\n";
    if($this->method->get(STREAM))
    {
      echo('<pre>' . htmlspecialchars($str) . '</pre>');
    }
    if($this->method->get(CONSOLE))
    {
      echo('<script type="text/javascript">if(!window.console){console={log: function(){}};}console.log("' . str_replace("\n","\\\n",$str) . '");</script>');
    }
    if($this->method->get(EMAIL))
    {
      if(!$this->email_address)
      {
        echo 'send to who?';
        return false;
      }
      if(!mail($this->email_address, 'Debugger', wordwrap($str,70), "From: " . $this->email_address . "\n"))
      {
        return false;
      }
    }
    if($this->method->get(FILE))
    {
      if(!$this->file_name)
      {
        echo 'hmmm?';
        return false;
      }
      if(file_put_contents($this->file_name, $str, FILE_APPEND | LOCK_EX) === false)
      {
        return false;
      }
    }
    return true;
  }

  /**
   * Dump a variable out.
   * @param mixed $var A variable.
   **/
  public function dump($var)
  {
    $out = var_export($var,true);
    return $this->message($out);
  }
}

?>