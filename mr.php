<?php


// قراءة الملف
$file = fopen("mr.csv", "r");

// تخطي السطر الأول (العناوين)
fgetcsv($file, 0, "\t");

$ids = [];
$cards = [];

// قراءة القيم
while (($data = fgetcsv($file, 0, "\t")) !== false) {
    $id = trim($data[0]);
    $card = trim($data[1]);
    if ($id !== '') $ids[] = $id;
    if ($card !== '') $cards[] = $card;
}
fclose($file);

// استخراج المتشابه والمختلف
$similar = array_values(array_intersect($ids, $cards));
$different = array_values(array_diff(array_unique(array_merge($ids, $cards)), $similar));

// طباعة النتيجة
echo "المتشابه:\n";
print_r($similar);

echo "\nالمختلف:\n";
print_r($different);
