<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-danger" data-uk-modal="{target:'#delete-self-all'}">清空本表</button>

<!-- 模态对话框 -->
<div id="delete-self-all" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <h3>清空本表</h3>
        <hr>
            <div class="self-center">
                <a href="{{route('self.destroyAll')}}" class="uk-button uk-button-danger" >确定</a>
                <a class="uk-modal-close uk-button">取消</a>
            </div>
    </div>
</div>

