// ChoiceScript (c) Dan Fabulich
// smPluginMenuAddon.js - CJW @ www.choiceofgames.com/forum
// Designed by Malebranche.
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this file, to utilize it without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
//  * The 'usage' of this file is kept within compliance of the 'ChoiceScript License'.
//    You can obtain a copy of the license at http://www.choiceofgames.com/LICENSE-1.0.txt
//  
//  * The copyright, attributions and permission notices must be retained 
//    within all copies of the code (modified or otherwise).

//  *Unless required by applicable law or agreed to in writing, the
//    licensor provides the work on an "AS IS" BASIS, WITHOUT WARRANTIES OR
//    CONDITIONS OF ANY KIND, either express or implied, including, without
//    limitation, any warranties or conditions of TITLE, NON-INFRINGEMENT,
//    MERCHANTABILITY, or FITNESS FOR A PARTICULAR PURPOSE. You are solely
//    responsible for determining the appropriateness of using or
//    redistributing the works and assume any risks associated with your
//    exercise of permissions under this license.
//
//  * In no event and under no legal theory, whether in tort (including
//	  negligence), contract, or otherwise, unless required by applicable law
//    (such as deliberate and grossly negligent acts) or agreed to in
//    writing, shall the licensor be liable to you for damages, including
//    any direct, indirect, special, incidental, or consequential damages of
//    any character arising as a result of this license or out of the use or
//    inability to use the works (including but not limited to damages for
//    loss of goodwill, work stoppage, computer failure or malfunction, or
//    any and all other commercial damages or losses), even if the licensor
//    has been advised of the possibility of such damages.

if (typeof saveMod == 'undefined')
	throw new Error("smPluginMenuAddon.js: smPlugin.js is required.");

var smPluginMenuAddon = {
	"slotCount": saveMod.slotCount,
	"menuTitle": "Quick Save Menu",
	"save": function() {
		if ((typeof saveMod.c_password == 'undefined' || stats.sceneName == "choicescript_stats") || !smPluginMenuAddon.active) {
			alert("Error: Unable to save at this point.");
			return;
		}
		stats.scene.sm_save(smPluginMenuAddon.currentSlot + ' | true');
		smPluginMenuAddon.updateSlotText();
	},
	"load": function() {
		stats.scene.sm_load(smPluginMenuAddon.currentSlot + ' | true');
	},
	"del": function() {
		stats.scene.sm_delete(smPluginMenuAddon.currentSlot);
		smPluginMenuAddon.updateSlotText();
	},
	"updateSlotText": function() {
		var optionEle = document.getElementById("quickSaveMenu").childNodes[smPluginMenuAddon.currentSlot];
		optionEle.innerHTML = "Slot " + smPluginMenuAddon.currentSlot + ": " + stats["savemod_slot_" + smPluginMenuAddon.currentSlot];		
	},
	"active": true,
	"currentSlot": "0",
	"CSS":
		"#quickSaveMenu {\
			margin: 5px;\
			width: 100px;\
		}"
}

Scene.validCommands.sm_menuaddon = 1;
Scene.prototype.sm_menuaddon = function(data) {
	data = data || "";
	data = data.toLowerCase();
	if (data === "false")
		smPluginMenuAddon.active = false;
	else if (data === "true")
		smPluginMenuAddon.active = true;
	else
		throw new Error("*sm_menuaddon: expected true or false as an argument!");
}

//initalize after a small delay
setTimeout(function() {
	//CSS
	var head = document.getElementsByTagName("head")[0];
	var style = document.createElement("style");
	style.innerHTML = smPluginMenuAddon.CSS;
	head.appendChild(style);
	//HTML
	var select = document.createElement("select");
	select.setAttribute("id", "quickSaveMenu");
	select.setAttribute("onchange", "smPluginMenuAddon.currentSlot = this.value");
	for (var slot = 0; slot < smPluginMenuAddon.slotCount; slot++) {
		var option = document.createElement("option");
		option.setAttribute("value", slot);
		if (typeof stats["savemod_slot_" + slot] != 'undefined') {
			option.innerHTML = "Slot " + slot + ": " + stats["savemod_slot_" + slot];
		}
		else {
			option.innerHTML = "Error: Bad Slot - Has smPlugin been included?";
		}
		select.appendChild(option);
	}
	var p = document.getElementById("restartButton").parentElement;
	p.appendChild(select);
	var buttonArr = [
		{ "innerHTML": "Save", "clickFunc": "smPluginMenuAddon.save();" },
		{ "innerHTML": "Load", "clickFunc": "smPluginMenuAddon.load();" },
		{ "innerHTML": "Delete", "clickFunc": "smPluginMenuAddon.del();" }
	];
	for (var i = 0; i < buttonArr.length; i++) {
		var btn = document.createElement("button");
		btn.innerHTML = buttonArr[i].innerHTML;
		btn.setAttribute("class", "spacedLink");
		btn.setAttribute("onclick", buttonArr[i].clickFunc);
		p.appendChild(btn);
	}
}, 3000);
