@extends('layouts.app')

@section('content')
        <div>
            <ul class="uk-breadcrumb">
                <li><a href="{{url('home')}}"><span class="uk-text-large uk-text-bold">{{\Auth::user()->name}}的待提交审批表</span></a>
                    @include('self._deleteAll')
                    @include('self._submit')</li>
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
                @foreach($selfs as $self)
                    <tr>
                        <td>{{$self->file_name}}</td>
                        <td>{{$self->file_belongs}}</td>
                        <td>{{$self->created_at}}</td>
                        <td>
                            @include('self._delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $selfs->links() }}
        </div>
        @include('utils.selectFile')
@endsection