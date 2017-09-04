<?php
/**
 * ColorBricks 彩色砖块
 *
 * @author   Pu ShaoWei <pushaowei0727@gmail.com>
 * @date     2017/9/1
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：额。。。 没做出来求大佬带
 * -------------------------------------------------------------
 * 小易有一些彩色的砖块。每种颜色由一个大写字母表示。各个颜色砖块看起来都完全一样。
 * 现在有一个给定的字符串s,s中每个字符代表小易的某个砖块的颜色。小易想把他所有的砖块排成一行。
 * 如果最多存在一对不同颜色的相邻砖块,那么这行砖块就很漂亮的。
 * -------------------------------------------------------------
 * 请你帮助小易计算有多少种方式将他所有砖块排成漂亮的一行。(如果两种方式所对应的砖块颜色序列是相同的,那么认为这两种方式是一样的。)
 * -------------------------------------------------------------
 *  例如: s = "ABAB",那么小易有六种排列的结果:
 *    "AABB","ABAB","ABBA","BAAB","BABA","BBAA"
 *     其中只有"AABB"和"BBAA"满足最多只有一对不同颜色的相邻砖块。
 *  -------
 *  输入描述:
 *           输入包括一个字符串s,字符串s的长度length(1 ≤ length ≤ 50), [s中的每一个字符都为一个大写字母(A到Z)]。
 *  输出描述:
 *           输出一个整数,表示小易可以有多少种方式。
 *  -------
 *  输入例子1:
 *           ABAB
 *  输出例子1:
 *           2
 * @param $inputting
 * @return mixed
 */
function ColorBricks($inputting)
{
    $str    = ord($inputting);
    $strLen = strlen($inputting);
//    if (!($str > 64 && $str < 91) ||
//        !(1 <= $strLen && $strLen <= 50)
//    ) {
//        return false;
//    }
    $group = [];
    $temp  = '';

    // 表示标排列 有24 种排列方式
    // 0123 0132 0213 0231 0312 0321
    // 1023 1032 1203 1230 1320 1302
    // 2013 2031 2130 2103 2301 2310
    // 3012 3021 3120 3102 3201 3210

    // 0123  0132
    // 0213  0231
    // 0312  0321

    // 额。。。 没做出来求大佬带

    for ($i = 1; $i < $strLen; $i++) {
//        $group[$inputting] = true;
        for ($j = 1; $j < $strLen ; $j++) {
            echo $i, $j, PHP_EOL;
            if (isset($inputting[$i + 1])) {
                $temp              = $inputting[$i];
                $inputting[$i]     = $inputting[$i + 1];
                $inputting[$i + 1] = $temp;
            }
        }
    }
    var_dump($group);
}

echo ColorBricks("AABB");


#########################################


 
 function ColorBricks2($str)
 {
	$count = strlen($str);
	$data  = array();
	for($i = 0; $i < $count; $i++){
		 $data[] = $str[$i];
		} 
	 $a =  pre2($data);
  }
 
 /*
  思路分析:
  
  *  例如: s = "ABAB",那么小易有六种排列的结果:
  *  "AABB","ABAB","ABBA","BAAB",    "BBAA"   "BABA",  
       1-2     0      2-3    0-1       0-3      1-2      
 	   "ABAB",   0
	   "BAAB",   0-1
 	   "AABB",   0-2  
 	   "BABA"    0-3  
 	   "ABBA",   1-2 
	   "BBAA"    1-3 
	     
 */
 
 function pre2($data)
 { 
   $c = count($data);
   $new = array(); 	
   $max = floor($c/2);  
   for($i = 0; $i < $max;$i++){
	   for($j = 1; $j < $c;$j++){
 			 $temp = $data[$j];
			 $data[$j] = $data[0];
			 $data[0] = $temp;
			 $new[] = implode("",$data);
			 echo '0##'.$j.'<br/>';
		 } 
	 } 
	 $nMax = count($new);
	 $successNumber = 0;
	 for($i = 0 ; $i < $max;$i++){
		   $success = false;
		   for($j = 0; $j < $nMax;$j++){
			     $str = $new[$j]; 
				 if($str[$i] == $str[0]){
					    $success = true;       
				    }
			   } 
	      if($success)$successNumber++;		   
		 }
  	   echo '<pre>'; 
	   echo "小易可以有{$successNumber}种方式";
	   echo "<br/><br/><br/><br/>";
	   print_r($new);
	   exit; 
 }  
 $str =  "ABAB";
 ColorBricks2($str);


