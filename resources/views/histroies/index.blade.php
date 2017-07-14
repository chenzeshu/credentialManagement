@extends('layouts.app')

@section('content')
        <div>
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">{{\Auth::user()->name}}的提交历史表</span></a></li>
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
                    <th>提交日期</th>
                    <th>审批人</th>
                    <th>提交理由</th>
                    <th>项目名称</th>
                    <th>过期时间</th>
                    <th>审批状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach($histroies as $histroy)
                    <tr>
                        <td>{{$histroy->created_at}}</td>
                        <td>{{$histroy->checker->name}}</td>
                        <td>{{$histroy->reason_words}}</td>
                        <td>{{$histroy->reason_project}}</td>
                        <td>{{$histroy->end_at}}</td>
                        <td>
                            @include('histroies._details')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $histroies->links() }}
        </div>

@endsection

