$(document).ready(function(){
setClickable();
});

function setClickable() {
$('td.editable').click(function() {
var textarea = '<div><textarea>'+$(this).html()+'</textarea>';
var button	 = '<div><input type="button" value="保存" class="saveButton" />  <input type="button" value="取消" class="cancelButton" /></div></div>';
var revert = $(this).html();
$(this).after('<td>'+textarea+button+'</td>').remove();
$('.saveButton').click(function(){saveChanges(this, false);});
$('.cancelButton').click(function(){saveChanges(this, revert);});
})
.mouseover(function() {
$(this).addClass("mouseover");
})
.mouseout(function() {
$(this).removeClass("mouseover");
});
};

function saveChanges(obj, cancel) {
if(!cancel) {
var t = $(obj).parent().siblings(0).val();
var id = $(obj).parent().parent().parent().siblings("td").html();
//alert($(obj).parent().parent().parent());
//alert($(obj).parent().parent().parent().parent().children().eq(3));
if($(obj).parent().parent().parent().get(0)==$(obj).parent().parent().parent().parent().children().eq(3).get(0))
    var col='description';
if($(obj).parent().parent().parent().get(0)==$(obj).parent().parent().parent().parent().children().eq(4).get(0))
    var col='phone';
$.post("update.php",{
    id:id,
    col:col,
    value: t
},function(txt){
//alert( txt);
});
}
else {
var t = cancel;
}
if(t=='') t='(click to add text)';
$(obj).parent().parent().parent().after('<td class="editable">'+t+'</td>').remove();
setClickable();
}

