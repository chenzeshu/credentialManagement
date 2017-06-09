<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-credential-{{$credential->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-credential-{{$credential->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($credential,['route'=>[session('credential').'.update', $credential->id], 'files'=>true, 'method'=>'PUT','class'=>'uk-form']) !!}
        <fieldset>
            <legend>修改{{session('name')}}</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','名称：') !!}
                    </div>

                    {!! Form::text('name',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','颁发日期：') !!}
                    </div>

                    {!! Form::date('time_start',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','有效日期：') !!}
                    </div>

                    {!! Form::date('time_end',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','文件路径：') !!}
                    </div>
                        <input type="file" name="path[]" multiple>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','备注：') !!}
                    </div>
                    {!! Form::textarea('remark',null) !!}
                </div>
            </div>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">提交修改</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

            <style>
                .self-center{
                    margin-left:90px;
                }
            </style>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

