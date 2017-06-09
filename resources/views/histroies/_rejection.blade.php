<!-- 模态对话框: 驳回理由 -->
<div id="ex-rejection-{{$histroy->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($histroy,['route'=>['patents.destroy', $histroy->id],'method'=>'delete','class'=>'uk-form']) !!}
        <fieldset>
            <legend>驳回理由</legend>
            <p class="uk-text-large" style="color:red"><strong>{{$histroy->rejection_reason}}</strong></p>
            <hr>
            <p class="uk-text-large">是否修改表单, 然后重新提交?</p>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>