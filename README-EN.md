​<h1 align="center">:whale:A collection of algorithms that are implemented in PHP:whale: </h1>

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

<p align="center"> <a href="./README.md">中文版</a>　<p>

## Simple structure,

```
├──Package
│    ├── Sort  
│    │    ├── BubbleSort.php          
│    │    ├── QuickSort.php           
│    │    ├── ShellSort.php           
│    │    ├── MergeSort.php           
│    │    ├── InsertSort.php          
│    │    └── SelectSort.php          
│    │ 
│    ├── Query 查找篇
│    │    ├── BinaryQuery.php         
│    │    ├── InseertQuery.php        
│    │    ├── FibonacciQuery.php      
│    │    ├── BFSQuery.php      
│    │    ├── Kmp.php                 
│    │    ├── DijkstraQuery.php      
│    │    └── QulickQuery.php         
│    │     
│    └── Other 其他 
│         ├──  MonkeyKing.php         
│         ├──  DynamicProgramming.php 
│         ├──  Fibonacci.php          
│         ├──  StealingApples.php     
│         ├──  HanoiGames.php       
│         ├──  BidirectionalQueue.php     
│         ├──  ColorBricks.php        
│         ├──  GetCattle.php          
│         ├──  OnlyNumbers.php        
│         ├──  Interval.php        
│         ├──  Maze.php        
│         ├──  AntsClimb.php        
│         ├──  Encryption.php        
│         ├──  ElevatorDispatch.php      
│         ├──  kmp.php      
│         ├──  TraversalOfBinary.php      
│         ├──  PointInTriangle.php      
│         └──  BigSmallReplace.php    
│         └──  Knapsack.php    
│         └──  Solution.php    
│         └──  RotationSort.php    
│         └──  Square.php    
│         └──  Prim.php    
│         └──  CartesianProduct.php 
│         └──  Square.php 
│         └──  Judge.php 
│         └──  Factorial.php 
│     
├──LICENSE 
└──README.md
```

## What to do？

```
To record their understanding algorithms, data structure, the process of simple comprehensive and detailed as possible, let the learning algorithm using flexible, refueling(ง •̀_•́)ง
```

## logarithmic

log<sub>10</sub>100 It's equivalent to saying, "how many tens do you multiply?" the answer is, of course, two
so log<sub>10</sub>100=2，The logarithmic operation is the inverse of the power operation

| left               | right                 |
| ------------------ | --------------------- |
| 2<sup>3</sup> = 8  | log<sub>2</sub>8 = 3  |
| 2<sup>4</sup> = 16 | log<sub>2</sub>16 = 4 |
| 2<sup>5</sup> = 32 | log<sub>2</sub>32 = 5 |

If you don't, we won't wait for you

## The elapsed time

Take binary search for example, how much time can you save by using it? Simply look for the Numbers and if the list contains 100 Numbers, you need to guess 100 times.
In other words, the number of guesses is the same as the length of the list, which is called linear time, while binary search is different if the list contains 100 elements
It takes up to seven times, and if the list contains four billion digits, it should be guessed 32 times, while the running time of the subsearch is logarithmic time `O(log)`

## Big O notation

The big O notation is a special representation of how fast the algorithm can be. There's a diaosi. In fact, you often have to copy other people's code.
In this case, you know how fast these algorithms are

- The running time of the algorithm increases at different speeds
  - For example, the difference between a simple find and a binary search

| element       | Easy to find | Binary search |
| ------------- | ------------ | ------------- |
| 100           | 100ms        | 7ms           |
| 10000         | 10s          | 14ms          |
| 1 000 000 000 | 11day        | 30ms          |

- ` O ` said hair is pointed out that how fast algorithms, such as list contains ` n ` element, a simple search need to check each element, so you need to perform ` n ` time operations
  Using large ` O ` said ` O (n) to make this operation `, binary search need to perform log<sub>n</sub> using large ` O ` said to`O(log n)`
  - Some common big O runtime
- O(log n) ,It's also called log time, and this algorithm includes binary algorithms
- O(n),Also known as linear time, this algorithm includes simple lookups.
- O(n * log n) Quick sort
- O(n<sub>2</sub>),Selection sort
- O(n!) Factorial time
  - Here is the point
- The speed of the algorithm is not the time, but the growth of operands
- When we talk about the speed of the algorithm, what we're talking about is how fast will it run as the input increases
- The running time of the algorithm is expressed in large O notation
- O(log n) is faster than O (n), and the more elements that need to be searched, the more the former is faster than the latter

## A simple comparison of recursion and loops：

1. From a procedural point of view, the recursion manifests itself as calling itself, and the loop does not have this form.
2. Recursive proceed from the ultimate goal of the problem, and gradually to a complex problem into a simple problem, and simple question solution and complicated problem, at the same time the presence of the benchmark, can eventually get a problem, is the reverse. And the circulation is from the simple question, step by step forward development, finally get the question, is positive.
3. Any cycle can be represented by recursion, but it is necessary to use the loop to achieve recursion (except for one-way recursion and tail recursion), and the stack structure must be introduced to stack the stack.
   4.In general, non-recursive efficiency is higher than recursion. And recursive function calls are expensive and recursive times are limited by stack size.

## Progressive learning

1. Fork 我的项目并提交你的 `idea`
2. Pull Request 
3. Merge 

## 纠错

If you find something wrong, you can initiate a [issue](https://github.com/PuShaoWei/designPatterns-go/issues)or [pull request](https://github.com/PuShaoWei/designPatterns-go/pulls),I will correct it in time

> 补充:发起pull request的commit message请参考文章[Commit message 和 Change log 编写指南](http://www.ruanyifeng.com/blog/2016/01/commit_message_change_log.html)

## Contributors

Thanks for the issue or pull request of the following friends:

- [hailwood ](https://github.com/hailwood)

- [zhangxuanru](https://github.com/zhangxuanru)

- [ifreesec](https://github.com/ifreesec)

- [openset](https://github.com/openset)

- [Neroxiezi](https://github.com/Neroxiezi)

  ## License

MIT 
