<?php
/**
 * This file is part of arvelyon package.
 * @author Michael M Langitan <arvelyon@gmail.com>
 * @copyright 2017
 * @license GPLv2+
 * @version 0.1
 */
namespace Arvelyon\VersionCompare;

class Lexer{
  /**
   * To make token from string codes
   * @param  string $codes String codes
   * @since 0.1
   * @return object TokenStream
   */
  static function tokenize( $codes ){
    $cursor = 0;
    $end = strlen($codes);
    $tokens = [];

    while( $cursor < $end ){
      if( preg_match( '/\s+/A', $codes, $match, null, $cursor ) ){
        $cursor += strlen( $match[0] );
      }
      else if( preg_match( '/([0-9]+)\.([0-9]+)(?:\.([0-9]+|\*))?/A', $codes, $match, null, $cursor ) ){
        $cursor += strlen( $match[0] );
        $tokens[] = new Token( TokenType::T_VERSION, array_slice( $match, 1 ) );
      }
      else if( preg_match( '/\>\=|\<\=|\<|\>/A', $codes, $match, null, $cursor ) ){
        $cursor += strlen( $match[0] );
        $tokens[] = new Token( TokenType::T_COMPARISON, $match[0] );
      }
      else if( preg_match( '/and|&&|or|\|\|/Ai', $codes, $match, null, $cursor ) ){
        $cursor += strlen( $match[0] );
        $tokens[] = new Token( TokenType::T_LOGICAL, $match[0] );
      }
      else{
        throw new \InvalidArgumentException( sprintf('Syntax error. Unknown character "%s", no: %d.', $codes[$cursor], $cursor+1) );
      }
    }

    return new TokenStream( $tokens );
  }
}
