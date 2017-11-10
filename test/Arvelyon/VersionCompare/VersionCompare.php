<?php
/**
 * This file is part of arvelyon package.
 * @author Michael M Langitan <arvelyon@gmail.com>
 * @copyright 2017
 * @license GPLv2+
 * @version 0.1
 */
namespace Arvelyon\VersionCompare\Test;

class VersionCompare{
  /**
   * apply comparison
   * @param  string $needle   String to compare
   * @param  string $haystack Version target to compared
   * @return boolean
   * @throws InvalidArgumentException When syntax is invalid, then thrown InvalidArgumentException
   * @since 0.1
   */
  static function apply( $needle, $haystack ){
    if( !preg_match( '/^([0-9]+)\.([0-9]+)\.([0-9]+)$/', $haystack, $version ) ){
      throw new \InvalidArgumentException( sprintf('Invalid target version compare "%s".', $haystack) );
    }

    $Parser = new Parser;
    return $Parser->comparison( Lexer::tokenize( $needle ), array_slice($version, 1) );
  }
}
