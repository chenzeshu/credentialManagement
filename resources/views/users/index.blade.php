@extends('layouts.app')

@section('content')
    {{--<div class="uk-grid uk-width-3-4">--}}
        <div class="">
            <ul class="uk-breadcrumb">
                <li><a href="#"><span class="uk-text-large uk-text-bold">用户总览</span></a>
                    <form method="post" action="{{route('users.selectusers')}}" class="uk-form" style="float:right">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" placeholder="用户姓名">
                        <select name="userrole" id="">
                            <option value="">无角色</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="搜索" class="uk-button">
                    </form>

                    {{--@include('users._create')&nbsp; --}}
                  </li>
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
                    <th>用户姓名</th>
                    <th>角色</th>
                    <th>最后登陆时间</th>
                    <th colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            @if(!empty($user->roles))
                                @foreach($user->roles as $role)
                                <button class="uk-button">{{$role->display_name}}</button>
                                @endforeach
                            @endif
                        </td>
                        <td>{{$user->last_login_at}}</td>
                        <td>
                            @include('users._reset')
                            @include('users._edit')
                            @include('users._delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    {{--</div>--}}
@endsection