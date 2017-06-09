<!-- 触发模态对话框的锚 -->
<a href="#download-credential-{{$credential->id}}" class="uk-button" data-uk-modal>扫描件</a>

<!-- 模态对话框 -->
<div id="download-credential-{{$credential->id}}" class="uk-modal">
    <div class="uk-modal-dialog uk-container-center">
        <a class="uk-modal-close uk-close"></a>
        <span><strong>资质文件下载：</strong></span>
        @if(!empty($credential->path))
        @foreach($credential->path as $k=>$path)
            <a href="{{ url(session('credential').'/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{$k}}</a>
            &nbsp;&nbsp;<a href='javascript:deleteFile({{json_encode($credential->id)}}, {{json_encode($k)}}, {{json_encode($path)}})' class="uk-icon-hover uk-icon-close"></a>
            &nbsp;&nbsp;
        @endforeach
        @endif
    </div>
</div>

@section('customerJS')
    <script>
        function deleteFile(id, key, path){
            $.post("{{url(session('credential').'/delete')}}", {id:id, _token:"{{csrf_token()}}",key:key, path:path}, function (res) {
                alert(res.data+",点击后刷新")
                setTimeout(function () {
                    location.reload()
                }, 500)
            })
        }
    </script>
@endsection