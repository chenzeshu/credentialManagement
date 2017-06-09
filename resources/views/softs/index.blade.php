@extends('layouts.app')

@section('content')
        <div>
            <ul class="uk-breadcrumb">
                <li><a href="{{url('home')}}"><span class="uk-text-large uk-text-bold">{{session('name')}}总览</span></a>
                    @include('softs._create')&nbsp; <i class="uk-icon-large uk-icon-plus-square" style="line-height:28px"
                                                       onclick="inputFile()"></i></li>
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
                    <th>软件著作权</th>
                    <th>著作权登记号</th>
                    <th>软件类别</th>
                    <th>颁发日期</th>
                    <th>有效日期</th>
                    <th>备注</th>
                    @permission('maintaince')
                    <th>扫描件</th>
                    <th colspan="2">操作</th>
                    @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach($softs as $soft)
                    <tr>
                        <td id="select-{{$soft->id}}" onclick="selectFile(this)">
                            <input type="checkbox" style="display: none" name="id[]" class="fileid" value="{{$soft->id}}">
                            <i class="uk-icon-medium uk-icon-square-o hby"></i>
                        </td>
                        <td>{{$soft->name}}</td>
                        <td>{{$soft->id1}}</td>
                        <td>{{$soft->type}}</td>
                        <td>{{$soft->time_start}}</td>
                        <td>{{$soft->time_end}}</td>
                        <td>@include('softs._remark')</td>
                        @permission('maintaince')
                        <td>@include('softs._download')</td>
                        <td>
                            {{--<a class="uk-button uk-button-primary" href="">修改</a>--}}
                            @include('softs._edit')
                            @include('softs._delete')
                        </td>
                        @endpermission
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $softs->links() }}
        </div>
        @include('utils.selectFile')
@endsection