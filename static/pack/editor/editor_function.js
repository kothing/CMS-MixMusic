function uploadEdit(obj) {
	forms = document.getElementById(obj).getElementsByTagName("FORM");
	edit_save()
}
function edit_save() {
	var p = window.frames['uchome-ifrHtmlEditor'];
	var obj = p.window.frames['HtmlEditor'];
	var status = p.document.getElementById('uchome-editstatus').value;
	if (status == 'code') {
		document.getElementById('uchome-ttHtmlEditor').value = p.document.getElementById('sourceEditor').value
	} else if (status == 'text') {
		document.getElementById('uchome-ttHtmlEditor').value = p.document.getElementById('dvtext').value.replace(/\r\n|\n/g, "<br>")
	} else {
		document.getElementById('uchome-ttHtmlEditor').value = obj.document.body.innerHTML
	}
	backupContent(document.getElementById('uchome-ttHtmlEditor').value)
}
function backupContent(sHTML) {
	if (sHTML.length > 11) {
		var oArea = document.getElementById('uchome-ttHtmlEditor');
		try {
			var xmlDoc = oArea.XMLDocument;
			var msgNode = xmlDoc.createNode(1, 'message', '');
			var msgValueNode = xmlDoc.createNode(4, "message", "");
			delmsg = xmlDoc.selectNodes("//message");
			delmsg.removeAll();
			msgValueNode.nodeValue = sHTML;
			msgNode.appendChild(msgValueNode);
			root = xmlDoc.documentElement;
			root.appendChild(msgNode);
			oArea.save('UCHome')
		} catch (e) {
			if (window.sessionStorage) {
				try {
					sessionStorage.setItem('message', sHTML)
				} catch (e) {}
			}
		}
	}
}
function edit_insert(html) {
	var p = window.frames['uchome-ifrHtmlEditor'];
	var obj = p.window.frames['HtmlEditor'];
	var status = p.document.getElementById('uchome-editstatus').value;
	if (status != 'html') {
		alert('本操作只在多媒体编辑模式下才有效');
		return
	}
	obj.focus();
	if (window.Event) {
		obj.document.execCommand('insertHTML', false, html)
	} else {
		obj.focus();
		var f = obj.document.selection.createRange();
		f.pasteHTML(html);
		f.collapse(false);
		f.select()
	}
	parent.layer.closeAll()
}
function setDoodle(fid, oid, url, tid, from) {
	edit_insert('<p><img src="' + url + '"></p>')
}