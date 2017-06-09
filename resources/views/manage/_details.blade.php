<?php
switch ($histroy->examine_type){
    case 0:
        echo "<button class='uk-button uk-button-primary'>审批中</button>";
        break;
    case 1:
        //todo 建议改成a链接, 传histroy->id, 使用show方法, 并且在show方法前加一个中间件, 验证传的histroy->id的examine_type是否审批通过 && 是否过期
        echo "<button class='uk-button uk-button-success'>审批通过</button>";
        break;
    case 2:
        echo "<button class='uk-button uk-button-danger' data-uk-modal=\"{target:'#ex-rejection-{$histroy->id}'}\">审批驳回</button>";
?>

@include('manage._rejection')

<?php
        break;
    default:
        break;
}
?>





