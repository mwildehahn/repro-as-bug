<?hh // strict

require __DIR__.'/vendor/hh_autoload.php';

use namespace Facebook\TypeAssert;

enum Types: string {
  TEST = 'test';
}

type shape_base = shape(
  'type' => Types,
  ...
);

type shape_one = shape(
  'type' => string,
  'one' => int,
  ?'fields' => vec<string>,
  ?'two' => int,
);

function main(): void {
  $test = type_assert_type(
    shape(
      'type' => 'test',
      'one' => 5,
    ),
    shape_one::class,
  );

  if ($test is shape_base) {
    echo "works!\n";
  } else {
    echo "failed!\n";
  }

}

function type_assert_type<T>(mixed $var, typename<T> $expected_type): T {
  $ts = _type_assert_get_type_structure_for_type($expected_type);
  return TypeAssert\matches_type_structure($ts, $var);
}

function _type_assert_get_type_structure_for_type<T>(
  typename<T> $type,
): TypeStructure<T> {
  return /* HH_IGNORE_ERROR[4104] */ type_structure($type);
}

main();
