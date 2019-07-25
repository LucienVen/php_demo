<?php
$start_time = time();
$arr = [
    [
        'id' => 1,
        'hot' => 11,
    ],
    [
        'id' => 10,
        'hot' => 9,
    ],
    [
        'id' => 7,
        'hot' => 5,
    ],
    [
        'id' => 3,
        'hot' => 4,
    ],
    [
        'id' => 2,
        'hot' => 17,
    ],
    [
        'id' => 4,
        'hot' => 8,
    ],
];

// 快排实现
function dsort($arr)
{
    $len = count($arr);

    if ($len <= 1) {
        return $arr;
    }

    $target_id = 0;
    $target_value = $arr[$target_id]['hot'];

    $right = $left = [];

    for ($i=1; $i < $len; $i++) {
        if ($arr[$i]['hot'] > $target_value) {
            $right[] = $arr[$i];
        } else {
            $left[] = $arr[$i];
        }
    }

    // 递归
    $left = dsort($left);
    $right = dsort($right);

    return array_merge($left, [$arr[$target_id]], $right);
}

print_r(dsort($arr));


// array_multisort 实现
// foreach ($arr as $key => $value) {
//     $hot[$key] = $value['hot'];
// }

// array_multisort($hot, SORT_ASC, $arr);
// print_r($arr);


// array_multisort + array_cloumn 实现
// array_multisort(array_column($arr, 'hot'), SORT_ASC, $arr);
// print_r($arr);
