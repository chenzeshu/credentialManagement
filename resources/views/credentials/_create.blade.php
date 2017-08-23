<!-- 触发模态对话框的锚 -->
<!--suppress ALL -->
<a href="#create-credential" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-credential" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>session('credential').'.store','method'=>'post','class'=>'uk-form', 'files'=>true]) !!}
        <fieldset>
            <legend>新增{{session('name')}}</legend>
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
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

