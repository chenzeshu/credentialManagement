<!-- 触发模态对话框的锚 -->
<a href="#download-soft-{{$soft->id}}" class="uk-button" data-uk-modal>扫描件</a>

<!-- 模态对话框 -->
<div id="download-soft-{{$soft->id}}" class="uk-modal">
    <div class="uk-modal-dialog uk-container-center">
        <a class="uk-modal-close uk-close"></a>
        <span><strong>著作权扫描件：</strong></span>
        <hr>
        @foreach($soft->path_auth as $k=>$path)
            <a href="{{ url('softs/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{$k}}</a>
            &nbsp;&nbsp;<a href='javascript:deleteFile({{json_encode($soft->id)}},{{json_encode($k)}} ,{{json_encode($path)}})' class="uk-icon-hover uk-icon-close"></a>
            &nbsp;  &nbsp;
        @endforeach
        <hr>
        <span><strong>软件登记扫描件：</strong></span>
        <hr>
        @foreach($soft->path_soft as $m=>$path)
            <a href="{{ url('softs/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{$m}}</a>
            &nbsp;&nbsp;<a href='javascript:deleteFile({{json_encode($soft->id)}},{{json_encode($m)}} ,{{json_encode($path)}})' class="uk-icon-hover uk-icon-close"></a>
            &nbsp;  &nbsp;
        @endforeach
    </div>
</div>

@section('customerJS')
    <script>
        function deleteFile(id, key, path){
            $.post("{{url('softs/delete')}}", {id:id, _token:"{{csrf_token()}}",key:key, path:path}, function (res) {
                alert(res.data+",点击后刷新")
                setTimeout(function () {
                    location.reload()
                }, 500)
            })
        }
    </script>
@endsection