<!DOCTYPE html>
<html>
    <header>
        <title>权限认证失败</title>
    </header>
<body>
<h2>你没有权限或页面不存在，3秒后自动返回之前页面</h2>
</body>
    <script>
        setTimeout(function () {
            window.history.go(-1)
        }, 2000)
    </script>
</html>