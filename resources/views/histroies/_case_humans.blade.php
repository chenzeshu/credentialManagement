<?php
echo "<span><strong>证件照扫描件：</strong></span>
                                <hr>";
//if(!empty(unserialize($detail->file_path['path_i'])) ){
if(!empty($detail->file_path['path_i']) ){
    foreach($detail->file_path['path_i'] as $_name => $_path){
            if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
                echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
                echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_i\', \''.$detail->id.'\')" ' ?>
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
echo "<hr>";
echo "<span><strong>身份证扫描件：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_credit']) ){
        foreach($detail->file_path['path_credit'] as $_name => $_path){
            if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
                echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
                echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_credit\', \''.$detail->id.'\')" ' ?>
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

echo "<hr>";
echo "<span><strong>学历证书扫描件：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_qualification']) ){
        foreach($detail->file_path['path_qualification'] as $_name => $_path){
            if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
                echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
                echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_qualification\', \''.$detail->id.'\')" ' ?>
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
echo "<hr>";
echo "<span><strong>学位证书扫描件：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_degree']) ){
        foreach($detail->file_path['path_degree'] as $_name => $_path){
            if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
            echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
            echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_degree\', \''.$detail->id.'\')" ' ?>
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
echo "<hr>";
echo "<span><strong>职称证书扫描件：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_title']) ){
        foreach($detail->file_path['path_title'] as $_name => $_path){
            if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
            echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
            echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_title\', \''.$detail->id.'\')" ' ?>
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
echo "<hr>";
echo "<span><strong>技能培训证书：</strong></span>
                                <hr>";
if(!empty($detail->file_path['path_skill']) ){
        foreach($detail->file_path['path_skill'] as $_name => $_path){
            if(\Illuminate\Support\Facades\Auth::user()->hasRole('checker')){
                echo '<a href="'.route('histroy.download', str_replace('%','%25',urlencode($_path['path']))).'" class="uk-button">'.$_name.'</a>';
                echo '允许下载 <input type="checkbox" onclick="decideDownload(this, \''.$_name.'\', \'path_skill\', \''.$detail->id.'\')" ' ?>
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