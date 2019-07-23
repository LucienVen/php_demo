<?php

class Sort
{

    private $arr = [];

    public function __construct()
    {
        $this->arr = [18, 23, 6, 99, 2, 3, 10, 100];
    }

    /**
     * 快排实现
     */
    public function quickSort($arr)
    {
        $len = count($arr);

        if ($len <= 1) {
            return $arr;
        }

        // 选择基准元素
        $target = $arr[0];

        // 初始化左右数组
        $right = $left = array();

        // 遍历除基准元素外的所有元素，按照大小关系放入左右数组
        for ($i=1; $i < $len; $i++) { 
            // 从小到大排序
            if ($arr[$i] < $target) {
                $left[] = $arr[$i];
            }else{
                $right[] = $arr[$i];
            }
        }

        // 递归
        $left = $this->quickSort($left);
        $right = $this->quickSort($right);

        // 合并
        return array_merge($left, [$target], $right);
    }

    /**
     * 冒泡排序实现
     */
    public function bubbleSort($arr)
    {
        $len = count($arr);
        

        for ($i=1; $i < $len; $i++) { 
            for ($k=0; $k < $len - $i; $k++) { 
                // echo '$i = ', $i, ' <> ', '$k = ', $k, "\n";
                // 交换
                // echo '$k = ', $arr[$k], ' <> ', '$k+1 = ', $arr[$k+1], "\n";

                if ($arr[$k] < $arr[$k+1]) {
                    $temp = $arr[$k];
                    $arr[$k] = $arr[$k + 1];
                    $arr[$k+1] = $temp;
                }
            }
        }

        return $arr;
    }

    /**
     * 插入排序
     */
    public function insertSort($arr)
    {
        $len = count($arr);

        for ($i=1; $i < $len; $i++) { 
            $target = $arr[$i];
            // 如果有大于/小于该数值的数，则交换位置
            for ($k=$i - 1; $k >= 0; $k--) { 
                
                if ($target < $arr[$k]) {
                    $arr[$k + 1] = $arr[$k];
                    $arr[$k] = $target;
                }
            }
        }
        return $arr;
    }

    /**
     * 选择排序
     */
    public function selectSort($arr)
    {
        $len = count($arr);

        for ($i=0; $i < $len; $i++) { 
            // 假设$i 为最小值
            $p = $i;
            for ($k=$i+1; $k < $len; $k++) { 
                if ($arr[$p] > $arr[$k] ) {
                    $p = $k;
                }
            }

            $temp = $arr[$p];
            $arr[$p] = $arr[$i];
            $arr[$i] = $temp;

        }
        return $arr;
    }

    


    public function start()
    {
        // echo "快排实现：", "\n";
        // print_r($this->quickSort($this->arr));
        
        // echo "冒泡排序实现：", "\n";
        // print_r($this->bubbleSort($this->arr));

        // echo "插入排序实现：", "\n";
        // print_r($this->insertSort($this->arr));

        echo "选择排序实现：", "\n";
        print_r($this->selectSort($this->arr));

    }

}


$sort = new Sort();
$sort->start();