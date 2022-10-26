<?php


$rootPath = realpath('./');
$zip = new ZipArchive();
$zip->open('main.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

$files = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($rootPath),
  RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file) {
  if ($name != 'download.php') {
    if (!$file->isDir()) {
      $filePath = $file->getRealPath();
      $relativePath = substr($filePath, strlen($rootPath) + 1);

      $zip->addFile($filePath, $relativePath);
    }
  }
}

$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename = main.zip');
header('Content-Length:' . filesize('main.zip'));
header("Location: index.php");




?>