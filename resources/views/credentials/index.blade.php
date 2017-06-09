@extends('layouts.app')

@section('content')
    {{--<div class="uk-grid uk-width-3-4">--}}
        <div class="">
            <ul class="uk-breadcrumb">
                <li><a href="{{url('home')}}"><span class="uk-text-large uk-text-bold">{{session('name')}}总览</span></a>
                    @include('credentials._create')&nbsp; <i class="uk-icon-large uk-icon-plus-square" style="line-height:28px"
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
                    <div class="uk-alert uk-alert-danger" data-uk-alert>
                        <a href="" class="uk-alert-close uk-close"></a>
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr>
                    <th><button onclick='cancelAllFiles()' class="uk-button uk-button-small">全选/取消</button></th>
                    <th>{{session('name')}}</th>
                    <th>颁发日期</th>
                    <th>结束日期</th>
                    <th>备注</th>
                    @permission('maintaince')
                    <th>下载文件</th>
                    <th colspan="2">操作</th>
                    @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach($credentials as $credential)
                    <tr>
                        <td id="select-{{$credential->id}}" onclick="selectFile(this)">
                            <input type="checkbox" style="display: none" name="id[]" class="fileid" value="{{$credential->id}}">
                            <i class="uk-icon-medium uk-icon-square-o hby"></i>
                        </td>
                        <td>{{$credential->name}}</td>
                        <td>{{$credential->time_start}}</td>
                        {{--time_end后面改成三种状态的提示--}}
                        <td>{{$credential->time_end}}</td>
                        <td>@include('credentials._remark')</td>
                        @permission('maintaince')
                        <td>@include('credentials._download')</td>
                        <td>
                            {{--<a class="uk-button uk-button-primary" href="">修改</a>--}}
                            @include('credentials._edit')
                            @include('credentials._delete')
                        </td>
                        @endpermission
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $credentials->links() }}
        </div>
    @include('utils.selectFile')
    {{--</div>--}}
@endsection