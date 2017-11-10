<?php
/**
 * This file is part of arvelyon package.
 * @author Michael M Langitan <arvelyon@gmail.com>
 * @copyright 2017
 * @license GPLv2+
 * @version 0.1
 */
namespace Arvelyon\VersionCompare\Test;

class Parser{
  private $haystack;
  private $comparisonToken;
  private $logicalToken;
  private $lastMatch;

  /**
   * parse version comparison
   * @param  Arvelyon\Component\VersionCompare\TokenStream $TokenStream
   * @param  string $haystack Version target to compared
   * @since 0.1
   * @return boolean
   * @throws InvalidArgumentException
   */
  function comparison( TokenStream $TokenStream, $haystack ){
    $this->haystack = $haystack;

    while( $TokenStream->play() ){
      switch( $TokenStream->currentType() ){
        case TokenType::T_COMPARISON:
          $this->stateComparison( $TokenStream );
        break;
        case TokenType::T_VERSION:
          $this->stateVersion( $TokenStream );
        break;
        case TokenType::T_LOGICAL:
          $this->stateLogical( $TokenStream );
        break;
      }
    }

    if( null !== $this->logicalToken ){
      throw new \InvalidArgumentException( sprintf('Syntax error %s', null === $this->comparisonToken?$this->comparisonToken:$this->logicalToken) );
    }

    return $this->lastMatch;
  }

  /**
   * state comparison token
   * @param  Arvelyon\Component\VersionCompare\TokenStream $TokenStream
   * @since 0.1
   * @throws InvalidArgumentException
   */
  private function stateComparison( $TokenStream ){
    $position = $TokenStream->getPosition();
    $next = $TokenStream->look( $position+1 );

    if( null !== $next && TokenType::T_VERSION == $next->getType() ){
      if( 0 == $position ){
        $this->comparisonToken = $TokenStream->currentValue();
        $TokenStream->next();
        return;
      }
      else{
        $prev = $TokenStream->look($position-1);
        if( TokenType::T_LOGICAL == $prev->getType() ){
          $this->comparisonToken = $TokenStream->currentValue();
          $TokenStream->next();
          return;
        }
      }
    }

    throw new \InvalidArgumentException( sprintf( 'Syntax error. Invalid %s : "%s".', TokenType::toString( $TokenStream->currentType() ), $TokenStream->currentValue() ) );
  }

  /**
   * State logical token
   * @param  Arvelyon\Component\VersionCompare\TokenStream $TokenStream
   * @since 0.1
   * @throws InvalidArgumentException
   */
  private function stateLogical( $TokenStream ){
    $position = $TokenStream->getPosition();
    $next = $TokenStream->look($position+1);

    if(
      0 < $position &&
      null !== $next &&
      ( TokenType::T_COMPARISON == $next->getType() || TokenType::T_VERSION == $next->getType() )
    ){
      $this->logicalToken = $TokenStream->currentValue();
      $TokenStream->next();
      return;
    }

    throw new \InvalidArgumentException( sprintf( 'Syntax error. Invalid %s : "%s".', TokenType::toString( $TokenStream->currentType() ), $TokenStream->currentValue() ) );
  }

  /**
   * State version token
   * @param  Arvelyon\Component\VersionCompare\TokenStream $TokenStream
   * @since 0.1
   * @throws InvalidArgumentException
   */
  private function stateVersion( $TokenStream ){
    $nextToken = $TokenStream->look( $TokenStream->getPosition()+1 );
    if( null !== $nextToken ){
      if( TokenType::T_LOGICAL != $nextToken->getType() ){
        $nextTokenValue = TokenType::T_VERSION != $nextToken->getType()?$nextToken->getValue():implode('.', $nextToken->getValue());
        throw new \InvalidArgumentException( sprintf( 'Syntax error. Invalid %s : "%s".', TokenType::toString( $nextToken->getType() ), $nextTokenValue ) );
      }
    }

    $needle = $TokenStream->currentValue();
    $count = count( $needle );
    if( $count < 2 || $count > 3 ){
      throw new \InvalidArgumentException( sprintf( 'Syntax error. Invalid %s : "%s" , minimal number of version is 2 and max 3.', TokenType::toString( $TokenStream->currentType() ), implode('.', $TokenStream->currentValue()) ) );
    }

    if( 2 == $count ){
      $needle[2] = 0;
    }
    elseif( '*' == $needle[2] ){
      $needle[2] = $this->haystack[2];
    }

    $result = version_compare(
      implode('.', $this->haystack),
      implode('.', $needle),
      in_array( $this->comparisonToken, array( '<=','>=','<','>' ) )?$this->comparisonToken:'=='
    );


    // Logical Operator
    if( null !== $this->logicalToken ){
      switch( strtolower($this->logicalToken) ){
        case 'or': case '||':
          $result = $this->lastMatch || $result;
        break;
        default:
          $result = $this->lastMatch && $result;
      }
    }

    $this->lastMatch = $result;

    $this->comparisonToken = $this->logicalToken = null;
    $TokenStream->next();
  }
}
