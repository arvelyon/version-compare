<?php
include "../vendor/autoload.php";

use Arvelyon\VersionCompare\Test\VersionCompare;


// when calling the dump function, usually will showing the file path.
function simpleDump( $return ){
  if( true === $return ){
    echo '<div>boolean true</div>';
  }else if( false === $return ){
    echo '<div>boolean false</div>';
  }
}


try{
  simpleDump( VersionCompare::apply( ">= 2.0", "7.0.1" ) );
}catch( \Exception $e ){
  echo $e->getMessage();
}

try{
  simpleDump( VersionCompare::apply( "< 2.0.*", "0.1.0" ) );
}catch( \Exception $e ){
  echo $e->getMessage();
}

try{
  simpleDump( VersionCompare::apply( ">= 2.3.* and < 3.2", "5.4.0" ) );
}catch( \Exception $e ){
  echo $e->getMessage();
}
