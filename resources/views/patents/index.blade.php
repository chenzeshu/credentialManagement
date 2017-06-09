@extends('layouts.app')

@section('content')

        <div>
            <ul class="uk-breadcrumb">
                <li><a href="{{url('home')}}"><span class="uk-text-large uk-text-bold">{{session('name')}}总览</span></a>
                    @include('patents._create')&nbsp; <i class="uk-icon-large uk-icon-plus-square" style="line-height:28px"
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
                    <th>专利名称</th>
                    <th>申请号</th>
                    <th>专利证书号/公告号</th>
                    <th>专利类别</th>
                    <th>申请日期</th>
                    <th>授权日期</th>
                    <th>授权公告日期</th>
                    <th>有效截止日期</th>
                    <th>维护截止年份</th>
                    <th>备注</th>
                    @permission('maintaince')
                    <th>专利证书扫描件</th>
                    <th colspan="2">操作</th>
                    @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach($patents as $patent)
                    <tr>
                        <td id="select-{{$patent->id}}" onclick="selectFile(this)">
                            <input type="checkbox" style="display: none" name="id[]" class="fileid" value="{{$patent->id}}">
                            <i class="uk-icon-medium uk-icon-square-o hby"></i>
                        </td>
                        <td>{{$patent->name}}</td>
                        <td>{{$patent->id1}}</td>
                        <td>{{$patent->id2}}</td>
                        <td>{{$patent->type}}</td>
                        <td>{{$patent->time_apply}}</td>
                        <td>{{$patent->time_start}}</td>
                        <td>{{$patent->time_authorize}}</td>
                        <td>{{$patent->time_end}}</td>
                        <td>{{$patent->time_end_year}}</td>
                        <td>@include('patents._remark')</td>
                        @permission('maintaince')
                        <td>@include('patents._download')</td>
                        <td>
                            {{--<a class="uk-button uk-button-primary" href="">修改</a>--}}
                            @include('patents._edit')
                            @include('patents._delete')
                        </td>
                        @endpermission
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $patents->links() }}
        </div>
        @include('utils.selectFile')
@endsection