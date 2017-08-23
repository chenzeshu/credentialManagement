@extends('layouts.app')

@section('content')
    {{--<div class="uk-grid uk-width-3-4">--}}
        <div class="">
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">角色总览</span></a>
                    @include('roles._create')&nbsp;
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
                    <th>角色名</th>
                    <th>角色描述</th>
                    <th width="600">角色权限</th>
                    <th>目前拥有此角色者</th>
                    <th colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->display_name}}</td>
                        <td>{{$role->description}}</td>
                        <td>@if(!empty($role->perms))
                                @foreach($role->perms as $perm)
                                    <button class="uk-button uk-button-small">{{$perm->display_name}}</button>
                                @endforeach
                            @else
                                暂无
                            @endif</td>
                        <td>@if(!empty($role->users))
                                @foreach($role->users as $user)
                                    <button class="uk-button uk-button-small">{{$user->name}}</button>
                                @endforeach
                            @else
                                暂无
                            @endif</td>
                        <td>
                            @include('roles._edit')
                            @include('roles._delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $roles->links() }}
        </div>
    {{--</div>--}}
@endsection