
<!-- 触发模态对话框的锚 -->
<a href="#create-user" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-user" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'users.store','method'=>'post','class'=>'uk-form']) !!}
        <fieldset>
            <legend>新建</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','姓名：') !!}
                    </div>
                    {!! Form::text('name',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','邮箱：') !!}
                    </div>
                    {!! Form::email('email',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','手机号码：') !!}
                    </div>
                    {!! Form::text('phone',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','密码：') !!}
                    </div>
                    {!! Form::password('password',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','重复密码：') !!}
                    </div>
                    {!! Form::password('password_confirmation',null) !!}
                </div>
            </div>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

