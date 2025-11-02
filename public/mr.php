<?php

$fileContent = file_get_contents("mr.csv");
if (!$fileContent) {
    die("تعذر قراءة الملف");
}

// إزالة BOM
$fileContent = preg_replace('/^\xEF\xBB\xBF/', '', $fileContent);

// تقسيم السطور
$lines = preg_split('/\r\n|\n|\r/', trim($fileContent));
array_shift($lines); // إزالة العناوين

$ids = [];
$cards = [];

foreach ($lines as $line) {
    $parts = preg_split('/[\t, ]+/', trim($line));
    if (count($parts) < 2) continue;
    $ids[] = trim($parts[0]);
    $cards[] = trim($parts[1]);
}

$similar = array_values(array_intersect($ids, $cards));
$different = array_values(array_diff(array_unique(array_merge($ids, $cards)), $similar));

echo "عدد المتشابه: " . count($similar) . "\n";
echo "عدد المختلف: " . count($different) . "\n\n";

echo "=== القيم المتشابهة ===\n";
foreach ($similar as $value) {
    echo "- $value\n";
}

echo "\n=== القيم المختلفة ===\n";
foreach ($different as $value) {
    echo "- $value\n";
}
