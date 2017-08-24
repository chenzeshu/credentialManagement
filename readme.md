<p align="center"><h2><b>电子化办公文件管理审批平台</b></h2>
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
 - 使用了memcached缓存
 
## v0.90 / 2017.6.20
 - 为审批员增加了删除申请表单内文件的能力
 - 增加了左侧导航栏的记忆功能
 - 增加了按日期时限显示不同高亮的功能
 - 将各个栏目名收束在`config.titles`，同时修订名下字段的名称，使更复合公司业务
 - 修复了修改功能下日期不能显示的问题
 - 修复了查询的一些问题
## v0.91 / 2017.7.21
 - 为审批员增加增加申请表单内文件的能力 
## v0.92 / 2017.7.27
  - 为注册员工增加信息通知模块
  - 细化权限条目，使更符合公司业务
## v0.94 / 2017.8.4
  - 权限的结构被收束在`config.perms`
  - 完成权限的分发

## v1.1 / 2017.8.23
  - 队列换用全局方法`dispatch()`
  - 消息增加已读状态
  - 权限细分
  - 开放会员个人信息修改能力，并做了一些前端页面的细节修改

## todolist
  - 统计模块
  - 更为详细的Exception
  - 适当的代码重构
  - 文件下载自定义水印功能
  
## evenMore
  - 使用vue实现前后端分离，因为发现后端渲染和blade模版在后续开发中有掣肘。
  
目前单服务器环境下，ab测试并发为440+
