@extends('layouts.app')

@section('content')
    <div>
        <ul class="uk-breadcrumb">
            <li><span class="uk-text-large uk-text-bold">审批工具表</span></li>
            <li>（目前修改表id：{{$histroy->id}}，投标项目:{{$histroy->reason_project !== null ? $histroy->reason_project : '未填写'}}）
                <button class="uk-button uk-button-primary" onclick="showTips()">新增</button>
                <button class="uk-button" onclick="history.go(-1)">返回</button>
                @include('manage_util._ensure')
            </li>
        </ul>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="uk-alert" data-uk-alert>
                    <a href="" class="uk-alert-close uk-close"></a>
                    <p>{{$error}}</p>
                </div>
            @endforeach
        @endif
        @if(session('callback'))
            <div class="uk-alert uk-alert-success" data-uk-alert>
                <a href="" class="uk-alert-close uk-close"></a>
                <p>{{session('callback')}}</p>
            </div>
        @endif
        <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
            <thead>
            <tr>
                <th>新增文件名称</th>
                <th colspan="2">操作</th>
            </tr>
            </thead>
            <tbody>
            @if(count($details) )
                @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->file_name}}</td>
                        <td>
                            @include('manage_util._delete_detail')
                        </td>
                    </tr>
                @endforeach
            @else
            <div class="uk-alert" data-uk-alert>
                <a href="" class="uk-alert-close uk-close"></a>
                <p>表单已经没有文件</p>
            </div>
            @endif
            </tbody>
        </table>

        {{ $details->links() }}
    </div>
@endsection

@section('customerJS')
    <script>
//        function showAnimation() {
//            var app = document.getElementById('app');
//            var front = document.createElement('div');
////            front.style.backgroundColor = 'rgba(0,0,0,0.3)'
//            front.style.backgroundColor = '#000000'
//            front.style.opacity = '0.6'
//            front.style.width = '100vw'
//            front.style.height = '100vh'
//            app.parentNode.insertBefore(front, app)
//        }
    </script>
@endsection