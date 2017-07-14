@extends('layouts.app')

@section('content')
    <div>
        <ul class="uk-breadcrumb">
            <li><span class="uk-text-large uk-text-bold">{{$info->username}}的提交历史</span></li>
            <li class="uk-active"><span class="uk-text-large uk-text-bold">{{$info->reason_project}}</span></li>
            @if(count($details))
            <li>（提交于：{{$details[0]->created_at}}）
                <button class="uk-button uk-button-primary" onclick="addFileToForm()">新增</button>
                <button class="uk-button" onclick="history.go(-1)">返回</button>
            </li>
            @endif
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
                <th colspan="2">操作</th>
            </tr>
            </thead>
            <tbody>
            @if(count($details) )
                @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->file_name}}</td>
                        <td>
                            @include('histroies._download')
                            @include('manage._delete_detail')
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
        function addFileToForm() {
            alert('思路：做一个manager_add表，将选择的放入这个表，然后和用户提交表合并')
        }
    </script>
@endsection