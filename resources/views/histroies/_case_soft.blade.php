<?php

echo "<span><strong>著作权扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_auth'])) ){
    foreach(unserialize($detail->file_path['path_auth']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}
echo "<hr><span><strong>软件登记扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_soft'])) ){
    foreach(unserialize($detail->file_path['path_soft']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}

?>