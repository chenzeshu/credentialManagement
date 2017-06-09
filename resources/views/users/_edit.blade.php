<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-users-{{$user->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-users-{{$user->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($user,['route'=>['users.update', $user->id], 'method'=>'PUT','class'=>'uk-form']) !!}
        <fieldset>
            <legend>修改用户角色</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','角色：') !!}
                    </div>
                   @foreach($roles as $role)
                        <input type="radio" value="{{ $role->id }}"
                               name="role" style="margin-top: 5px;" @if(!collect($user->roles)->isEmpty())

                               @if($role->id == $user->roles[0]->id) checked @endif
                                @endif>{{ $role->display_name }}　
                    @endforeach
                    <input type="radio" value="999"
                           name="role" style="margin-top: 5px;" @if(collect($user->roles)->isEmpty()) checked @endif>没有角色

                </div>
            </div>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">提交修改</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

            <style>
                .self-center{
                    margin-left:90px;
                }
            </style>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

