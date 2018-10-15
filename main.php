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
  $test = generate_one();
  $test2 = validate_one(type_assert_type($test, shape_one::class));
  print_r(['test' => $test, 'test2' => $test2]);
}

function generate_one(): shape_base {
  return shape(
    'type' => 'test',
    'one' => 1,
    'fields' => vec['1', '2', '3'],
  ) as shape_base;
}


function validate_one(shape_one $input): shape_base {
  print_r($input);
  return $input as shape_base;
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
