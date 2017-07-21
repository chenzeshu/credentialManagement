<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About This Program
主要用于公司内部各类文件及审批的去纸质化
 - 使用了collevtive/html来加速curd的开发
 - 使用了uikit的非扁平风格
 - 使用了entrust来RBAC
 - 使用了beanstalkd来适应并发
 
## v0.90 / 2017.6.20
 - 为审批员增加了删除申请表单内文件的能力
 - 增加了左侧导航栏的记忆功能
 - 增加了按日期时限显示不同高亮的功能
 - 将各个栏目名收束在`config.titles`，同时修订名下字段的名称，使更复合公司业务
 - 修复了修改功能下日期不能显示的问题
 - 修复了查询的一些问题
## v0.91 / 2017.7.21
 - 为审批员增加新增申请表单内文件能力 
## todo list
  - 为注册员工增加信息通知模块
  - 细化权限，使更复合公司业务
 
目前ab测试并发为440+
