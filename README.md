# version-compare

version-compare is a library to make it easier for you to compare versions where there are some conditions. With comparison operators and also logical operators, you can compare versions of more than one condition.

> We use a version structure like x.y.z and at z position can be emptied or use `*` (Asterisk).

## Writing Version

- `2.4` is equivalent to `2.4.0`
- `2.4.*` is equivalent to `>= 2.4.0` and `<= 2.4.9`

## Comparison Operator

`<` , `>` , `<=` , `>=`

"If you do not use a comparison operator, then it will be considered as a comparator operator equal to"

## Logical Operator

`and` , `AND` , `&&` , `or` , `OR` , `||`

basically we use composer with psr-4 autoloader and here is a basic example of its use.

## Example

``` php
use Arvelyon\VersionCompare\VersionCompare;

try{
  var_dump( VersionCompare::apply( ">= 2.0", "7.0.1" ) );
}catch( \Exception $e ){
  echo $e->getMessage();
}

try{
  var_dump( VersionCompare::apply( "< 2.0.*", "0.1.0" ) );
}catch( \Exception $e ){
  echo $e->getMessage();
}

try{
  var_dump( VersionCompare::apply( ">= 2.3.* and < 3.2", "5.4.0" ) );
}catch( \Exception $e ){
  echo $e->getMessage();
}
```

## License

[GNU General Public License v2.0](https://github.com/arvelyon/version-compare/blob/master/LICENSE)
