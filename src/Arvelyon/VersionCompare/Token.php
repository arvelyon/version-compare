<?php
/**
 * This file is part of arvelyon package.
 * @author Michael M Langitan <arvelyon@gmail.com>
 * @copyright 2017
 * @license GPLv2+
 * @version 0.1
 */
namespace Arvelyon\VersionCompare;

class Token{
  private $type;
  private $value;

  /**
   * @param int $type  Constant of class TokenType
   * @param string|array $value Value for the token
   * @since 0.1
   */
  function __construct( $type, $value ){
    $this->type = $type;
    $this->value = $value;
  }

  /**
   * Get the type of token
   * @since 0.1
   * @return int Constant of class TokenType
   */
  function getType(){
    return $this->type;
  }

  /**
   * Get value of token
   * @since 0.1
   * @return string|array
   */
  function getValue(){
    return $this->value;
  }
}
