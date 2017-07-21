<div id="histroy_id" data-content="{{session('histroy_id')}}"></div>
<script>
        /**
         * @param ele是被选中的文件的id的数组集合
         * @type {Array}
         */
        var ele = []

        /**
         *  选中文件 + 改变图标状态
         */
        function selectFile(obj) {
            //因为checkbox有全选的bug，所以用了其他方法
            //todo 改变目标checkbox状态
            var flag = $(obj).children('input').attr('checked')
            var val = $(obj).children('input').val()
            //todo 改变check选择状态
            $(obj).children('input').attr('checked',!flag)
            //todo 改变文字的状态
            if (!flag){
                $(obj).children('i').removeClass('uk-icon-square-o').addClass('uk-icon-plus-square');
                //todo 避免重复选择
                if($.inArray(val, ele)<0){
                    ele.push(val)
                }
            }else{
                let index = $.inArray(val, ele)
                ele.splice(index,1)
                $(obj).children('i').removeClass('uk-icon-plus-square').addClass('uk-icon-square-o');
            }
        }

        /**
         * 将选中的文件id提交到个人审批表单
         */
        function inputFile(obj) {
            $(obj).fadeOut()

            setTimeout(function () {
                $(obj).fadeIn()
            }, 100)

            if(ele.length ===0){
                alert("你还没有选择文件");
            }
            else{
                var url = "{{route('self.input')}}";
                var data = {
                    _token:"{{csrf_token()}}",
                    fileId : ele,
                    type:"{{session('credential')}}"
                }
                $.post(url, data, function (res) {
                   alert('提交成功,且已自动过滤重复内容')
                })
            }
        }

        /**
         *  将选中的文件添加到审批者工具表
         */
        function addFileToUtil(obj) {
            //检查session('histroy_id')是否存在
            var histroyId =  $('#histroy_id').data('content');
            if( histroyId === ''|| histroyId === null){
                alert('请审批者通过审批页面点击“查看细节”进入本页面后，再点击本按钮')
                return
            };

            $(obj).fadeOut()

            setTimeout(function () {
                $(obj).fadeIn()
            }, 100)

            if(ele.length ===0){
                alert("你还没有选择文件");
            }
            else{
                var url = "{{route('manage_util.store')}}";
                var data = {
                    _token:"{{csrf_token()}}",
                    fileId : ele,
                    type:"{{session('credential')}}"
                }
                $.post(url, data, function (res) {
                    alert('提交成功,且已自动过滤重复内容')
                })
            }
        }

        /**
         * 全选/全不选所有files;
         */
        function cancelAllFiles() {
            let flag = $('.fileid').attr('checked')
            $('.fileid').attr('checked', !flag)
            if(flag){ //全不选
                ele = []
                $('.hby').removeClass('uk-icon-plus-square').addClass('uk-icon-square-o');
            }
            else{ //全选
               for(let i =0; i<$('.fileid').length; i++){
                    ele.push($('.fileid:eq('+i+')').val())
               }
               $('.hby').removeClass('uk-icon-square-o').addClass('uk-icon-plus-square');
            }
        }
 </script>
