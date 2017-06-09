<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-danger" data-uk-modal="{target:'#delete-patent-{{$patent->id}}'}">删除</button>

<!-- 模态对话框 -->
<div id="delete-patent-{{$patent->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($patent,['route'=>['patents.destroy', $patent->id],'method'=>'delete','class'=>'uk-form']) !!}
        <fieldset>
            <legend>删除</legend>
            <p class="uk-text-large">确定删除：<span class="uk-text-warning">【{{$patent->name}}】</span>?</p>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

