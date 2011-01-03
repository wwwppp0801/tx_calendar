<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><{$date}></title>
<link href="room.css" rel="stylesheet" type="text/css">
<link href="edit.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/edit.js"></script>
</head>

<body>

<{if $msg}>
<div style="color: #FF0000;">
<{$msg}>
</div>
<{/if}>
<{include file='navBar.tpl'}>
<h1><{$date}></h1>
<h7><a href="/index"><u>返回</u></a></h7><p>
<table>
<tr>
    <th>id</th>
    <th>日期</th>
    <th>事件</th>
    <th>开始时间</th>
    <th>结束时间</th>
    <th>&nbsp;</th>
</tr>
<{foreach from=$rows item=task}>
    <tr>
    <td><{$task.id}></td>
    <td><{$task.rec_date}></td>
    <td><{$task.description}></td>
    <td><{$task.phone}></td>
    <td style='text-align:center'><{$task.startTime}></td>
    <td style='text-align:center'><{$task.endTime}></td>
    <td><a href='/task/delete?id={$row.id}&rec_date={$date}'>取消任务</a></td>
    </tr>
<{/foreach}>
</table>
    <{if !$hasRecord}><h3>今日尚无任何任务</h3><{/if}>
<br>
<h7><a href="/index"><u>返回</u></a></h7>

<br>
<br>
<br>
<br>
<br>
<{include file='newRecord.tpl'}>
</body>

</html>

