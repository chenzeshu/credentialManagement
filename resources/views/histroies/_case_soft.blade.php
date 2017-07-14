<?php
//
//echo "<span><strong>著作权扫描件：</strong></span>
//                                <hr>";
//if(!empty(unserialize($detail->file_path['path_auth'])) ){
//    foreach(unserialize($detail->file_path['path_auth']) as $_name => $_path){
//        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
//    }
//}
//echo "<hr><span><strong>软件登记扫描件：</strong></span>
//                                <hr>";
//if(!empty(unserialize($detail->file_path['path_soft'])) ){
//    foreach(unserialize($detail->file_path['path_soft']) as $_name => $_path){
//        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
//    }
//}
//

echo "<span><strong>著作权扫描件：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_auth']) ){
    foreach($detail->file_path['path_auth'] as $_name => $_path){
        if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
            echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
            echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_auth\', \''.$detail->id.'\')" ' ?>
                @if($_path['flag'] == 1)
                    checked
                @endif
            <?php '>';
            echo '<br>';
        }
        else{
            if($_path['flag'] == 1){ //todo 允许下载
                echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
            }else{
                echo '<a href="javascript:alert(\'管理员未同意下载\')" class="uk-button" style=\'background:#DBDBDB\'>'.$_name.'</a>';
            }
        }

    }
}
echo "<hr><span><strong>软件登记扫描件：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_soft']) ){
        foreach($detail->file_path['path_soft'] as $_name => $_path){
        if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
            echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
            echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_soft\', \''.$detail->id.'\')" ' ?>
            @if($_path['flag'] == 1)
                checked
            @endif
            <?php '>';
            echo '<br>';
            }
        else{
            if($_path['flag'] == 1){ //todo 允许下载
                echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
            }else{
                echo '<a href="javascript:alert(\'管理员未同意下载\')" class="uk-button" style=\'background:#DBDBDB\'>'.$_name.'</a>';
            }
        }

    }
}


?>