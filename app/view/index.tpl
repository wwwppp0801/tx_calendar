<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>soso calendar</title>
<link href="/css/jtip.css" rel="stylesheet" type="text/css"/>
<link href="/css/room.css" rel="stylesheet" type="text/css"/>
<link href="/js/jscalendar/skins/aqua/theme.css" rel="stylesheet" type="text/css"/>


<style type="text/css">
#main_part{width:98%;min-width:980px;margin:0 auto;}
#left_side{width:220px;float:left;margin:0 5px 0 0;}
#right_side{float:left;min-width:675px;}
table.weekdays td{width:12%;max-width:55px;overflow:hidden;height:40px;}
h1 {font-size: 18px}
h1 span {font-size: 14px}
</style>
</head>

<body>
<div id="header">
	<p>
	<{if $msg}>
	<div class="errormsg" style="color: #FF0000;"><{$msg}></div>
	<{/if}>
	<h1>soso calendar ☆ <span>请点击期望时间段进行操作</span></h1>
	<{include file='navBar.tpl'}>
	<p>
	<a href="/?week=<{$weekOffset-1}>"><u>上一周</u></a> | <a href="/?week=<{$weekOffset+1}>"><u>下一周</u></a>
	<p>
</div>
<div id="main_part">
	<div id="left_side">
		<{* container for calendar *}>
		<div id="flatCalendar"></div>
		<{if $calendars}>
		<form action="/" method="get">
			<{foreach from=$calendars item=cal}>
				<label><input type="checkbox" name="cal" value="<{$cal.id}>" /><{$cal.name}></label>
			<{/foreach}>
			<input name="week" type="hidden" value="<{$weekOffset}>">
		</form>
		<{/if}>
	</div>
	<div id="right_side">
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
<{php}>
	for ($i=0;$i<14;$i++){
		$hours[]=$i;
	}
  $this->assign('hours',$hours);
<{/php}>
		<{foreach from=$hours item=i}>
			<tr>
			<td><{$i+8}>:00 - <{$i+9}>:00</td>
			<{foreach from=$days key=j item=day}>
				<{if $records.$j.$i }>
					<td class='used' id='<{$records.$j.$i.id}>'>
						<span class='formInfo'><{$records.$j.$i.description}></span>
					</td>
			   <{else}>
					<td onclick='location.href="/index/day?rec_date=<{$day}>&startTime=<{$i+8}>";' class='notUsed'>&nbsp;
					</td>
				<{/if}>
		   <{/foreach}>
			</tr>
		<{/foreach}>
		</table>
	</div>
</div>

<script src="/js/jquery-1.5.min.js"></script>
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


$(
		function() {
		  var parent = document.getElementById("flatCalendar");
		  var cal = new Calendar(0, null, flatSelected);
		  cal.setDateFormat("%Y-%m-%d");
		  cal.create(parent);
		  cal.show();
        }
);
$("table.weekdays tr").each(function(i,row){
	if(i%2==0){
		row.bgColor='#ececec';
	}
});
$("table.weekdays td").each(function (i,element) {
    element.onmouseover = function() {
        //alert("on!!");
        //$GetParentByTagName(this,parent_tag).className = 'onMouse';
        if (element.className!='used')
            element.className='onMouse';
        //element.bgColor = "#000000";
    };
    element.onmouseout = function() {
        //$GetParentByTagName(this,parent_tag).className = 'notUsed';
        if(element.className=='onMouse')
            element.className='';
        //element.bgColor = "#ffffff";
    };
});
</script>
</body>
</html>

