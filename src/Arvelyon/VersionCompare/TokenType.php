<?php
/**
 * This file is part of arvelyon package.
 * @author Michael M Langitan <arvelyon@gmail.com>
 * @copyright 2017
 * @license GPLv2+
 * @version 0.1
 */
namespace Arvelyon\VersionCompare;

class TokenType{
  const T_VERSION = 1;
  const T_LOGICAL = 2;
  const T_COMPARISON = 3;

  /**
   * Token type to string
   * @param  int $type Constant of class TokenType
   * @return string
   * @since 0.1
   */
  static function toString( $type ){
    switch( $type ){
      case self::T_VERSION:
        $result = 'T_VERSION';
      break;
      case self::T_COMPARISON:
        $result = 'T_COMPARISON';
      break;
      case self::T_LOGICAL:
        $result = 'T_LOGICAL';
      break;
      default:
        $result = 'T_UNKNOWN';
    }

    return $result;
  }
}
