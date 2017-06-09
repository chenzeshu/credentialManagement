<!-- 触发模态对话框的锚 -->
<a href="#remark-human-{{$human->id}}" class="uk-button" data-uk-modal>备注</a>

<!-- 模态对话框 -->
<div id="remark-human-{{$human->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {{ $human->remark }}
    </div>
</div>