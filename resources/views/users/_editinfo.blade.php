<!-- 触发模态对话框的按钮 -->

<a data-uk-modal="{target:'#editpassword-users'}">修改个人信息</a>

<!-- 模态对话框 -->
<div id="editpassword-users" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <?php $user = getMe() ?>
        {!! Form::open(['route'=>['users.editinfo'], 'method'=>'post','class'=>'uk-form']) !!}
        <fieldset>
            <h2>修改个人信息</h2>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','姓名：') !!}
                    </div>
                    <input type="text" name="name" value="{{$user->name}}">
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','邮箱：') !!}
                    </div>
                    <input type="email" name="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','手机：') !!}
                    </div>
                    <input type="text" name="phone" value="{{$user->phone}}">
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

