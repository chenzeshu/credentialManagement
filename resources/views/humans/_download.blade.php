<!-- 触发模态对话框的锚 -->
<a href="#download-human-{{$human->id}}" class="uk-button" data-uk-modal>扫描件</a>

<!-- 模态对话框 -->
<div id="download-human-{{$human->id}}" class="uk-modal">
    <div class="uk-modal-dialog uk-container-center">
        <a class="uk-modal-close uk-close"></a>
        <span><strong>证件照扫描件：</strong></span>
        <hr>
        @if(!empty($human->path_i))
        @foreach($human->path_i as $k=> $path)
            <a href="{{ url('humans/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{ $k }}</a>
            &nbsp;<a href='javascript:deleteFile({{json_encode($human->id)}},0 ,{{json_encode($path)}},{{ json_encode($k) }})' class="uk-icon-hover uk-icon-close"></a>
        @endforeach
        @endif
        <hr>
        <span><strong>身份证扫描件：</strong></span>
        <hr>
        @if(!empty($human->path_credit))
        @foreach($human->path_credit as $k=> $path)
            <a href="{{ url('humans/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{ $k }}</a>
            &nbsp;<a href='javascript:deleteFile({{json_encode($human->id)}},1 ,{{json_encode($path)}},{{ json_encode($k) }})' class="uk-icon-hover uk-icon-close"></a>
        @endforeach
        @endif
        <hr>
        <span><strong>学历证书扫描件：</strong></span>
        <hr>
        @if(!empty($human->path_qualification))
        @foreach($human->path_qualification as $k=> $path)
            <a href="{{ url('humans/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{ $k }}</a>
            &nbsp;<a href='javascript:deleteFile({{json_encode($human->id)}},2 ,{{json_encode($path)}},{{ json_encode($k) }})' class="uk-icon-hover uk-icon-close"></a>
        @endforeach
        @endif
        <hr>
        <span><strong>学位证书扫描件：</strong></span>
        <hr>
        @if(!empty($human->path_degree))
        @foreach($human->path_degree as $k=> $path)
            <a href="{{ url('humans/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{ $k }}</a>
            &nbsp;<a href='javascript:deleteFile({{json_encode($human->id)}},3 ,{{json_encode($path)}},{{ json_encode($k) }})' class="uk-icon-hover uk-icon-close"></a>
        @endforeach
        @endif
        <hr>
        <span><strong>职称证书扫描件：</strong></span>
        <hr>
        @if(!empty($human->path_title))
        @foreach($human->path_title as $k=> $path)
            <a href="{{ url('humans/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{ $k }}</a>
            &nbsp;<a href='javascript:deleteFile({{json_encode($human->id)}},4 ,{{json_encode($path)}},{{ json_encode($k) }})' class="uk-icon-hover uk-icon-close"></a>
        @endforeach
        @endif
        <hr>
        <span><strong>技能培训证书：</strong></span>
        <hr>
        @if(!empty($human->path_skill))
        @foreach($human->path_skill as $k=> $path)
            <a href="{{ url('humans/download').'/'.str_replace('%','%25',urlencode($path)) }}" class="uk-button">{{ $k }}</a>
            &nbsp;<a href='javascript:deleteFile({{json_encode($human->id)}},5 ,{{json_encode($path)}},{{ json_encode($k) }})' class="uk-icon-hover uk-icon-close"></a>
        @endforeach
        @endif
        <hr>
    </div>
</div>

@section('customerJS')
    <script>
        function deleteFile(id, type, path, key){
            $.post("{{url('humans/delete')}}", {id:id, _token:"{{csrf_token()}}",type:type, path:path, key:key}, function (res) {
                alert(res.data+",点击后刷新")
                setTimeout(function () {
                    location.reload()
                }, 500)
            })
        }
    </script>
@endsection