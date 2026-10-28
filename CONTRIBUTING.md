# Contributing / 贡献指南

Contributions to the PHP algorithm examples, explanations and translations are welcome. Small, focused changes are easier to review.

欢迎补充和修正 PHP 算法示例、讲解与翻译。请尽量让一次 PR 只解决一个问题。

## Report a problem / 报告问题

Search [existing issues](https://github.com/m9rco/algorithm-php/issues) before opening a new report. Include:

- The affected file or documentation section.
- For code problems: your PHP version, a minimal input, the expected output and the actual result or error.
- Steps needed to reproduce the problem. Remove credentials and private data.

提交前请搜索已有 issue，并提供文件路径、PHP 版本、最小输入、预期输出、实际输出或错误。文档问题请指出具体段落。

## Submit a change / 提交修改

1. Fork the repository and create a branch for your change.
2. Follow the existing organization: algorithm examples are under `src/`, including `Sort`, `Query`, `Structure`, `Other` and `Features`; tests are under `tests/`.
3. For an algorithm change, explain the problem and include representative inputs and expected results, including relevant edge cases. Explain time and space complexity where applicable.
4. Update [README.md](README.md) and [README-EN.md](README-EN.md) together when changing shared project information. Translation-only corrections are also welcome.
5. Describe how you checked the change, including the PHP version and the checks you actually ran. If you could not run a check, say so in the PR.
6. Open a [pull request](https://github.com/m9rco/algorithm-php/pulls) describing the problem, the change and any related issue.

中文说明：Fork 后创建分支，沿用现有目录组织；算法修改请提供示例与边界输入、预期结果及适用的复杂度说明。公共项目信息请同步中英文 README。在 PR 中如实记录运行环境、验证方法和未验证部分。

The repository contains historical dependencies. Include the PHP and dependency versions used for your checks.

仓库含历史依赖，请记录验证时实际使用的 PHP 和依赖版本。

## License and conduct / 许可证与协作

Keep applicable copyright notices and attribute sources. Submit only material you are entitled to contribute under the repository's [MIT license](LICENSE). Follow the [Code of Conduct](CODE_OF_CONDUCT.md).

请保留适用的版权声明并注明来源，只提交有权按本仓库 MIT 许可证贡献的内容，并遵守行为准则。

