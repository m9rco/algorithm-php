<h1 align="center">:whale: 用 PHP 的方式实现的各类算法合集 :whale: </h1>

<p align="center">
<a href="https://github.com/PuShaoWei/arithmetic-php#简易结构">
  <img src="https://img.shields.io/badge/php-done-brightgreen.svg" alt="php">
</a>
<a href="https://github.com/PuShaoWei/arithmetic-php">
    <img src="https://img.shields.io/github/issues-pr-raw/arithmetic-php/cdnjs.svg">
</a>1
<a href="https://github.com/PuShaoWei/arithmetic-php">
    <img src="https://img.shields.io/codacy/grade/e27821fb6289410b8f58338c7e0bc686.svg">
</a>
<a href="https://github.com/PuShaoWei/arithmetic-php">
    <img src="https://img.shields.io/travis/rust-lang/rust.svg">
</a>
<a href="https://github.com/PuShaoWei/arithmetic-php">
    <img src="https://img.shields.io/github/license/mashape/apistatus.svg">
</a>
</p>
<p align="center"> <a href="./README-EN.md">English</a>　<p>


## 简易结构
        
    ├──Package
    │    ├── Sort  排序篇
    │    │    ├── BubbleSort.php          冒泡排序
    │    │    ├── QuickSort.php           快速排序
    │    │    ├── ShellSort.php           希尔排序
    │    │    ├── MergeSort.php           归并排序
    │    │    ├── InsertSort.php          插入排序
    │    │    └── SelectSort.php          选择排序
    │    │ 
    │    ├── Query 查找篇
    │    │    ├── BinaryQuery.php         二分查找
    │    │    ├── InseertQuery.php        插入查找
    │    │    ├── FibonacciQuery.php      斐波那契查找
    │    │    └── QulickQuery.php         快速查找 
    │    │     
    │    └── Other 其他 
    │         ├──  MonkeyKing.php         猴子选大王
    │         ├──  DynamicProgramming.php 动态规划
    │         ├──  Fibonacci.php          斐波那契数列
    │         ├──  StealingApples.php     偷苹果求余
    │         ├──  HanoiGames.php         汉诺塔游戏
    │         ├──  ColorBricks.php        彩色砖块
    │         ├──  GetCattle.php          牛年求牛
    │         ├──  OnlyNumbers.php        求唯一数
    │         └──  BigSmallReplace.php    Hello World 输出 Olleh Dlrow
    │     
    ├──LICENSE 
    └──README.md

## 要做什么？
    记录自己理解算法，数据结构的过程，尽可能的简单全面以及详细，让算法学习运用灵活自如，加油(ง •̀_•́)ง

## 对数
log<sub>10</sub>100 相当于问"降多少个10相乘的结果为100"，答案当然是2个了
因此log<sub>10</sub>100=2，即对数运算是幂运算的逆运算

left|right
---|---
2<sup>3</sup> = 8  | log<sub>2</sub>8 = 3
2<sup>4</sup> = 16 | log<sub>2</sub>16 = 4
2<sup>5</sup> = 32 | log<sub>2</sub>32 = 5

就是酱紫，你要是没有学会，我们也不会等你

## 运行时间
以二分查找为例，使用它可节省多少时间呢？简单查找诸葛地检查数字，如果列表包含100个数字，最多需要猜100次。
换而言之嘴多需要猜测的次数与列表长度相同，这被称为线性时间(linear time)，而二分查找则不同，如果列表包含100个元素
最多需要7次，如果列表包含40亿个数字，最多需猜32次，而分查找的运行时间为对数时间 `O(log)`

## 大O表示法
大O表示法是一种特殊的表示法 ，指出了算法的速度有多快。有个屌用啊，实际上，你经常要去复制别人的代码。
在这种情况下，知道这些算法的速度有快有慢

- 算法的运行时间以不同的速度增加
  - 例如简单查找与二分查找的区别
  
元素|简单查找|二分查找
---|---|---
100个元素|100ms|7ms
10000个元素|10s|14ms
1 000 000 000 个元素|11天|30ms
    
  - 大`O`表示发指出了算法有多快，例如列表包含`n`个元素，简单查找需要检查每个元素，因此需要执行`n`次操作
    使用大`O`表示发这个运行时间为`O(n)`,二分查找需要执行log<sub>n</sub>次操作，使用大`O`表示为`O(log n)`
- 一些常见的大O运行时间
  - O(log n) ,也叫对数时间，这样的算法包括二分算法
  - O(n),也叫线性时间，这样的算法包括简单查找。
  - O(n * log n) 快速排序
  - O(n<sub>2</sub>),选择排序
  - O(n!) 即阶乘时间
- 这里是重点
  - 算法的速度指的并非时间，而是操作数的增速
  - 谈论算法的速度时间时，我们说的是随着输入的增加，其运行时间将以什么样的速度增加
  - 算法的运行时间用大O表示发表示
  - O(log n)比O(n)快，当需要搜索的元素越多时，前者比后者快的越多


## 递归和循环的简单比较：

1. 从程序上看，递归表现为自己调用自己，循环则没有这样的形式。
2. 递归是从问题的最终目标出发，逐渐将复杂问题化为简单问题，并且简单的问题的解决思路和复杂问题一样，同时存在基准情况，就能最终求得问题，是逆向的。而循环是从简单问题出发，一步步的向前发展，最终求得问题，是正向的。
3. 任意循环都是可以用递归来表示的，但是想用循环来实现递归（除了单向递归和尾递归），都必须引入栈结构进行压栈出栈。
4. 一般来说，非递归的效率高于递归。而且递归函数调用是有开销的，递归的次数受堆栈大小的限制。

## 一起进步学习
1. Fork 我的项目并提交你的 `idea`
2. Pull Request 
3. Merge 

## 纠错 

如果大家发现有什么不对的地方，可以发起一个[issue](https://github.com/PuShaoWei/arithmetic-php/issues)或者[pull request](https://github.com/PuShaoWei/arithmetic-php/pulls),我会及时纠正
> 补充:发起pull request的commit message请参考文章[Commit message 和 Change log 编写指南](http://www.ruanyifeng.com/blog/2016/01/commit_message_change_log.html)

## 致谢
感谢以下朋友的issue或pull request：

- [hailwood ](https://github.com/hailwood)
- [zhangxuanru](https://github.com/zhangxuanru)
- [ifreesec](https://github.com/ifreesec)
- [openset](https://github.com/openset)

## License
MIT 