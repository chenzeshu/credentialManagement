<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-danger" data-uk-modal="{target:'#delete-credential-{{$credential->id}}'}">删除</button>

<!-- 模态对话框 -->
<div id="delete-credential-{{$credential->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($credential,['route'=>[session('credential').'.destroy', $credential->id],'method'=>'delete','class'=>'uk-form']) !!}
        <fieldset>
            <legend>删除</legend>
            <p class="uk-text-large">确定删除：<span class="uk-text-warning">【{{$credential->name}}】</span>?</p>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

