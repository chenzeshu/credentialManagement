@extends('layouts.app')

@section('content')
        <div>
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">人员信息总览</span></a>
                    @permission('maintaince') @include('humans._create')@endpermission&nbsp; <i class="uk-icon-large uk-icon-plus-square" style="line-height:28px"
                                                        onclick="inputFile(this)"></i>
                @role('checker')
                    &nbsp;&nbsp;&nbsp;<i class="uk-icon-large uk-icon-upload" style="line-height:28px;cursor: pointer"
                    onclick="addFileToUtil(this)"></i>
                @endrole
                </li>
            </ul>
        @if(session('callback'))
            <div class="uk-alert uk-alert-success" data-uk-alert>
                <a href="" class="uk-alert-close uk-close"></a>
                <p>{{session('callback')}}</p>
            </div>
        @endif

        @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="uk-alert" data-uk-alert>
                        <a href="" class="uk-alert-close uk-close"></a>
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr>
                    <th><button onclick='cancelAllFiles()' class="uk-button uk-button-small">全选/取消</button></th>
                    <th>人员姓名</th>
                    <th>部门</th>
                    @permission('maintaince')
                    <th>身份证号</th>
                    <th>性别</th>
                    <th>专业</th>
                    <th>学历|毕业时间</th>
                    <th>学位</th>
                    <th>职称|获取时间</th>
                    <th>技能培训名称|获取时间</th>
                    <th>入职时间</th>
                    @endpermission
                    <th>邮箱</th>
                    <th>手机</th>
                    <th>备注</th>
                    @permission('maintaince')
                    <th>扫描件</th>
                    <th colspan="2">操作</th>
                    @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach($humans as $human)
                    <tr>
                        <td id="select-{{$human->id}}" onclick="selectFile(this)">
                            <input type="checkbox" style="display: none" name="id[]" class="fileid" value="{{$human->id}}">
                            <i class="uk-icon-medium uk-icon-square-o hby"></i>
                        </td>
                        <td>{{$human->name}}</td>
                        <td>{{$human->department}}</td>
                        @permission('maintaince')
                        <td>{{$human->credit}}</td>
                        <td>{{$human->sex}}</td>
                        <td>{{$human->profession}}</td>
                        <td>{{$human->qualification}}|{{substr($human->graduated_at, 0, 10)}}</td>
                        <td>{{$human->degree}}</td>
                        <td>{{$human->title}}|{{substr($human->gather_title_at, 0, 10)}}</td>
                        <td>{{$human->skill}}|{{substr($human->gather_skill_at, 0, 10)}}</td>
                        <td>{{$human->time_enter}}</td>
                        @endpermission
                        <td>{{$human->email}}</td>
                        <td>{{$human->phone}}</td>
                        <td>@include('humans._remark')</td>

                        @permission('maintaince')
                        <td>@include('humans._download')</td>
                        <td>
                            {{--<a class="uk-button uk-button-primary" href="">修改</a>--}}
                            @include('humans._edit')
                            @include('humans._delete')
                        </td>
                        @endpermission
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('utils.selectFile')
            {{ $humans->links() }}
        </div>

@endsection





