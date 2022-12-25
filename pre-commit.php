#!/usr/bin/env php
<?php
require 'vendor/autoload.php';


$files = ['HttpClientBasic','HttpClientAuth'];

$data = [];


foreach ($files as $file) {
  $filePhp = 'tests/bin/'.$file.'.php';
  $data[$file] = [
      'src' => file_get_contents($filePhp),
      'out' => safe(shell_exec('php ' . $filePhp))
  ];
}

$coreMd = file_get_contents('docs/core_.md');
foreach ($files as $file) {
    $coreMd = str_replace('{{{ '.$file.' }}}',
        "\n\n```php\n" . trim($data[$file]['src']) . "\n```\n"
        ."<details><summary>See the response result</summary>\n\n"
        . "output:\n```\n" . $data[$file]['out']
        . "```\n"
        . "</details>\n",
        $coreMd
    );
}

file_put_contents('docs/core.md', $coreMd);

function safe(string $s): string {

  return preg_replace('~\d+.\d+.\d+.\d++~', 'xx.xx.xx.xx', $s);
}