@extends('layouts.app')

@section('content')
    <div>
        <ul class="uk-breadcrumb">
            <li><a href="#"><span class="uk-text-large uk-text-bold">细节</span></a></li>
            <li><button class="uk-button" onclick="history.go(-1)">返回</button></li>
        </ul>
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
                <th>文件名称</th>
                <th>操作类型</th>
                <th>操作时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($details as $detail)
                @if($detail->type == 0)
                    @foreach($detail->names as $name)
                    <tr>
                        <td>{{$name}}</td>
                        <td><button class="uk-button uk-button-small uk-button-primary">修改</button></td>
                        <td>{{$detail->created_at}}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>{{$detail->names}}</td>
                    <td><button class="uk-button uk-button-small uk-button-danger">删除</button></td>
                    <td>{{$detail->created_at}}</td>
                </tr>
                @endif

            @endforeach
            </tbody>
        </table>

        {{--{{ $details->links() }}--}}
    </div>
@endsection