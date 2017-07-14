
<!-- 触发模态对话框的锚 -->
<a href="#create-human" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-human" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'humans.store','method'=>'post','files'=>true, 'class'=>'uk-form']) !!}
        <fieldset>
            <legend>新建人员信息</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">{!! Form::label('name','姓名：') !!}</div>
                    {!! Form::text('name',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','性别：') !!}
                &nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::label('name','男')!!}
                {!! Form::radio('sex','男')!!}
                {!! Form::label('name','女')!!}
                {!! Form::radio('sex','女')!!}
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">{!! Form::label('name','身份证号：') !!}</div>
                    {!! Form::text('credit',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">{!! Form::label('name','部门：') !!}</div>
                    {!! Form::text('department',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">{!! Form::label('name','专业：') !!}</div>
                    {!! Form::text('profession',null) !!}
                    <div class="uk-width-1-6">{!! Form::label('name','学位：') !!}</div>
                    {!! Form::text('degree',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6"> {!! Form::label('name','学历：') !!}</div>
                    {!! Form::text('qualification',null) !!}
                    <div class="uk-width-1-6"> {!! Form::label('name','毕业时间：') !!}</div>
                    {!! Form::date('graduated_at',null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">{!! Form::label('name','职称：') !!}</div>
                    {!! Form::text('title',null) !!}
                    <div class="uk-width-1-6"> {!! Form::label('name','职称获取时间：') !!}</div>
                    {!! Form::date('gather_title_at',null) !!}
                </div>
            </div>
            <div>
                <div class="uk-grid">
                    <div class="uk-width-1-6">{!! Form::label('name','邮箱：') !!}</div>
                    {!! Form::text('email',null) !!}
                    <div class="uk-width-1-6">{!! Form::label('name','手机：') !!}</div>
                    {!! Form::text('phone',null) !!}
                </div>
            </div>
            <br>
            <div class="uk-form-row">
                {!! Form::label('name','技能培训名称：') !!}
                {!! Form::text('skill',null) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','技能获取时间：') !!}
                {!! Form::date('gather_skill_at',null) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','入职时间：') !!}
                {!! Form::date('time_enter',null) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','备注：') !!}
                {!! Form::textarea('remark',null) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','证件照扫描件：') !!}
                <input type="file" name="path_i[]" multiple>
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','身份证扫描件：') !!}
                <input type="file" name="path_credit[]" multiple>
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','学历证书扫描件：') !!}
                <input type="file" name="path_qualification[]" multiple>
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','学位证书扫描件：') !!}
                <input type="file" name="path_degree[]" multiple>
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','职称证书扫描件：') !!}
                <input type="file" name="path_title[]" multiple>
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','技能培训证书扫描件：') !!}
                <input type="file" name="path_skill[]" multiple>
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

