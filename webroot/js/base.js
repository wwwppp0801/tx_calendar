function $GetFromID(e) {
    if (typeof(e) != 'string') return e;
    if (document.getElementById)
        return document.getElementById(e);
    else if (document.all)
        return document.all[e];
    return null;
}

function $IsDef(e) {
    return typeof(e) != 'undefined';
}

function $GetParentByTagName(e, tagName) {
    var par = e;
    tagName = tagName.toLowerCase();
    while (par) {
        if (par.tagName && par.tagName.toLowerCase() == tagName)
            return par;
        par = par.parentNode;
    }
    return null;
}

function $GetFromName(form , name){
	var children = form.elements;
	var i;
	for(i = 0;i < children.length;i++){
		if(children[i].name == name)
			return children[i];
	}
	return null;
}

