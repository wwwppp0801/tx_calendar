<span style="font-size:18px;color:#0000ff; font-weight:bold;">★ 预订会议室（以下项目必须填写完全）：</span>
<form action="insert.php" method="get">
	<input type="hidden" name="rec_date" value="{$date}"/>
	<span class="detail_label">会议主题及负责老师：</span><textarea name="description">{$description}</textarea>&nbsp;&nbsp;&nbsp;&nbsp;填写示范：班主任例会 王生卫，研会主席团会 赵雪梅，S064支部会 耿琦……<br>
	<span class="detail_label">会议联系人及其电话：</span><input type="text" name="phone" value="{$phone}">&nbsp;填写示范：徐文 134****9052<span style="font-size:12px;color:#FF0000;">（请填写直接联系人及其手机，紧急征用时，如联系不上后果自负！）</span><br>
	<span class="detail_label">请选择会议开始时间：</span><select name="startTime">
	{foreach from=$hours item=i}
		{if $i+8==$startTime}
			<option selected value='{$i+8}'>{$i+8}</option>
		{else}
			<option value='{$i+8}'>{$i+8}</option>
		{/if}
	{/foreach}
	</select>
	
	<br>
	<span class="detail_label">请选择会议结束时间：</span><select name="endTime">
	{foreach from=$hours item=i}
		{if $i+9==$endTime}
			<option selected value='{$i+9}'>{$i+9}</option>
		{else}
			<option value='{$i+9}'>{$i+9}</option>
		{/if}
	{/foreach}
	</select>
	
	<br>
	<p>
	<input type="submit" name="submit" value="提交"/>
</form>
