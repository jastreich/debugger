<?php
/**
 * @file bit_field.inc.php
 * This file contains the bit_field class.
 * @see https://stackoverflow.com/questions/5380506/improve-this-php-bitfield-class-for-settings-permissions
 **/


/**
 * @class bit_field
 * This class represents a group of binary values.
 **/
class bit_field
{
  private $value;

  /**
   * Constructor for the bit_field object.
   * @param scaler $value the inital bit_field. Default 0.
   **/
  public function __construct($value=0)
  {
    $this->value = $value;
  }

  /**
   * Inspector for the whole field.
   * @return the $value of the whole field.
   **/
  public function get_value()
  {
    return $this->value;
  }

  /**
   * Inspector for each bit.
   * @param int $n the bit to return.
   * @return the state of the $n<sup>th</sup> bit.
   **/
  public function get($n)
  {
    if (is_int($n))
    {
      return ($this->value & (1 << $n)) != 0;
    }
    else
    {
      return 0;
    }
  }

  /**
   * Sets the passed bit to passed state (or true if state note passed)
   * @param int $n the bit to clear.
   * @param bool $new the new value of the bit (default true).
   **/
  public function set($n, $new=true)
  {
    $this->value = ($this->value & ~(1 << $n)) | ($new << $n);
  }

  /**
   * Clears the passed bit. ( convience function calls bit_filed::set() )
   * @param int $n the bit to clear
   **/
  public function clear($n) {
    $this->set($n, false);
  }
}
?>