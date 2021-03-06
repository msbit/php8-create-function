<?php

namespace Msbit;

function create_function(string $args, string $code): string {
  static $salt = null;
  $salt ??= bin2hex(random_bytes(64));

  $hash = hash('sha512', "({$args}) {{$code}} | {$salt}");
  $name = "lambda_{$hash}";

  if (!function_exists($name)) {
    eval("function {$name} ({$args}) {{$code}}");
  }

  return $name;
}
