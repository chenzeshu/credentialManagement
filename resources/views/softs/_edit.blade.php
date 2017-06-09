<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-soft-{{$soft->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-soft-{{$soft->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($soft,['route'=>['softs.update', $soft->id],'method'=>'PUT','class'=>'uk-form', 'files'=>true]) !!}
        <fieldset>
            <legend>修改</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','软件名称：') !!}
                    </div>
                    {!! Form::text('name',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','著作权登记号：') !!}
                    </div>
                    {!! Form::text('id1',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','软件类别：') !!}
                    </div>
                    {!! Form::text('type',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','颁发日期：') !!}
                    </div>
                    <input type="date" name="time_start">
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','有效日期：') !!}
                    </div>
                    <input type="date" name="time_end">
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
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','著作权扫描件：') !!}
                    </div>
                    <input type="file" name="path_auth[]" multiple>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','软件登记扫描件：') !!}
                    </div>
                    <input type="file" name="path_soft[]" multiple>
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

