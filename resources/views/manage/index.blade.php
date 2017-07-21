@extends('layouts.app')

@section('content')
        <div>
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">{{\Auth::user()->name}}的审批决策表</span></a></li>
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
                    <th>id</th>
                    <th>提交日期</th>
                    <th>提交人</th>
                    <th>提交项目</th>
                    <th>提交理由</th>
                    <th>过期时间</th>
                    <th>查看细节</th>
                    <th>审批状态</th>
                    <th>审批决策</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($histroies as $histroy)
                    <tr>
                        <td>{{$histroy->id}}</td>
                        <td width="160px">{{$histroy->created_at}}</td>
                        <td>{{$histroy->user->name}}</td>
                        <td>{{$histroy->reason_project}}</td>
                        <td>{{$histroy->reason_words}}</td>
                        <td width="160px">{{$histroy->end_at}}</td>
                        <td><a href="{{route('manage.show', $histroy->id)}}" class="uk-button">查看细节</a></td>
                        <td>
                            @include('manage._details')
                        </td>
                        <td>
                            <button class="uk-button" onclick="passHis({{$histroy->id}})"><i class="uk-icon-hover uk-icon-check" style="color:#9FD256"></i></button>
                            <button class="uk-button" onclick="rejectHis({{$histroy->id}})"><i class="uk-icon-hover uk-icon-close (alias)" style="color:red"></i></button>
                        </td>
                        <td>
                            @include('manage._delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $histroies->links() }}
        </div>

@endsection

@section('customerJS')
    <script>
        /**
         * 通过审批
         */
        function passHis(id) {
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['320px', '210px'], //宽高
                content: '<div class="uk-container margin-top-30">' +
                '过期日期：<input type="date" name="end_time" width="300px" id=pass-'+id+'>' +
                '<br>' +
                '<div class="uk-container"><button onclick="passHistroy('+id+')" class="uk-button uk-button-success margin-top-30">通过审批</button></div>' +
                '</div>'
            })

        }

        function passHistroy(id) {
            let end_time = $("#pass-"+id).val()
            $.post("{{route('manage.pass')}}",{ _token:"{{csrf_token()}}", id:id, end_time:end_time}, function (res) {
                alert(res)
                location.reload()
            })
        }

        /**
         * 驳回审批
         * @param id
         */
        function rejectHis(id) {
            layer.prompt({title: '输入驳回理由，并确认', formType: 2}, function(reason, index){
                $.post("{{route('manage.reject')}}",{ _token:"{{csrf_token()}}", id:id, reason:reason}, function (res) {
                        alert(res)
                        location.reload()
                })
                layer.close(index);
            });
        }

    </script>
    @endsection

