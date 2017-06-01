<?php
$root = '.';
$iter = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
  RecursiveIteratorIterator::SELF_FIRST,
  RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
);

$paths = array($root);
foreach ($iter as $path => $dir) {
  if ($dir->isDir()) {
    $paths[] = $path;
  }
}

foreach ($paths as $path) {
  $index = $path."/index.html";
  if(!file_exists($index)) {
    file_put_contents($index, join("\n", array(
      '<!DOCTYPE html>',
      '<html>',
      '<head>',
      '<title>403 Forbidden</title>',
      '</head>',
      '<body>',
      '<p>Directory access is forbidden.</p>',
      '</body>',
      '</html>'
    )));
    echo $index."<br>";
  }
}

?>
