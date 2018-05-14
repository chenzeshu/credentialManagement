<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-roles-{{$role->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-roles-{{$role->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($role,['route'=>['roles.update', $role->id], 'method'=>'PUT','class'=>'uk-form']) !!}
        <fieldset>
            <legend>修改角色</legend>

            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','角色名：') !!}
                    </div>
                    {!! Form::text('display_name', null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','角色说明：') !!}
                    </div>
                    {!! Form::textarea('description', null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','权限：') !!}
                    </div>
                   @foreach($perms as $perm)
                        <input type="checkbox" value="{{ $perm->id }}"
                               name="perms[]" style="margin-top: 5px;" @if(!collect($role->perms)->isEmpty())
                               @foreach($role->perms as $rperm)
                                    @if($rperm->id == $perm->id)checked  @endif
                               @endforeach
                               @endif>{{ $perm->display_name }}　
                   @endforeach
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

