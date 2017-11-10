<?php
/**
 * This file is part of arvelyon package.
 * @author Michael M Langitan <arvelyon@gmail.com>
 * @copyright 2017
 * @license GPLv2+
 * @version 0.1
 */
namespace Arvelyon\VersionCompare\Test;

class TokenStream{
  private $tokens;
  private $position;
  private $end;

  /**
   * @param array $tokens Tokens from class lexer
   * @since 0.1
   */
  function __construct( array $tokens ){
    $this->tokens = $tokens;
    $this->end = count($tokens);
    $this->position = 0;
  }

  /**
   * Get current stream position
   * @since 0.1
   * @return int
   */
  function getPosition(){
    return $this->position;
  }

  /**
   * Play is usualy used for while function
   * @since 0.1
   * @return boolean
   */
  function play(){
    return $this->position < $this->end;
  }

  /**
   * To set the position to end position, usualy used for stop looping while function
   * @since 0.1
   * @return object
   */
  function stop(){
    $this->position = $this->end;
    return $this;
  }

  /**
   * To next position
   * @since 0.1
   * @return object
   */
  function next(){
    ++$this->position;
    return $this;
  }

  /**
   * To get the current token
   * @since 0.1
   * @return array|null When tokens is have current position, then return array. Otherwise null returned
   */
  function current(){
    return $this->look( $this->position );
  }

  /**
   * To get the current type of token
   * @since 0.1
   * @return int|null When tokens is have the current position, then return int ( constant of class TokenType ). Otherwise null returned
   */
  function currentType(){
    if( null !== $token = $this->current() ){
      return $token->getType();
    }

    return null;
  }

  /**
   * To get the current value of token
   * @since 0.1
   * @return array|string|null When tokens is have the current position, then return string or array. Otherwise null returned.
   */
  function currentValue(){
    if( null !== $token = $this->current() ){
      return $token->getValue();
    }

    return null;
  }

  /**
   * To look the token with the parameter of position
   * @since 0.1
   * @return array|null When tokens is have the position, then return array (value of token). Otherwise null returned
   */
  function look( $position ){
    if( isset( $this->tokens[$position] ) ){
      return $this->tokens[$position];
    }

    return null;
  }
}
