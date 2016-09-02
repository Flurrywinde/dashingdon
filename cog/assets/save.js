saveMod = {
	mygame_save: "bare_burden" //Change null to the name of your game inside quotation marks, for e.g. : ,mygame_save: "terminal"
                                     //This ensures your game saves are unique to your game and won't be overwrote by anyone else using this system.
    ,isLocalIE: false    			 //Don't change this           
    ,autoSave: false     			 //true = Autosaves by default - Otherwise player must activate autosave.
};				

window.onload=function(){

//Checks to see if IE is local (no localStorage support)
switch(window.location.protocol) {
   case 'file:':
 
	if (!isIE) {
				Scene.prototype.resetPage = function resetPage() {
			if (typeof(Storage)!=="undefined") { updateSave(); } //Saves if LS is supported.
			var self = this;
			this.save(function() {
			  self.prevLineEmpty = true;
			  self.screenEmpty = true;
			  clearScreen(function() {self.execute();});
			}, "");
		}		
		
	
	
	if (!saveMod.mygame_save) { alert("Developer Warning: Game Name for mygame_save in save.js is not defined!");}
if (typeof(Storage)!=="undefined") {
 	var button = document.createElement("button");
	button.innerHTML = "Clear Save";
	button.setAttribute('onclick', 'clearSave()');
	var p = moveButtonsInline();
	p.appendChild(button); 
	
    button = document.createElement("button");
	button.innerHTML = "Load";
	button.setAttribute('onclick', 'load()');
	p.appendChild(button);

    button = document.createElement("button");
	if (saveMod.autoSave == false) { button.innerHTML = "Enable Autosave"; }
        else { button.innerHTML = "Disable Autosave"; }
	button.setAttribute('onclick', 'toggleAutosave(this)');
	p.appendChild(button);
	}
	
	}
			else {alert("localStorage Mod Disabled:\n IE doesn't support localStorage for local files");}
	break;
	   
   default:
		//Overwrites a native cs interpreter function
		// reset the page and invoke code after clearing the screen
		Scene.prototype.resetPage = function resetPage() {
			if (typeof(Storage)!=="undefined" && saveMod.autoSave) { updateSave(); } //Saves if LS is supported.
			var self = this;
			this.save(function() {
			  self.prevLineEmpty = true;
			  self.screenEmpty = true;
			  clearScreen(function() {self.execute();});
			}, "");
		}

if (!saveMod.mygame_save) { alert("Developer Warning: Game Name for mygame_save in save.js is not defined!");}
if (typeof(Storage)!=="undefined") {
 	var button = document.createElement("button");
	button.innerHTML = "Clear Save";
	button.setAttribute('onclick', 'clearSave()');
	var p = moveButtonsInline();
	p.appendChild(button); 
	
    button = document.createElement("button");
	button.innerHTML = "Load";
	button.setAttribute('onclick', 'load()');
	p.appendChild(button);
    
    button = document.createElement("button");
	button.innerHTML = "Enable Autosave";
	button.setAttribute('onclick', 'toggleAutosave(this)');
	p.appendChild(button);
	}
	 break;
	
	}
}

function moveButtonsInline() {
	var header = document.getElementById("header")
	var tags = header.getElementsByTagName("p");
	return tags[1];
}

function toggleAutosave(button) {
    if (saveMod.autoSave == false) {
        button.innerHTML = "Disable Autosave";
        saveMod.autoSave = true;
        alert("Autosave Enabled!");
        return;
    }
    else {
        button.innerHTML = "Enable Autosave";
        saveMod.autoSave = false;
        alert("Autosave Disabled!");
        return;
    }
alert("toggleAutosave Error - Please inform the game developer!");
}

function clearSave() {
	if (localStorage[saveMod.mygame_save]) { 
	var x = confirm("Are you sure you wish to clear all saved data?");
		if (x) { localStorage.removeItem(saveMod.mygame_save); }
	}
		else {alert("There is no saved data to clear!");}
}

function updateSave() {
	if (window.stats.sceneName != "choicescript_stats") { //Prevent saving on the new stats screens
		var scene = window.stats.scene;
		var temp_line_num = scene.lineNum;
		var password = computeCookie(scene.stats, scene.temps, scene.lineNum, scene.indent);
		password = scene.obfuscate(password);
		var password = "----- BEGIN PASSWORD -----\n" + password + "\n----- END PASSWORD -----";
		localStorage[saveMod.mygame_save] = password;
	}
}

function load() {
	if (localStorage[saveMod.mygame_save]) {
		var x = confirm("Are you sure you wish to load a game? \nYour current progress will be lost.");
			if (x) { 
        clearScreen(function() {
		  var scene = window.stats.scene;
          scene.restore_localStorage();
        });
			}
	}
	else {alert("There is no saved data!");}
}

Scene.prototype.restore_localStorage = function restore_localStorage() {
var alreadyFinished = this.finished;
var self = this;
var unrestorableScenes = this.parseRestoreGame(alreadyFinished);

if (localStorage[saveMod.mygame_save]) {
var password = localStorage[saveMod.mygame_save];
    password = password.replace(/\s/g, "");
    password = password.replace(/^.*BEGINPASSWORD-----/, "");
	var token = this.deobfuscatePassword(password);
    token = token.replace(/^[^\{]*/, "");
    token = token.replace(/[^\}]*$/, "");
    try {
      var state = jsonParse(token);
    } catch (e) {
      var supportEmail = "support-unknown@choiceofgames.com";
      try {
        supportEmail=document.getElementById("supportEmail").getAttribute("href");
        supportEmail=supportEmail.replace(/\+/g,"%2B");
        supportEmail=supportEmail.replace(/mailto:/, "");
      } catch (e) {
        supportEmail = "support-unknown@choiceofgames.com";
      }
      alert("Sorry, that password was invalid. Please contact " + supportEmail + " for assistance. Be sure to include your password in the email.");
      return;
    }
    
    var sceneName = null;
    if (state.stats && state.stats.sceneName) sceneName = (""+state.stats.sceneName).toLowerCase();
    
    var unrestorable = unrestorableScenes[sceneName];
    if (unrestorable) {
      alert(unrestorable);
      self.finished = false;
      self.resetPage();
      return;
    }
    saveCookie(function() {
      clearScreen(function() {
        // we're going to pretend not to be user restored, so we get reprompted to save
        restoreGame(state, null, /*userRestored*/false);
      })
    }, "", state.stats, state.temps, state.lineNum, state.indent, this.debugMode, this.nav);
  }
 else {alert("There is no saved data!");}
}