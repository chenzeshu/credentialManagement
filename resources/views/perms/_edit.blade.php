<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-perms-{{$perm->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-perms-{{$perm->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($perm,['route'=>['perms.update', $perm->id], 'method'=>'PUT','class'=>'uk-form']) !!}
        <fieldset>
            <legend>修改权限</legend>

            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','权限名：') !!}
                    </div>
                    {!! Form::text('display_name', null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','权限说明：') !!}
                    </div>
                    {!! Form::textarea('description', null) !!}
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

