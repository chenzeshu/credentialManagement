<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-patent-{{$patent->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-patent-{{$patent->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($patent,['route'=>['patents.update', $patent->id],'method'=>'PUT','class'=>'uk-form', 'files'=>true]) !!}
        <fieldset>
            <legend>修改人员信息</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','专利名称：') !!}</div>
                    {!! Form::text('name',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','申请号：') !!}</div>
                    {!! Form::text('id1',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','专利证书号/公告号：') !!}</div>
                    {!! Form::text('id2',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','专利类别：') !!}</div>
                    {!! Form::text('type',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','申请日期：') !!}</div>
                    {!! Form::date('time_apply',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','授权日期：') !!}</div>
                    {!! Form::date('time_start',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','授权公告日期：') !!}</div>
                    {!! Form::date('time_authorize',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','有效截止日期：') !!}</div>
                    {!! Form::date('time_end',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','维护截止年份：') !!}</div>
                    {!! Form::date('time_end_year',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','备注：') !!}</div>
                    {!! Form::textarea('remark',null) !!}</div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">{!! Form::label('name','专利证书扫描件：') !!}</div>
                    <input type="file" name="path[]" multiple></div>
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

