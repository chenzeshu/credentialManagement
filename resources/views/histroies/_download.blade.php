<!-- 触发模态对话框的锚 -->
<a href="#download-histroy-{{$detail->id}}" class="uk-button" data-uk-modal>下载文件</a>

<!-- 模态对话框 -->
<div id="download-histroy-{{$detail->id}}" class="uk-modal">
    <div class="uk-modal-dialog uk-container-center">
        <a class="uk-modal-close uk-close"></a>
        <span><strong>文件下载：</strong></span>
        @if(!empty($detail->file_path))
            <?php
                switch ($detail->file_belongs){
                    case "humans":
                        ?>

                        @include('histroies._case_humans')

                        <?php
                        break;
                    case "soft_certificates":
                        ?>

                        @include('histroies._case_soft')

                        <?php
                        break;
                    default:
                        foreach ($detail->file_path as $k=>$path){
                            echo '<a href="'. route('histroy.download' , str_replace('%','%25',urlencode($path))) .'" class="uk-button">'.$k.'</a>';
                        }
                        break;
                }
            ?>
            &nbsp;&nbsp;
        @endif
    </div>
</div>
