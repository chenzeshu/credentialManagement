<!-- 触发模态对话框的按钮 -->
<button class="uk-button" data-uk-modal="{target:'#reset-users-{{$user->id}}'}">重置密码</button>

<!-- 模态对话框 -->
<div id="reset-users-{{$user->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <fieldset>
            <legend>重置密码</legend>
            <p class="uk-text-large">确定重置<span class="uk-text-warning">【{{$user->name}}】</span>的密码?</p>
            <br>
            <div class="self-center">
                <a href="{{route('users.reset', ['id'=>$user->id])}}" class="uk-button uk-button-primary">确定</a>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
    </div>
</div>

