<!-- 模态对话框: 驳回理由 -->
<div id="ex-rejection-{{$histroy->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <fieldset>
            <legend>驳回理由</legend>
            <p class="uk-text-large" style="color:red"><strong>{{$histroy->rejection_reason}}</strong></p>
            <hr>
            <div class="self-center">
                <button class="uk-button uk-button-primary uk-modal-close ">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>
        </fieldset>

    </div>
</div>