function setEvenTrBgColor(table) {
    //alert("setEvenTrBgColor!!");
    for (var i = 2; i < table.rows.length; i += 2)
        table.rows[i].bgColor = "#ececec";
}

function setFocusBehaviour(element) {

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
}


var pg_tr_rule = {
    'table.weekdays' : function(element) {
        setEvenTrBgColor(element);
    },
    'table.weekdays td' : function(element) {
        setFocusBehaviour(element);
    }
};


Behaviour.register(pg_tr_rule);

