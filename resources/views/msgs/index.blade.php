@extends('layouts.app')

@section('content')
        <div>
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">{{ \Auth::user()->name }}的消息表</span></a></li>
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
                    <th>表单编号</th>
                    <th>申请项目</th>
                    <th>申请理由</th>
                    <th>时间</th>
                    <th>改动数量</th>
                    <th>查看细节</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cols as $col)
                    <tr>
                        <td>{{$col->id}}</td>
                        <td>{{$col->reason_project}}</td>
                        <td>{{$col->reason_words}}</td>
                        <td>{{$col->updated_at}}</td>
                        <td>{{$col->_msg}}</td>
                        <td>
                           <a href="{{route('msgs.show', $col->id)}}" class="uk-button uk-button-small">查看细节</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--{{ $histroies->links() }}--}}
        </div>

@endsection

