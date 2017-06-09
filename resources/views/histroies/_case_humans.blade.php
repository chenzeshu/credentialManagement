<?php

echo "<span><strong>证件照扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_i'])) ){
    foreach(unserialize($detail->file_path['path_i']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}
echo "<hr>";
echo "<span><strong>身份证扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_credit'])) ){
    foreach(unserialize($detail->file_path['path_credit']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}
echo "<hr>";
echo "<span><strong>学历证书扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_qualification'])) ){
    foreach(unserialize($detail->file_path['path_qualification']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}
echo "<hr>";
echo "<span><strong>学位证书扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_degree'])) ){
    foreach(unserialize($detail->file_path['path_degree']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}
echo "<hr>";
echo "<span><strong>职称证书扫描件：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_title'])) ){
    foreach(unserialize($detail->file_path['path_title']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}
echo "<hr>";
echo "<span><strong>技能培训证书：</strong></span>
                                <hr>";
if(!empty(unserialize($detail->file_path['path_skill'])) ){
    foreach(unserialize($detail->file_path['path_skill']) as $_name => $_path){
        echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path))).'" class="uk-button">'.$_name.'</a>';
    }
}

?>