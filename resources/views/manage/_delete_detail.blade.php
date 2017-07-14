<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-danger" data-uk-modal="{target:'#delete-histroy_detail-{{$detail->id}}'}">删除</button>

<!-- 模态对话框 -->
<div id="delete-histroy_detail-{{$detail->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['url'=>['manage/destroy_detail/'.$detail->id],'class'=>'uk-form']) !!}
        <fieldset>
            <legend>删除</legend>
            <p class="uk-text-large">确定删除?</p>
            <br>
            <div class="self-center">
                <a href="{{url('manage/destroy_detail/'.$detail->id)}}" class="uk-button uk-button-primary">确定</a>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

