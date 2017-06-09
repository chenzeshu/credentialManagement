
<!-- 触发模态对话框的锚 -->
<a href="#create-soft" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-soft" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'roles.store','method'=>'post','class'=>'uk-form']) !!}
        <fieldset>
            <legend>新建角色</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','角色系统名：') !!}
                    </div>
                    {!! Form::text('name', null) !!}　***
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','角色名：') !!}
                    </div>
                    {!! Form::text('display_name', null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','角色说明：') !!}
                    </div>
                    {!! Form::textarea('description', null) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-4">
                        {!! Form::label('name','权限：') !!}
                    </div>
                    @foreach($perms as $perm)
                        <input type="checkbox" value="{{ $perm->id }}"
                               name="perms[]" style="margin-top: 5px;">{{ $perm->display_name }}　
                    @endforeach
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

