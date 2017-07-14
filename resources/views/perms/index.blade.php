@extends('layouts.app')

@section('content')
    {{--<div class="uk-grid uk-width-3-4">--}}
        <div class="">
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">权限总览</span></a>
                    @include('perms._create')&nbsp;
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
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr>
                    <th>权限名</th>
                    <th>权限描述</th>
                    <th>权限权限</th>
                    <th colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($perms as $perm)
                    <tr>
                        <td>{{$perm->display_name}}</td>
                        <td>{{$perm->description}}</td>
                        <td>@if(!empty($perm->perms))
                                @foreach($perm->perms as $perm)
                                    <button class="uk-button uk-button-small">{{$perm->display_name}}</button>
                                @endforeach
                            @else
                                暂无
                            @endif</td>
                        <td>
                            @include('perms._edit')
                            @include('perms._delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $perms->links() }}
        </div>
    {{--</div>--}}
@endsection