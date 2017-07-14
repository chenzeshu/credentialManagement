
{{--
@now_time和$a_month_later在index.blade.php的循环外部生产，避免了多次循环重新生成造成的损耗
@param $now_time 当前时间戳time()
@param $a_month_later 当前时间戳加一个月的时间戳
--}}
@if($patent->time_end)
    @if(strtotime($patent->time_end) > $a_month_later)
        {{--一个月内未到期--}}
        <button class="uk-button uk-button-success">
    @elseif(strtotime($patent->time_end) > $now_time && strtotime($patent->time_end) <= $a_month_later)
        {{--一个月内到期--}}
        <button class="uk-button uk-button-warning">
    @elseif(strtotime($patent->time_end) <= $now_time)
        <button class="uk-button uk-button-danger">
    @endif
@else
    未填写
@endif

