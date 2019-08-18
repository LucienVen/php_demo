<?php

require 'vendor/autoload.php';

define('FILE_PATH', __DIR__ . '/File');

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

$file = FILE_PATH . '/read.csv';

$spreadsheet = $reader->load($file);

$sheetData = $spreadsheet->getActiveSheet()->toArray();
print_r($sheetData);

