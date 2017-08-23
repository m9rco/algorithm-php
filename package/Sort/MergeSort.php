<?php
/**
 * @example  归并排序
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/7/22
 * @license  Mozilla
 * -------------------------------------------------------------
 * 思路分析：
 * -------------------------------------------------------------
 * 比较a[i]和b[j]的大小，若a[i]≤b[j]，则将第一个有序表中的元素a[i]复制到r[k]中，
 * 并令i和k分别加上1；否则将第二个有序表中的元素b[j]复制到r[k]中，并令j和k分别加上1，
 * 如此循环下去，直到其中一个有序表取完，然后再将另一个有序表中剩余的元素复制到r中从下标k到下标t的单元。
 * 归并排序的算法我们通常用递归实现，先把待排序区间[s,t]以中点二分，接着把左边子区间排序，再把右边子区间排序，
 * 最后把左区间和右区间用一次归并操作合并成有序的区间[s,t]
 */

$arrStoreList = array(3,2,4,1,5);
//$sort = new Merge_sort();
//$sort->stableSort($arrStoreList, function ($a, $b) {    // function ($a, $b)匿名函数
//    return $a < $b;
//});

//静态调用方式也行
Merge_sort:: stableSort($arrStoreList, function ($a, $b) {
            return $a < $b;
});
print_r($arrStoreList);

class Merge_sort{

    public static function stableSort(&$array, $cmp_function = 'strcmp') {

        //使用合并排序
        self::mergeSort($array, $cmp_function);
        return;
    }
    public static function mergeSort(&$array, $cmp_function = 'strcmp') {
        // Arrays of size < 2 require no action.
        if (count($array) < 2) {
            return;
        }
        // Split the array in half
        $halfway = count($array) / 2;
        $array1 = array_slice($array, 0, $halfway);
        $array2 = array_slice($array, $halfway);
        // Recurse to sort the two halves
        self::mergeSort($array1, $cmp_function);
        self::mergeSort($array2, $cmp_function);
        // If all of $array1 is <= all of $array2, just append them.
//array1 与 array2 各自有序;要整体有序，需要比较array1的最后一个元素和array2的第一个元素大小
        if (call_user_func($cmp_function, end($array1), $array2[0]) < 1) {
            $array = array_merge($array1, $array2);

            return;
        }
        // 将两个有序数组合并为一个有序数组：Merge the two sorted arrays into a single sorted array
        $array = array();
        $ptr1 = $ptr2 = 0;
        while ($ptr1 < count($array1) && $ptr2 < count($array2)) {
            if (call_user_func($cmp_function, $array1[$ptr1], $array2[$ptr2]) < 1) {
                $array[] = $array1[$ptr1++];
            } else {
                $array[] = $array2[$ptr2++];
            }
        }
        // Merge the remainder
        while ($ptr1 < count($array1)) {
            $array[] = $array1[$ptr1++];
        }
        while ($ptr2 < count($array2)) {
            $array[] = $array2[$ptr2++];
        }
        return;
    }
}