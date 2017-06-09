@extends('layouts.app')

@section('content')
    <div>
        <ul class="uk-breadcrumb">
            <li><a href="{{route('histroy.index')}}"><span class="uk-text-large uk-text-bold">{{\Auth::user()->name}}的提交历史</span></a></li>
            <li class="uk-active"><span class="uk-text-large uk-text-bold">通过审批</span></li>
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
                <th>文件属于</th>
                <th>提交日期</th>
                <th colspan="2">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($details as $detail)
                <tr>
                    <td>{{$detail->file_name}}</td>
                    <td>{{$detail->file_belongs}}</td>
                    <td>{{$detail->created_at}}</td>
                    <td>
                        @include('histroies._download')
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $details->links() }}
    </div>
@endsection