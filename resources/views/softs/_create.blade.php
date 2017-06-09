
<!-- 触发模态对话框的锚 -->
<a href="#create-soft" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-soft" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'softs.store','method'=>'post','class'=>'uk-form', 'files'=>true]) !!}
        <fieldset>
            <legend>新建</legend>
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
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

