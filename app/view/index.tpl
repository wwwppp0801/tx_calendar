<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>soso calendar</title>
<link href="/css/jtip.css" rel="stylesheet" type="text/css"/>
<link href="/css/room.css" rel="stylesheet" type="text/css"/>
<link href="/js/jscalendar/skins/aqua/theme.css" rel="stylesheet" type="text/css"/>


<style type="text/css">
.style1 {
    font-size: 16px;
    color: #FF0000;
}
.style2 {font-size: 18px}
.style4 {font-size: 14px}
</style>
</head>

<body>
<p>
<{if $msg}>
<div class="errormsg" style="color: #FF0000;"><{$msg}></div>
<{/if}>
<h1 class="style2">soso calendar ☆ <span class="style4">请点击期望时间段进行操作</span></h1>
<{include file='navBar.tpl'}>
<p>
<a href="/?week=<{$weekOffset-1}>"><u>上一周</u></a> | <a href="/?week=<{$weekOffset+1}>"><u>下一周</u></a>
<p>

<table class="weekdays">
<tr>
<th>&nbsp;</th>
<th class="day"><a href='/index/day?rec_date=<{$days[0]}>'>星期一 <br> <{$days[0]}></a></th>
<th class="day"><a href='/index/day?rec_date=<{$days[1]}>'>星期二 <br> <{$days[1]}></a></th>
<th class="day"><a href='/index/day?rec_date=<{$days[2]}>'>星期三 <br> <{$days[2]}></a></th>
<th class="day"><a href='/index/day?rec_date=<{$days[3]}>'>星期四 <br> <{$days[3]}></a></th>
<th class="day"><a href='/index/day?rec_date=<{$days[4]}>'>星期五 <br> <{$days[4]}></a></th>
<th class="day"><a href='/index/day?rec_date=<{$days[5]}>'>星期六 <br> <{$days[5]}></a></th>
<th class="day"><a href='/index/day?rec_date=<{$days[6]}>'>星期日 <br> <{$days[6]}></a></th>
</tr>
<{foreach from=$hours item=i}>
    <tr>
    <td><{$i+8}>:00 - <{$i+9}>:00</td>
    <{foreach from=$days key=j item=day}>
        <{if $record.$j.$i }>
            <td class='used' id='<{$record.$j.$i.id}>'>
				<span class='formInfo'><{$record.$j.$i.description}></span>
			</td>
       <{else}>
            <td onclick='location.href="/index/day?rec_date=<{$day}>&startTime=<{$i+8}>";' class='notUsed'>&nbsp;
			</td>
        <{/if}>
   <{/foreach}>
    </tr>
<{/foreach}>
</table>



<h2 class="style1">※ 如期望时间段已被占用，请点击当日空闲时间段，查看预订人联系方式，与其协商；</h2>
<h2 class="style1">※ 会议室使用率高，如会议取消或更改时间，请及时取消预订，以方便其他人使用；</h2>
<h2 class="style1">※ 学院级紧急会议无条件优先使用。</h2>
<br>
<br>
日历：
<div id="flatCalendar" style="width:200px;"></div>
<p>
<script src="/js/jquery-1.2.6.pack.js"></script>
<script src='/js/base.js'></script>
<script src='/js/behaviour.js'></script>
<script src='/js/my_behaviours.js'></script>
<script src='/js/jtip.js'></script>
<script src='/js/jscalendar/calendar.js'></script>
<script src='/js/jscalendar/lang/cn_utf8.js'></script>




<!-- other languages might be available in the lang directory; please check
your distribution archive. -->

<!-- helper script that uses the calendar -->
<script type="text/javascript">
var MINUTE = 60 * 1000;
var HOUR = 60 * MINUTE;
var DAY = 24 * HOUR;
var WEEK = 7 * DAY;

var lastdate;
function flatSelected(cal, date) {
    if(lastdate==date){
        location.href="/index/day?rec_date="+date;
    }
    else{
        lastdate=date;
    }
}

function showFlatCalendar() {
  var parent = document.getElementById("flatCalendar");
  var cal = new Calendar(0, null, flatSelected);
  cal.setDateFormat("%Y-%m-%d");
  cal.create(parent);
  cal.show();
}

Behaviour.addLoadEvent(
		function() {
            showFlatCalendar();
        }
);
</script>
</body>
</html>

