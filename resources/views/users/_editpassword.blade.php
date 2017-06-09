<!-- 触发模态对话框的按钮 -->

<a data-uk-modal="{target:'#editpassword-users'}">修改密码</a>

<!-- 模态对话框 -->
<div id="editpassword-users" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>['users.editpassword'], 'method'=>'post','class'=>'uk-form']) !!}
        <fieldset>
            <h2>修改密码</h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','原密码：') !!}
                    </div>
                        {!! Form::password('password_o',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','新密码：') !!}
                    </div>
                    {!! Form::password('password',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','再次输入新密码：') !!}
                    </div>
                    {!! Form::password('password_confirmation',null) !!}
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

