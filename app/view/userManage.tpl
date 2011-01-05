<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>预订会议室 - 用户管理</title>
<link href="/css/room.css" rel="stylesheet" type="text/css">
</head>
<body>
<{include file='navBar.tpl'}>
<h1>用户管理</h1>
<table>
	<tr>
		<td><div align="center">用户名</div></td>
		<td><div align="center">备注</div></td>
		<td><div align="center"></div></td>
	</tr>
	<{foreach from=$users item=user }>
			<tr>
			<td><{$user.name}></td>
			<td><{$user.description}></td>
			<td><{if !$user.isAdmin}><a href='/manage/user/del?<{$user.name}>'>删除</a><{else}>&nbsp;<{/if}></td>
			</tr>
	<{foreachelse}>
			<tr><td colspan="3">还没有用户</td></tr>
	<{/foreach}>
</table>
<p>
添加新用户：
<p>
<form action="/manage/user/add" method="post">
	<span class="detail_label">用户名:</span>
	<input name="name" type="text"><br>
	<input type="submit" name="submit" value="添加"><br>
</form>
<p>
注：新增用户的初始密码与用户名相同，请尽快修改。
</body>
</html>
