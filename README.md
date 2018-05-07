​<h1 align="center">:whale: 用 PHP 的方式实现的各类算法合集 :whale: </h1>

<p align="center">
<a href="https://github.com/PuShaoWei/arithmetic-php#简易结构">
  <img src="https://img.shields.io/badge/php-done-brightgreen.svg" alt="php">
</a>
<a href="https://github.com/PuShaoWei/arithmetic-php">
    <img src="https://img.shields.io/github/issues-pr-raw/arithmetic-php/cdnjs.svg">
</a>
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

> 每周最少一更，求出题，求虐待 At least once a week, ask for problems and abuse

## 简易结构

```
├──Package
│    ├── Sort  排序篇
│    │    ├── BubbleSort.php          冒泡排序
│    │    ├── HeapSort.php            堆排序   大根堆
│    │    ├── MBaseSort.php           基数排序 MSD
│    │    ├── LBaseSort.php           基数排序 LSD
│    │    ├── QuickSort.php           快速排序
│    │    ├── ShuttleSort.php         飞梭排序
│    │    ├── ShellSort.php           希尔排序
│    │    ├── MergeSort.php           归并排序
│    │    ├── InsertSort.php          插入排序
│    │    └── SelectSort.php          选择排序
│    │
│    ├── Query 查找篇
│    │    ├── BinaryQuery.php         二分查找
│    │    ├── InseertQuery.php        插入查找
│    │    ├── FibonacciQuery.php      斐波那契查找
│    │    ├── BFSQuery.php            广度优先查找
│         ├── Kmp.php                 算法导论-KMP算法
│         ├── DijkstraQuery.php       迪克斯特拉算法
│    │    └── QulickQuery.php         快速查找
│    │     
│    ├── Structure 数据结构
│    │    ├── StackExample.php         堆栈   先进后出 LIFO (Last In First Out)
│    │    ├── LinearChain.php          线性表 单链存储
│    │    └── LinearOrder.php          线性表 顺序存储
│    │    └── BinarySearchTree.php     二叉搜索树  
│    │     
│    ├── Tools 小工具集
│    │    └──  SystemSwitch.php       堆栈实现进制转换  
│    │  
│    └── Other 其他
│         ├──  MonkeyKing.php         约瑟夫环
│         ├──  DynamicProgramming.php 动态规划
│         ├──  Fibonacci.php          斐波那契数列
│         ├──  StealingApples.php     偷苹果求余
│         ├──  HanoiGames.php         汉诺塔游戏
│         ├──  BidirectionalQueue.php 双向队列
│         ├──  ColorBricks.php        彩色砖块
│         ├──  GetCattle.php          牛年求牛
│         ├──  OnlyNumbers.php        求唯一数
│         ├──  PokerGames.php         洗扑克牌
│         ├──  Interval.php           抽奖区间算法
│         ├──  Maze.php               迷宫寻址算法
│         ├──  AntsClimb.php          蚂蚁爬杆算法
│         ├──  Encryption.php         对称加密算法
│         ├──  ElevatorDispatch.php   编程之美-电梯调度算法
│         ├──  PointInTriangle.php    向量叉集计算点是否在三角形中
│         ├──  TraversalOfBinary.php  二叉树非递归遍历算法实现
│         ├──  Knapsack.php           贪心算法之背包问题实现
│         └──  BigSmallReplace.php    Hello World 输出 Olleh Dlrow
│         └──  Solution.php           Facebook面试题之岛屿周长算法
│         └──  RotationSort.php       Facebook面试题之顺时针回旋算法
│         └──  Square.php             Facebook面试题之判断四个点能否组成正方形算法
│         └──  Prim.php               Prim算法(最小生成树算法)
│         └──  CartesianProduct.php   笛卡尔积算法
│         └──  Square.php             面试题之平面任意四点能否组成一个矩形
│         └──  Judge.php              面试题之扑克牌中任选五张判断是不是顺子
│         └──  Factorial.php          面试题之N的阶乘末尾有多少个0
│
│     
├──LICENSE
└──README.md
```

## 要做什么？

```
记录自己理解算法，数据结构的过程，尽可能的简单全面以及详细，让算法学习运用灵活自如，加油(ง •̀_•́)ง
```

## 当然

```
用 PHP 实现算法并替代官方提供的函数是愚蠢的事情 .但这觉不代表斟酌算法就是件无意义的事 , 每个算法都是一种思想的结晶 , 学习优秀的思想 , 开拓思维
```

## 什么是算法？

直白地说，算法就是任何明确定义的计算过程，它接收一些值或集合作为输入，并产生一些值或集合作为输出。这样，算法就是将输入转换为输出的一系列计算过程。来源：Thomas H. Cormen, Chales E. Leiserson (2009), 《算法导论第三版》。

简而言之，我们可以说算法就是用来解决一个特定任务的一系列步骤（是的，不止计算机在使用算法，人类也同样如此）。目前，一个有效的算法应该含有三个重要特性：

- 它必须是有限的：如果你设计的算法永无休止地尝试解决问题，那么它是无用的。
- 它必须具备明确定义的指令：算法的每一步都必须准确定义，在任何场景下指令都应当没有歧义。
- 它必须是有效的：一个算法被设计用以解决某个问题，那么它就应当能解决这个问题，并且仅仅使用纸和笔就能证明该算法是收敛的。

## 对数

log<sub>10</sub>100 相当于问"将多少个10相乘的结果为100"，答案当然是2个了
因此log<sub>10</sub>100=2，即对数运算是幂运算的逆运算

| left               | right                 |
| ------------------ | --------------------- |
| 2<sup>3</sup> = 8  | log<sub>2</sub>8 = 3  |
| 2<sup>4</sup> = 16 | log<sub>2</sub>16 = 4 |
| 2<sup>5</sup> = 32 | log<sub>2</sub>32 = 5 |

## 运行时间

以二分查找为例，使用它可节省多少时间呢？简单查找逐个地检查数字，如果列表包含100个数字，最多需要猜100次。
换而言之最多需要猜测的次数与列表长度相同，这被称为线性时间(linear time)，而二分查找则不同，如果列表包含100个元素
最多需要7次，如果列表包含40亿个数字，最多需猜32次，而分查找的运行时间为对数时间 `O(log)`

## 大O表示法

大O表示法是一种特殊的表示法 ，指出了算法的速度有多快。有个屌用啊，实际上，你经常要去复制别人的代码。
在这种情况下，知道这些算法的速度有快有慢

- 算法的运行时间以不同的速度增加
  - 例如简单查找与二分查找的区别

| 元素                | 简单查找  | 二分查找 |
| ----------------- | ----- | ---- |
| 100个元素            | 100ms | 7ms  |
| 10000个元素          | 10s   | 14ms |
| 1 000 000 000 个元素 | 11天   | 30ms |

- 大`O`表示法指出了算法有多快，例如列表包含`n`个元素，简单查找需要检查每个元素，因此需要执行`n`次操作
  使用大`O`表示法这个运行时间为`O(n)`,二分查找需要执行log<sub>n</sub>次操作，使用大`O`表示为`O(log n)`
  - 一些常见的大O运行时间
- O(log n) ,也叫对数时间，这样的算法包括二分算法
- O(n),也叫线性时间，这样的算法包括简单查找。
- O(n * log n) 快速排序
- O(n<sub>2</sub>),选择排序
- O(n!) 即阶乘时间
  - 这里是重点
- 算法的速度指的并非时间，而是操作数的增速
- 谈论算法的速度时间时，我们说的是随着输入的增加，其运行时间将以什么样的速度增加
- 算法的运行时间用大O表示法表示
- O(log n)比O(n)快，当需要搜索的元素越多时，前者比后者快的越多

## 编写解决实际问题的程序过程

- 如何用数据形式描述问题，即将问题抽象为一个数学模型
- 问题所涉及到的数据量的大小及数据之间的关系
- 如何在计算机中储存数据及体现数据之间的关系
- 处理数据时需要对数据执行的操作
- 编写的程序的性能是否良好

## 数据(Data)

- 是客观事物的符号表示，在计算机科学中指的是所有能输入到计算机中并被计算机程序处理的符号的总称。
- 数据元素(Data Element) :是数据的基本单位，在程序中通常作为一个整体来进行考虑和处理。一个数据元素可由若干个数据项(Data Item)组成。
- 数据项(Data Item) : 是数据的不可分割的最小单位。数据项是对客观事物某一方面特性的数据描述。
- 数据对象(Data Object) :是性质相同的数据元素的集合，是数据的一个子集。如字符集合C={‘A’,’B’,’C,…} 。
- 数据结构 :相互之间具有一定联系的数据元素的集合。
- 数据的逻辑结构 : 数据元素之间的相互关系称为逻辑结构。
- 数据操作 : 对数据要进行的运算
- 数据类型(Data Type):指的是一个值的集合和定义在该值集上的一组操作的总称。

## 数据的逻辑结构有四种基本类型

- 集合：结构中数据元素之间除了“属于同一个集合"外,再也没有其他的关系
- 线性结构：结构中的数据元素存在一对一的关系
- 树形结构：结构中的数据元素存在一对多的关系
- 网状或者图状结构：结构中的数据元素存在多对多的关系

## 数据结构的储存方式

由数据元素之间的关系在计算机中有两种不同的表示方法——顺序表示和非顺序表示，从则导出两种储存方式，顺序储存结构和链式储存结构

- 顺序存储结构：用数据元素在存储器中的相对位置来表示数据元素之间的逻辑结构(关系)，数据元素存放的地址是连续的
- 链式存储结构：在每一个数据元素中增加一个存放另一个元素地址的指针(pointer)，用该指针来表示数据元素之间的逻辑结构(关系)，数据元素存放的地址是否连续没有要求

数据的逻辑结构和物理结构是密不可分的两个方面，一个算法的设计取决于所选定的逻辑结构，而算法的实现依赖于所采用的存储结构

## 算法(Algorithm)

是对特定问题求解方法(步骤)的一种描述，是指令的有限序列，其中每一条指令表示一个或多个操作。

> 算法具有以下五个特性

- 有穷性： 一个算法必须总是在执行有穷步之后结束，且每一步都在有穷时间内完成
- 确定性：算法中每一条指令必须有确切的含义，不存在二义性，且算法只有一个入口和一个出口
- 可行性： 一个算法是能行的，即算法描述的操作都可以通过已经实现的基本运算执行有限次来实现
- 输入： 一个算法有零个或多个输入，这些输入取自于某个特定的对象集合
- 输出： 一个算法有一个或多个输出，这些输出是同输入有着某些特定关系的量

> 算法和程序是两个不同的概念

一个计算机程序是对一个算法使用某种程序设计语言的具体实现。算法必须可终止意味着不是所有的计算机程序都是算法。

> 评价一个好的算法有以下几个标准

- 正确性(Correctness )： 算法应满足具体问题的需
- 可读性(Readability)： 算法应容易供人阅读和交流，可读性好的算法有助于对算法的理解和修改
- 健壮性(Robustness)： 算法应具有容错处理，当输入非法或错误数据时，算法应能适当地作出反应或进行处理，而不会产生莫名其妙的输出结果
- 通用性(Generality)： 算法应具有一般性 ，即算法的处理结果对于一般的数据集合都成立

> 效率与存储量需求： 效率指的是算法执行的时间；存储量需求指算法执行过程中所需要的最大存储空间，一般地，这两者与问题的规模有关

## 算法的时间复杂度

算法中基本操作重复执行的次数是问题规模n的某个函数，其时间量度记作T(n)=O(f(n))，称作算法的渐近时间复杂度(Asymptotic Time complexity)，简称时间复杂度

## 算法的空间复杂度

是指算法编写成程序后，在计算机中运行时所需存储空间大小的度量，记作：S(n)=O(f(n)),其中n为问题规模

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

- [Neroxiezi](https://github.com/Neroxiezi)

  ## License

MIT
