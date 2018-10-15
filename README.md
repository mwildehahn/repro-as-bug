# Reproduce TypeAssert and `as` issues

To run the reproduction, install dependencies with composer:

```
composer install
```

Run `main.php`

```
 master ➜ hhvm main.php
Array
(
    [type] => test
    [one] => 1
    [fields] => Vec
        (
            [0] => 1
            [1] => 2
            [2] => 3
        )

)

Fatal error: Uncaught exception 'TypeAssertionException' with message 'Expected shape('type' => Types, ...), got array' in /Users/mh/work/repro-as-bug/main.php:40
Stack trace:
#0 /Users/mh/work/repro-as-bug/main.php(25): validate_one()
#1 /Users/mh/work/repro-as-bug/main.php(54): main()
#2 {main}
```
