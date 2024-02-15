<?php
function groupByOwners($files) {
    $result = [];
    foreach ($files as $file => $owner) {
        $result[$owner][] = $file;
    }
    return $result;
}

$files = [
    "Input.txt" => "Randy",
    "Code.py" => "Stan",
    "Output.txt" => "Randy"
];
echo '<pre>';
print_r(groupByOwners($files));
echo '</pre>';