<?php
	/**
	 * ----------------------------------------
	 * | Created By algorithm-php                 |
	 * | User: 南丞 <lampxiezi@163.com>     |
	 * | Date: 2019/10/11                      |
	 * | Time: 下午2:56                        |
	 * ----------------------------------------
	 * |    _____  ______ _             _     |
	 * |   |  __ \|  ____(_)           | |    |
	 * |   | |__) | |__   _ _ __   __ _| |    |
	 * |   |  ___/|  __| | | '_ \ / _` | |    |
	 * |   | |    | |    | | | | | (_| | |    |
	 * |   |_|    |_|    |_|_| |_|\__,_|_|    |
	 * ----------------------------------------
	 * 说明:  面试遇到一个写一个函数 让输出效果 如风车一样旋转 如下
	 *  foo(4)  逆时针
	 *   16,15,14,13
	 *   5, 4, 3, 12
	 *   6, 1, 2, 11
	 *   7, 8, 9, 10
	 * foo(4)  顺顺时针
	 *   7, 8, 9, 10
	 *   6, 1, 2, 11
	 *   5, 4, 3, 12
	 *   16,15, 14,13
	 *
	 */
	
	$num = 4;
	$arr = foo($num);
	for ($i = 0; $i < $num; $i++) {
		echo implode(',', $arr[$i])."<br>";
	}
	
	/**
	 * @param $num
	 * @param int $direction 方向  1 为  顺时针旋转 2 为逆时针旋转
	 * @return mixed
	 */
	function foo($num, $direction = 1)
	{
		//填充map
		$data = new stdClass();
		$data->x = 1;
		if ($direction == 1) {
			$data->y = $num;
		} elseif ($direction == 2) {
			$data->y = 1;
		}
		$data->num = $num;
		$data->len = $num * $num;
		$data->tmp_data = [];
		$data->rate = 1;//方向
		$data->struct = create_struct($num);
		for ($i = $data->len; $i >= 1; $i--) {
			$data->i = $i;
			$key = change_key($data, $direction);
			$data->tmp_data[$key] = $i;
			unset($data->struct[$key]);
		}
		
		//根据y坐标分组
		$data->struct = create_struct($num);
		foreach ($data->tmp_data as $key => $value) {
			$data->struct[$key] = $value;
		}
		for ($i = 1; $i <= $data->num; $i++) {
			$start = ($i - 1) * $data->num;
			$end = $data->num;
			$slice = array_slice($data->struct, $start, $end);
			$data->slice[] = $slice;
		}
		
		return $data->slice;
	}
	
	function create_struct($num)
	{
		$struct = [];
		for ($i = 1; $i <= $num; $i++) {
			//嵌套
			for ($m = 1; $m <= $num; $m++) {
				$key = $m.','.$i;
				$struct[$key] = '';
			}
		}
		
		return $struct;
	}
	
	function change_key($data, $direction)
	{
		$key = $data->x.','.$data->y;
		if (isset($data->struct[$key])) {
			return $key;
		}
		switch ($data->rate) {
			// LEFT 方向
			case 1:
				$data->tmp_x = $data->x + 1;
				$key = $data->tmp_x.','.$data->y;
				if (isset($data->struct[$key])) {
					$data->x = $data->tmp_x;
					
					return $key;
				} else {
					if ($direction = 1) {
						$data->rate = 4;
					} elseif ($direction = 2) {
						$data->rate = 2;
					}
				}
				break;
			// DOWN 方向
			case 2:
				$data->tmp_y = $data->y + 1;
				$key = $data->x.','.$data->tmp_y;
				if (isset($data->struct[$key])) {
					$data->y = $data->tmp_y;
					
					return $key;
				} else {
					if ($direction = 1) {
						$data->rate = 1;
					} elseif ($direction = 2) {
						$data->rate = 3;
					}
				}
				break;
			// RIGHT 方向
			case 3:
				$data->tmp_x = $data->x - 1;
				$key = $data->tmp_x.','.$data->y;
				if (isset($data->struct[$key])) {
					$data->x = $data->tmp_x;
					
					return $key;
				} else {
					if ($direction = 1) {
						$data->rate = 2;
					} elseif ($direction = 2) {
						$data->rate = 4;
					}
				}
				break;
			// UP 方向
			case 4:
				$data->tmp_y = $data->y - 1;
				$key = $data->x.','.$data->tmp_y;
				if (isset($data->struct[$key])) {
					$data->y = $data->tmp_y;
					
					return $key;
				} else {
					if ($direction = 1) {
						$data->rate = 3;
					} elseif ($direction = 2) {
						$data->rate = 1;
					}
				}
				break;
		}
		
		return change_key($data, $direction);
	}