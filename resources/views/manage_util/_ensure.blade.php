<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-success" data-uk-modal="{target:'#ensure'}">完成修改</button>

<!-- 模态对话框 -->
<div id="ensure" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>['manage_util.ensure'],'method'=>'get','class'=>'uk-form']) !!}
        <fieldset>
            <legend>完成修改</legend>
            <p class="uk-text-large">本临时表会被清空，确认提交?</p>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

