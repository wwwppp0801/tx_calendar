<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>soso calendar - 登录 - <{$date}></title>
<link href="/css/room.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
</head>
<body>
<h1>登录</h1>
<{if $msg}>
<div style="color: #FF0000;">
<{$msg}>
</div>
<{/if}>

<p>
<form action="/login" method="post">
    <span class="detail_label">用户名：</span>
    <input type="text" name="name"/>
    <br>
    <span class="detail_label">密码：</span>
    <input type="password" name="pass"/>
    <br>
    <p>
    <input type="submit" name="submit" value="登录"/>
</form>
<p>

</body>
</html>
