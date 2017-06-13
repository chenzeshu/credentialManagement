<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '管理平台') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/uikit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/uikit.gradient.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/uikit.almost-flat.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{asset('css/components/form-file.gradient.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/form-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/datepicker.css')}}">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" type="text/css" href="{{asset('js/wang/css/wangEditor.min.css')}}">--}}
    <style>
        .wangEditor-container{
            min-height:400px;
            border-radius: 3px;
        }
        .wangEditor-txt{
            min-height:300px;
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="uk-navbar">
        <!-- Branding Image -->
        <a class="uk-navbar-brand margin-left-100" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    @if (!Auth::guest())
        <!--left side-->
            <ul class="uk-navbar-nav margin-left-100">
                @role('admin')
                <li class="uk-parent" data-uk-dropdown>
                    <a href="">系统管理</a>

                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul class="uk-nav uk-nav-navbar">
                            <li><a href="{{route('users.index')}}">用户管理</a></li>
                            <li><a href="{{route('roles.index')}}">角色管理</a></li>
                            <li><a href="{{route('perms.index')}}">权限管理</a></li>
                        </ul>
                    </div>
                </li>
                @endrole

                <li>
                    @role('checker')
                    <a href="{{route('manage.index')}}">审批管理 <strong><div class="uk-badge uk-badge-warning uk-badge-notification">{{session('count')}}</div></strong></a>
                    @endrole
                </li>

                <div class="uk-navbar-content uk-hidden-small">
                    <form class="uk-form uk-margin-remove uk-display-inline-block" action="{{route('search.search')}}" method="post">
                        {{csrf_field()}}
                        <input type="text" name="name" placeholder="查找文件">
                        <div class="uk-button uk-button-default uk-form-select" data-uk-form-select>
                            {{--搜索栏目--}}
                            <span></span>
                            <select name="search_type">
                                <option value="0">人员信息</option>
                                <option value="1">基本资质</option>
                                <option value="2">服务.研发</option>
                                <option value="3">获奖.荣誉</option>
                                <option value="4">感谢信</option>
                                <option value="5">商标</option>
                                <option value="6">体系贯标数据</option>
                                <option value="7">第三方</option>
                                <option value="8">软件产品</option>
                                <option value="9">专利</option>
                            </select>
                        </div>
                        <button type="submit" class="uk-button uk-button-primary">查找</button>
                    </form>
                </div>
            </ul>
    @endif
    <!--right side-->

        <div class="uk-navbar-content uk-navbar-flip  uk-hidden-small  margin-right-100">
            <ul class="uk-navbar-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">登陆</a></li>
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                @else
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="#" style="cursor: pointer">{{ Auth::user()->name }}</a>

                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">

                                <li class="uk-nav-header">
                                    @include('users._editpassword')
                                </li>
                                <li class="uk-nav-header">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        注销
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </li>
                @endif
            </ul>
        </div>
    </nav>
@if(Auth::guest())
    @yield('login')
@else
        <div class="uk-grid margin-top-30">
            <div class="uk-container uk-width-1-6">
                {{--导航栏--}}
                <div class="left-nav cut-line">
                    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
                        <li class="uk-parent">
                            <a href="#">人力资源</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{route('humans.index')}}">人员信息</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="#">资质</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{route('credentials_basic.index')}}">基本资质</a></li>
                                <li><a href="{{route('credentials_1.index')}}">服务基地.研发中心</a></li>
                                <li><a href="{{route('credentials_2.index')}}">获奖、荣誉表、高新技术产品</a></li>
                                <li><a href="{{route('credentials_3.index')}}">服务感谢信</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="#">知识产权</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{route('softs.index')}}">软件产品</a></li>
                                <li><a href="{{route('patents.index')}}">专利</a></li>
                                <li><a href="{{route('credentials_4.index')}}">商标</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="#">质量体系、产品检测</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{route('credentials_5.index')}}">体系、贯标</a></li>
                                <li><a href="{{route('credentials_6.index')}}">第三方产品检测、鉴定</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="#">我的空间</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{route('selfs.index')}}">未审批表</a></li>
                                <li><a href="{{route('histroy.index')}}">我的提交历史</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="#">项目管理</a>
                            <ul class="uk-nav-sub">
                                <li><a href="">空置</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <style>
                    .left-nav{
                        /*height: 100%;*/
                        height:85vh;
                    }
                    .cut-line{
                        border-right:1px solid #D6D6D6;
                    }
                </style>

            </div>
            <div class="uk-width-5-6">
                @yield('content')
            </div>
        </div>
@endif

<!-- Scripts -->
    <script src="{{asset('js/jquery.3.2.1.min.js')}}"></script>
    {{--<script src="{{ URL::asset('js/aetherupload.js') }}"></script>--}}
    {{--<script src="http://s1.bdstatic.com/r/www/cache/ecom/etpl/3-2-0/etpl.js"></script>   UEditor--}}
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/components/form-select.js')}}"></script>
    <script src="{{asset('js/components/timepicker.js')}}"></script>
    <script src="{{asset('js/layer/layer.js')}}"></script>
    <script>
        var topNav = document.getElementsByClassName('uk-nav')[0]
        var leftNav = document.getElementsByClassName('uk-nav')[2]
        var objs = leftNav.children

        //左侧nav高亮
        for(let i = 0; i<objs.length; i++){
            objs[i].addEventListener('click', function () {
                if(objs[i].className.indexOf('uk-active')>-1){
                    //如果再次点击了自己，并且自己有uk-active这个class
                    objs[i].children[1].className = ''
                    return
                }
                
                for(let n = 0; n<objs.length; n++){
                    let obj = objs[n]
                    obj.className = 'uk-parent'
                    obj.children[1].className = 'uk-hidden'
                }

                objs[i].className += ' uk-active'
                objs[i].children[1].className = ''
            })
        }

        //一旦点击了顶栏的nav，左侧的反应
        topNav.addEventListener('click', function () {
            for(let n = 0; n<objs.length; n++){
                let obj = objs[n]
                obj.className = 'uk-parent'
                obj.children[1].className = 'uk-hidden'
            }
        })
    </script>
    @yield('customerJS')
    @yield('customerEditJS')
    @yield('CustomerDownloadJS')
</div>
</body>
</html>
