<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#self-submit'}">提交审批</button>

<!-- 模态对话框 -->
<div id="self-submit" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'histroy.store','method'=>'post','class'=>'uk-form']) !!}
        <fieldset>
            <legend>提交</legend>
            <div class="uk-form-row">
                <select name="reason_type" id="reason_type" onchange="selectReason()">
                    <option value="0">投标(钱正宇)</option>
                    <option value="1">报项目(高晓峰)</option>
                    <option value="2">资质维护(高晓峰)</option>
                    <option value="3">项目合作(高晓峰)</option>
                    <option value="4">其他(高晓峰)</option>
                </select> <strong style="color:red">★</strong>
            </div>
            <div class="uk-form-row reason_hook" style="display: none">
                <input type="text" placeholder="提交审批理由" name="reason_words" class="uk-form-width-large"> <strong style="color:red">★</strong>
            </div>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

@section('customerJS')
    <script>
        selectReason()
        var cc = console.log
        function selectReason() {
            let selected = $('#reason_type').children('option:selected')
            let val = selected.val()
            let words = selected.html()

            let reason_hook = $('.reason_hook')
            let destination = reason_hook.children('input')
            if(val === "4"){
                reason_hook.show()
                destination.attr('placeholder','审批理由不能为空!')
            }else{
                reason_hook.hide()
                switch (val){
                    case "0":
                        destination.val('投标')
                        break
                    case "1":
                        destination.val('报项目')
                        break
                    case "2":
                        destination.val('资质维护')
                        break
                    case "3":
                        destination.val('项目合作')
                        break
                }
            }
        }
    </script>
@endsection