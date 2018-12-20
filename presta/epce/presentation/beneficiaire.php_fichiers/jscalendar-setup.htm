//<pre>
Calendar.setup = function (params) {
	function param_default(pname, def) { if (typeof params[pname] == "undefined") { params[pname] = def; } };

	param_default("inputField",     null);
	param_default("displayArea",    null);
	param_default("button",         null);
	param_default("eventName",      "click");
	param_default("ifFormat",      "%Y/%m/%d");
	param_default("daFormat",      "%Y/%m/%d");
	param_default("titleFormat",    "%B %Y");
	param_default("singleClick",    true);
	param_default("disableFunc",    null);
	param_default("dateStatusFunc", params["disableFunc"]);	// takes precedence if both are defined
	param_default("disableFirstDowChange", true);
	param_default("firstDay",       1); // Monday
	param_default("align",          "Bl");
	param_default("range",          [1900, 2999]);
	param_default("weekNumbers",    true);
	param_default("flat",           null);
	param_default("flatCallback",   null);
	param_default("flatWeekCallback",null);
	param_default("flatWeekTTip",   null);
	param_default("flatmonthCallback",null);
	param_default("flatmonthTTip",  null);
	param_default("onSelect",       null);
	param_default("onClose",        null);
	param_default("onUpdate",       null);
	param_default("date",           null);
	param_default("showsTime",      false);
	param_default("timeFormat",     "24");
	param_default("electric",       true);
	param_default("step",           2);
	param_default("position",       null);
	param_default("cache",          true);
	param_default("showOthers",     true); 
	var tmp = ["inputField", "displayArea", "button"];
	for (var i in tmp) {
		if (typeof params[tmp[i]] == "string") {
			params[tmp[i]] = document.getElementById(params[tmp[i]]);
		}
	}
	if (!(params.flat || params.inputField || params.displayArea || params.button)) {
		alert("Calendar.setup:\n  Nothing to setup (no fields found).  Please check your code");
		return false;
	}

	function onSelect(cal) {
		var p = cal.params;
		var update = (cal.dateClicked || p.electric);
		if (update && p.flat) {
			if (typeof p.flatCallback == "function")
				p.flatCallback(cal);
			else
				alert("No flatCallback given -- doing nothing.");
			return false;
		}
		if (update && p.inputField) {
			p.inputField.value = cal.date.print(p.ifFormat);
			if (typeof p.inputField.onchange == "function")
				p.inputField.onchange();
		}
		if (update && p.displayArea)
			p.displayArea.innerHTML = cal.date.print(p.daFormat);
		if (update && p.singleClick && cal.dateClicked)
			cal.callCloseHandler();
		if (update && typeof p.onUpdate == "function")
			p.onUpdate(cal);
	};

	if (params.flat != null) {
		if (typeof params.flat == "string")
			params.flat = document.getElementById(params.flat);
		if (!params.flat) {
			alert("Calendar.setup:\n  Flat specified but can't find parent.");
			return false;
		}
		var cal = new Calendar(params.firstDay, params.date, params.onSelect || onSelect);
		cal.showsTime = params.showsTime;
		cal.time24 = (params.timeFormat == "24");
		cal.params = params;
		cal.weekNumbers = params.weekNumbers;
		cal.setRange(params.range[0], params.range[1]);
		cal.setDateStatusHandler(params.dateStatusFunc);
		cal.showsOtherMonths = params.showOthers;
		cal.create(params.flat);
		cal.show();
		return false;
	}

	var triggerEl = params.button || params.displayArea || params.inputField;
	triggerEl["on" + params.eventName] = function() {
		var dateEl = params.inputField || params.displayArea;
		var dateFmt = params.inputField ? params.ifFormat : params.daFormat;
		var mustCreate = false;
		var cal = window.calendar;
		if (!(cal && params.cache)) {
			window.calendar = cal = new Calendar(params.firstDay,
							     params.date,
							     params.onSelect || onSelect,
							     params.onClose || function(cal) { cal.hide(); });
			cal.showsTime = params.showsTime;
			cal.time24 = (params.timeFormat == "24");
			cal.weekNumbers = params.weekNumbers;
			mustCreate = true;
		} else {
			if (params.date)
				cal.setDate(params.date);
			cal.hide();
		}
		cal.showsOtherMonths = params.showOthers;
		cal.yearStep = params.step;
		cal.setRange(params.range[0], params.range[1]);
		cal.params = params;
		cal.setDateStatusHandler(params.dateStatusFunc);
		cal.setDateFormat(dateFmt);
		if (mustCreate)
			cal.create();
		cal.parseDate(dateEl.value || dateEl.innerHTML);
		cal.refresh();
		if (!params.position)
			cal.showAtElement(params.button || params.displayArea || params.inputField, params.align);
		else
			cal.showAt(params.position[0], params.position[1]);
		return false;
	};
};

// eGroupWare translations, are read from the database

// ** I18N

// Calendar EN language
// Author: Mihai Bazon, <mishoo@infoiasi.ro>
// Encoding: any
// Distributed under the same terms as the calendar itself.

Calendar._DN = new Array
(
 "Dimanche",
 "Lundi",
 "Mardi",
 "Mercredi",
 "Jeudi",
 "Vendredi",
 "Samedi");

Calendar._SDN = new Array
(
 "Dim",
 "Lun",
 "Mar",
 "Mer",
 "Jeu",
 "Ven",
 "Sam");
Calendar._SDN_len = 3;

Calendar._MN = new Array
(
 "Janvier",
 "Février",
 "Mars",
 "Avril",
 "Mai",
 "Juin",
 "Juillet",
 "Août",
 "Septembre",
 "Octobre",
 "Novembre",
 "Décembre");

Calendar._SMN = new Array
(
 "Jan",
 "Fé",
 "Mar",
 "Avr",
 "Mai",
 "Jun",
 "Jui",
 "Ao�",
 "Sep",
 "Oct",
 "Nov",
 "Dé");
Calendar._SMN_len = 3;

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "A propos du Calendrier";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2003\n" + // don't translate this this ;-)
"For latest version visit: http://dynarch.com/mishoo/calendar.epl\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Sélection de la date :\n" +
"- Utiliser les boutons \xab, \xbb pour sélectionner l'année\n" +
"- Utiliser les boutons " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " pour sélectionner le mois\n" +
"- Maintenir le bouton de la souris sur n'importe lequel des boutons ci-dessus pour une sélection plus rapide.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Sélection du temps:\n" +
"- Cliquer sur les chiffres horaires pour les augmenter\n" +
"- ou Maj-clic pour la décrémenter\n" +
"- ou cliquer et glisser pour une sélection plus rapide";

Calendar._TT["TOGGLE"] = "Voir le premier jour de la semaine";
Calendar._TT["PREV_YEAR"] = "Année précédente (maintenir pour le menu)";
Calendar._TT["PREV_MONTH"] = "Mois précédent (maintenir pour le menu)";
Calendar._TT["GO_TODAY"] = "Aller à aujourd'hui";
Calendar._TT["NEXT_MONTH"] = "Mois suivant (maintenir pour menu)";
Calendar._TT["NEXT_YEAR"] = "Année suivante (maintenir pour menu)";
Calendar._TT["SEL_DATE"] = "Sélectionner la date";
Calendar._TT["DRAG_TO_MOVE"] = "Prendre pour le bouger";
Calendar._TT["PART_TODAY"] = " (Aujourd'hui)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "Affiche %s en premier";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Fermer";
Calendar._TT["TODAY"] = "Aujourd'hui";
Calendar._TT["TIME_PART"] = "(Maj-)Clic ou Glisser pour changer la valeur";

// date formats
//Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["DEF_DATE_FORMAT"] = "%Y/%m/%d";
//Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "wk";
Calendar._TT["TIME"] = "Heure:";
