<?php

$test_value = [
    [3, 5, 6, -12, -10, -14],
    [3, 5, 8],
    [0, 3],
    [-1, 3, 4, 5, 8],
    [-1, 3, 7, 5, 10],
];


function getArraySumWithinNumbers(array $arr) {
    $count = count($arr);
    $pos = [0, 1];
    $test_nr = 0;
    while ($test_nr++ < 100) {
        $sum = sumValuesByKeys($pos, $arr);
        $result_arr = [];
        $match_number_arr = unsetValuesByKeys($pos, $arr);

        if (in_array($sum, $match_number_arr)) {
            $result_arr = getValuesByKeys($pos, $arr);
            $result_arr[] = $sum;
            return $result_arr;
        }

        $continue = increaseKey($pos, $count);
        if (!$continue) {
            return [];
        }
    }
}


// TODO: when smaler key is increase than larger key should reset to
// smaller key + 1
function increaseKey(&$keys, $count) {
    $n = 0;
    $key_count = count($keys);
    for ($i = $key_count - 1; $i >= 0; $i--) {
        $n++;
        if ($keys[$i] + $n < $count) {
            $keys[$i]++;
            for ($m = 1; $m < $n; $m++) {
                $keys[$i + $m] = $keys[$i] + $m;
            }
            return true;
        }
    }

    return false;
}

function getValuesByKeys(array $keys, array $arr) :array {
    $result = [];
    foreach ($keys as $key) {
        $result[] = $arr[$key];
    }
    return $result;
}

function unsetValuesByKeys($keys, $arr) {
    foreach ($keys as $key) {
        unset($arr[$key]);
    }
    return $arr;
}

function sumValuesByKeys($keys, $arr) {
    $sum = 0;
    foreach ($keys as $key) {
        $sum += $arr[$key];
    }
    return $sum;
}

foreach ($test_value as $arr) {
    // getArraySumWithinNumbers($arr);
    echo json_encode($arr) . '<pre>'. print_r(getArraySumWithinNumbers($arr), true) . '</pre>';
}