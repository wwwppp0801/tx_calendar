<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>预订会议室 - 个人信息</title>
<link href="room.css" rel="stylesheet" type="text/css">
<style type="text/css">
{literal}
<!--
.style1 {
    font-size: 14px;
    font-weight: bold;
}
-->
{/literal}
</style>
</head>
<body>
{include file='navBar.tpl'}
{if $msg}
<div style="color: #FF0000;">{$msg}</div>
{/if}

<p>
当前用户：<span class="style1">{$username}</span>
<form action="changeUserInfo.php" method="get">
    <p><br>
      <span class="detail_label">请输入原密码:</span>
      <input type="password" name="passBefore"/>
      <br>
      <span class="detail_label">请输入新密码:</span>
      <input type="password" name="passAfter1"/>
      (如不修改密码请不要填写)
      <br>
      <span class="detail_label">再输入新密码:</span>
      <input type="password" name="passAfter2"/>
      (如不修改密码请不要填写)
      <br>
      <span class="detail_label">您的联系方式:</span>
      <input type="text" name="phone" value="{$phone}"/>
      <br>
      <span class="detail_label">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注:</span>
      <input type="text" name="description" value="{$description}"/>
    </p>
    <p><br>
      <input type="submit" name="submit" value="提交"/>
        </p>
</form>

</body>
</html>

