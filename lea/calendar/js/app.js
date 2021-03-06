/**
 * EGroupware - Calendar - Javascript UI
 *
 * @link http://www.egroupware.org
 * @package calendar
 * @author Hadi Nategh	<hn-AT-stylite.de>
 * @copyright (c) 2008-13 by Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: app.js 54044 2015-10-26 15:08:44Z ralfbecker $
 */

/*egw:uses
	/etemplate/js/etemplate2.js
*/

/**
 * UI for calendar
 *
 * @augments AppJS
 */
app.classes.calendar = AppJS.extend(
{
	/**
	 * application name
	 */
	appname: 'calendar',

	/**
	 * Constructor
	 *
	 * @memberOf app.calendar
	 */
	init: function()
	{
		// make calendar object available, even if not running in top window, as sidebox does
		if (window.top !== window && !egw(window).is_popup())
		{
			// we have to explicitly delete old object or IE11 complains about accessing an already freed script
			delete window.top.app.calendar;
			window.top.app.calendar = this;
		}

		// call parent
		this._super.apply(this, arguments);

		//Drag_n_Drop (need to wait for DOM ready to init dnd)
		jQuery(jQuery.proxy(this.drag_n_drop,this));
	},

	/**
	 * Destructor
	 */
	destroy: function()
	{
		// call parent
		this._super.apply(this, arguments);

		// remove top window reference
		if (window.top !== window && window.top.app.calendar === this)
		{
			delete window.top.app.calendar;
		}
	},

	/**
	 * This function is called when the etemplate2 object is loaded
	 * and ready.  If you must store a reference to the et2 object,
	 * make sure to clean it up in destroy().
	 *
	 * @param {etemplate2} _et2 newly ready et2 object
	 * @param {string} _name name of template
	 */
	et2_ready: function(_et2, _name)
	{
		// call parent
		this._super.apply(this, arguments);

		// Re-init sidebox, since it was probably initialized too soon
		var sidebox = jQuery('#favorite_sidebox_'+this.appname);
		if(sidebox.length == 0 && egw_getFramework() != null)
		{
			var egw_fw = egw_getFramework();
			sidebox= $j('#favorite_sidebox_'+this.appname,egw_fw.sidemenuDiv);
		}
		this._init_sidebox(sidebox);

		var content = this.et2.getArrayMgr('content');

		switch (_name)
		{
			case 'calendar.list':
				this.filter_change();
				break;

			case 'calendar.edit':
				if (typeof content.data['conflicts'] == 'undefined')
				{
					//Check if it's fallback from conflict window or it's from edit window
					if (content.data['button_was'] != 'freetime')
					{
						this.set_enddate_visibility();
						this.check_recur_type();
						this.et2.getWidgetById('recur_exception').set_disabled(!content.data.recur_exception ||
							typeof content.data.recur_exception[0] == 'undefined');
					}
					else
					{
						this.freetime_search();
					}
					//send Syncronus ajax request to the server to unlock the on close entry
					//set onbeforeunload with json request to send request when the window gets close by X button
					if (content.data.lock_token)
					{
						window.onbeforeunload = function () {
							this.egw.json('calendar.calendar_uiforms.ajax_unlock',
							[content.data.id, content.data.lock_token],null,true,null,null).sendRequest(true);
						};
					}
				}
				this.alarm_custom_date();
				break;

			case 'calendar.freetimesearch':
				this.set_enddate_visibility();
				break;
		}
	},

	/**
	 * Observer method receives update notifications from all applications
	 *
	 * App is responsible for only reacting to "messages" it is interested in!
	 *
	 * @param {string} _msg message (already translated) to show, eg. 'Entry deleted'
	 * @param {string} _app application name
	 * @param {(string|number)} _id id of entry to refresh or null
	 * @param {string} _type either 'update', 'edit', 'delete', 'add' or null
	 * - update: request just modified data from given rows.  Sorting is not considered,
	 *		so if the sort field is changed, the row will not be moved.
	 * - edit: rows changed, but sorting may be affected.  Requires full reload.
	 * - delete: just delete the given rows clientside (no server interaction neccessary)
	 * - add: requires full reload for proper sorting
	 * @param {string} _msg_type 'error', 'warning' or 'success' (default)
	 * @param {object|null} _links app => array of ids of linked entries
	 * or null, if not triggered on server-side, which adds that info
	 * @return {false|*} false to stop regular refresh, thought all observers are run
	 */
	observer: function(_msg, _app, _id, _type, _msg_type, _links)
	{
		var do_refresh = false;
		switch(_app)
		{
			case 'infolog':
			{
				jQuery('.calendar_calDayTodos')
					.find('a')
					.each(function(i,a){
						var match = a.href.split(/&info_id=/);
						if (match && typeof match[1] !="undefined")
						{
							if (match[1]== _id)	do_refresh = true;
						}
					});
				if (jQuery('div [id^="infolog'+_id+'"],div [id^="drag_infolog'+_id+'"]').length > 0) do_refresh = true;
				switch (_type)
				{
					case 'add':
						do_refresh = true;
						break;
				}
				if (do_refresh)
				{
					if (typeof this.et2 != 'undefined' && this.et2 !=null)
					{
						this.egw.refresh(_msg, 'calendar');
					}
					else
					{
						var iframe = parent.jQuery(parent.document).find('.egw_fw_content_browser_iframe');
						var calTab = iframe.parentsUntil(jQuery('.egw_fw_ui_tab_content'),'.egw_fw_ui_tab_content');

						if (!calTab.is(':visible'))
						{
							// F.F can not handle to style correctly an iframe which is hidden (display:none), therefore we need to
							// bind a handler to refresh the calendar views after it shows up
							iframe.one('show',function(){egw_refresh('','calendar');});
						}
						else
						{
							//window.location.reload();
							window.egw_refresh('refreshing calendar','calendar');
						}
					}
				}
			}
			break;
		}
	},

	/**
	 * Link hander for jDots template to just reload our iframe, instead of reloading whole admin app
	 *
	 * @param {String} _url
	 * @return {boolean|string} true, if linkHandler took care of link, false for default processing or url to navigate to
	 */
	linkHandler: function(_url)
	{
		if (_url.match('menuaction=calendar.calendar_uiviews.index'))
		{
			var state = this.getState();
			if (state.view == 'listview')
			{
				return _url.replace(/menuaction=[^&]+/, 'menuaction=calendar.calendar_uilist.listview&ajax=true');
			}
		}
		else if (_url.indexOf('merge=') > 0)
		{
			// Just open the merge
			window.open(_url.replace('&ajax=true',''),'_blank');

			// Tell framework app took care of it
			return true;
		}
		// can not load our own index page, has to be done by framework
		return false;
	},

	/**
	 * Drag and Drop
	 *
	 *
	 */
	drag_n_drop: function()
	{
		var that = this;

		//Draggable & Resizable selector
		var $drag = jQuery("div[id^='drag_']")
					//draggable event handler
					.draggable
					({
						stack: jQuery("div[id^='drag_']"),
						revert: "invalid",
						delay: 50,

						cursorAt:{top:0,left:0},
						containment: ".egw_fw_content_browser_iframe",
						scroll: true,
						opacity: .6,
						cursor: "move",

						/**
						 * Triggered when the dragging of calEvent stoped.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						stop: function(event, ui)
							{
							ui.helper.width(oldWidth);
							ui.helper[0].innerHTML = oldInnerHTML;
						},

						/**
						 * Triggered while dragging a calEvent.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 *
						 */
						drag:function(event, ui)
						{
							//that.dragEvent();
						},

						/**
						 * Triggered when the dragging of calEvent started.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 *
						 */
						start: function(event, ui)
						{
							//Safari 9 needs a delay to get the jquery helper width
							setTimeout(function(){
								oldInnerHTML = ui.helper[0].innerHTML;
								oldWidth = ui.helper.width();
								ui.helper.width(jQuery("#calColumn").width());
							},1);
						}
					})

					//Resizable event handler
					.resizable
					({
						distance: 10,


						/**
						 *  Triggered when the resizable is created.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						create:function(event, ui)
						{
							var resizeHelper = event.target.getAttribute('data-resize').split("|")[3];
							if (resizeHelper == 'WD' || resizeHelper == 'WDS')
							{
								jQuery(this).resizable('destroy');
							}
						},

						/**
						 * Triggered at start of resizing a calEvent
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						start:function(event, ui)
						{
							var resizeHelper = event.target.getAttribute('data-resize');
							var dataResize = resizeHelper.split("|");
							var time = dataResize[1].split(":");

							this.dropStart = that.resizeHelper(ui.element[0].getBoundingClientRect().left,ui.element[0].getBoundingClientRect().top);
							this.dropDate = dataResize[0]+"T"+time[0]+time[1];
							//$j(this).resizable("option","containment",".calendar_calDayCol");
						},

						/**
						 * Triggered at the end of resizing the calEvent.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						stop:function(event, ui)
						{
							var eventFlag = event.target.getAttribute('data-resize').split("|")[3];
							var dropdate = that.cal_dnd_tZone_converter(this.dropDate);
							var sT = parseInt((dropdate.split("T")[1].substr(0,2)* 60)) + parseInt(dropdate.split("T")[1].substr(2,2));
							if (this.dropEnd != 'undefined' && this.dropEnd)
							{
								var eT = parseInt(this.dropEnd.getAttribute('data-date').split("|")[1] * 60) + parseInt(this.dropEnd.getAttribute('data-date').split("|")[2]);
								var newDuration = ((eT - sT)/60) * 3600;
								that.dropEvent(this.getAttribute('id'),dropdate,newDuration,eventFlag);
							}
						},

						/**
						 * Triggered during the resize, on the drag of the resize handler
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						resize:function(event, ui)
						{
							this.dropEnd = that.resizeHelper(ui.element[0].getBoundingClientRect().left,
															ui.element[0].getBoundingClientRect().top+ui.size.height);

							if (typeof this.dropEnd != 'undefined' && this.dropEnd)
							{
								if (this.dropEnd.getAttribute('id').match(/drop_/g))
								{
									var dH = this.dropEnd.getAttribute('data-date').split("|")[1];
									var dM = this.dropEnd.getAttribute('data-date').split("|")[2];
								}
								var dataResize = event.target.getAttribute('data-resize').split("|");
								this.innerHTML = '<div style="font-size: 1.1em; text-align:center; font-weight: bold; height:100%;"><span class="calendar_timeDemo" >'+dH+':'+dM+'</span></div>';
							}
							else
							{
								this.innerHTML = '<div class="calendar_d-n-d_forbiden"></div>';
							}
						}
					});

		//Droppable selector
		var $drop = jQuery("div[id^='drop_']")
					//Droppable event handler
					.droppable
					({
						/**
						 * Make all draggable calEvents acceptable
						 *
						 */
						accept:function()
						{
							return true;
						},
						tolerance:'pointer',

						/**
						 * Triggered when the calEvent dropped.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						drop:function(event, ui)
						{
							var dgId = ui.draggable[0].getAttribute('id');
							var dgOwner = dgId.substring(dgId.lastIndexOf("_C")+2,dgId.lastIndexOf(""));
							var dpOwner = event.target.getAttribute('data-owner');
							var eventFlag = ui.draggable[0].getAttribute('data-resize').split("|")[3];
							if (dpOwner == null) dpOwner = dgOwner;
							if (dpOwner == dgOwner )
							{
								that.dropEvent(ui.draggable[0].id, event.target.getAttribute('id').substring(event.target.getAttribute('id').lastIndexOf("drop_")+5, event.target.getAttribute('id').lastIndexOf("_O")),null,eventFlag);
							}
							else
							{
								jQuery(ui.draggable).draggable("option","revert",true);
							}

						},

						/**
						 * Triggered when draggable calEvent is over a droppable calCell.
						 *
						 * @param {event} event
						 * @param {Object} ui
						 */
						over:function(event, ui)
						{
							var timeDemo = event.target.id.substring(event.target.id.lastIndexOf("T")+1,event.target.id.lastIndexOf("_O"));
							var dgId = ui.draggable[0].getAttribute('id');
							var dgOwner = dgId.substring(dgId.lastIndexOf("_C")+2,dgId.lastIndexOf(""));
							var dpOwner = event.target.getAttribute('data-owner');
							if (dpOwner == null) dpOwner = dgOwner;
							if (dpOwner === dgOwner )
							{
								ui.helper[0].innerHTML = '<div class="calendar_d-n-d_timeCounter"><span>'+timeDemo+'</span></div>';
							}
							else
							{
								ui.helper[0].innerHTML = '<div class="calendar_d-n-d_forbiden"></div>';
							}
						}
					});

		//jQuery Calendar Event selector
		var $iframeBody = jQuery("body")
			//mouseover event handler for calendar tooltip
			.on("mouseover", "div[data-tooltip]",function(){
				var $ttp = jQuery(this);
				//Check if the tooltip is already initialized
				if (!$ttp.data('uiTooltip'))
				{
					$ttp.tooltip({
						items: "[data-tooltip]",
						show: false,
						content: function()
						{
							var elem = $ttp;
							if (elem.is("[data-tooltip]"))
								return this.getAttribute('data-tooltip') ;
						},
						track:true,

						open: function(event,ui){
							ui.tooltip.removeClass("ui-tooltip");
							ui.tooltip.addClass("calendar_uitooltip");
							if (this.scrollHeight > this.clientHeight)
							{
								// bind on tooltip close event
								$ttp.on("tooltipclose", function (event, ui){
									// bind hover handler on tooltip helper in order to be able to freeze the tooltip and scrolling
									ui.tooltip.hover(
										function () {
											var $ttp_helper = jQuery(this);
											if (this.scrollHeight > this.clientHeight)	$ttp_helper.stop(true).fadeTo(100, 1);
										},
										function () {
											var $ttp_helper = jQuery(this);
											$ttp_helper.fadeOut("100", function(){$ttp_helper.remove();});
										}
									);
								});
							}
						}
					});
				}
				else
				{
					$ttp.tooltip('enable');
				}
			})

			// mousedown event handler for calendar tooltip to remove disable tooltip
			.on("mousedown", "div[data-tooltip]", function(){
				var $ttp = jQuery(this);
				// Make sure the tooltip initialized before calling it
				if ($ttp.data('uiTooltip'))
				{
					$ttp.tooltip("disable");
				}
			})

			//onClick event handler for calendar Events
			.on("click", "div.calendar_calEvent", function(ev){
				var Id = ev.currentTarget.id.replace(/drag_/g,'').split("_")[0];
				var eventId = Id.match(/-?\d+\.?\d*/g)[0];
				var appName = Id.replace(/-?\d+\.?\d*/g,'');
				var startDate = ev.currentTarget.getAttribute('data-resize').split("|")[0];
				var eventFlag = ev.currentTarget.getAttribute('data-resize').split("|")[3];
				if (eventFlag != 'S' && eventFlag != 'WDS')
				{
					that.egw.open(eventId,appName !=""?appName:'calendar','edit');
				}
				else
				{
					that.edit_series(eventId,startDate);
				}
			})

			//Click event handler for integrated apps
			.on("click","div.calendar_plannerEvent",function(ev){
				var eventId = ev.currentTarget.getAttribute('data-date').split("|")[1];
				var startDate = ev.currentTarget.getAttribute('data-date').split("|")[0];
				var recurrFlag = ev.currentTarget.getAttribute('data-date').split("|")[2];
				if (recurrFlag == "n")
				{
					egw.open(eventId,'calendar','edit');
				}
				else
				{
					that.edit_series(eventId,startDate);
				}
			})

			//Click event handler for calendar cells
			.on("click","div.calendar_calAddEvent, div.calendar_calTimeRowTime",function(ev){
				var timestamp = ev.target.getAttribute('data-date').split("|");
				if (typeof ev.target.getAttribute('id') != 'undefined' && ev.target.getAttribute('id'))
				{
					var owner = ev.target.getAttribute('id').split("_");

					var ownerId = owner[2].match( /Ogroup/g)?owner[2].replace( /Ogroup/g, '-'):owner[2].replace( /^\D+/g, '');
					if (owner[2].match( /Or/g))
					{
						ownerId = 'r' + ownerId;
					}
				}

				var eventInfo = {
					date: timestamp[0],
					hour: timestamp[1],
					minute: timestamp[2]
				};

				if (typeof ownerId !='undefined' && ownerId != 0)
				{
					jQuery(eventInfo).extend(eventInfo,{owner: ownerId});
				}

				that.egw.open(null, 'calendar', 'add', eventInfo , '_blank');
			})

			//Click event handler for calendar todos
			.on("click", "a[data-todo]",function(ev){
					var windowSize = ev.currentTarget.getAttribute('data-todo').split("|")[1];
					var link = ev.currentTarget.getAttribute('href');
					that.egw.open_link(link,'_blank',windowSize);
					return false;
			});

		//******************************** Calendar Sortable ************************
		// Calender current state
		var state = this.getState();

		if (state && state.view === "day"
				&& typeof state.owner != 'undefined'
				&& typeof state.owner == 'string' && state.owner.split(',').length > 1)
		{
			$iframeBody.find('#calendar_calDayCols')
					.addClass('cal_is_sortable')
					.css({"white-space":"nowrap"})
					.children().each(function(){
						// Change day view columns position in order to get sortable placeholder working
						jQuery(this).css({position:"relative",display:"inline-block", left:"none"});
			});
		}

		$iframeBody.find('.cal_is_sortable').sortable ({
				cancel: "#divAppboxHeader, .calendar_calWeekNavHeader, .calendar_plannerHeader",
				placeholder: "srotable_cal_wk_ph",
				axis:"y",
				revert: true,
				helper:"clone",
				create: function ()
				{
					var $sortItem = jQuery(this);
					var options = {};
					switch (state.view)
					{
						case "day":
							options = {
								placeholder:"srotable_cal_day_ph",
								axis:"x"
							};
							$sortItem.sortable('option', options);
							break;
						case "week":
							options = {
								placeholder:"srotable_cal_wk_ph",
								axis:"y"
							};
							$sortItem.sortable('option', options);
							break;
						default:
							$sortItem.sortable('destroy');
					}
				},
				start: function ()
				{
					$drag.draggable('disable');
					$drop.droppable('disable');
				},
				stop: function ()
				{
					$drag.draggable('enable');
					$drop.droppable('enable');
				},
				update: function ()
				{
					if (state && typeof state.owner !== 'undefined')
					{
						var sortedArr = jQuery(this).sortable('toArray', {attribute:"data-sortable-id"});
						state.owner = sortedArr.join(',');
						that.setState({state:state});
					}
				}
			});
	},

	/**
	 * Function to help calendar resizable event, to fetch the right droppable cell
	 *
	 * @param {int} _X position left of draggable element
	 * @param {int} _Y position top of draggable element
	 *
	 * @return {jquery object|boolean} return selected jquery if not return false
	 */
	resizeHelper: function(_X,_Y)
	{
		var $drops = jQuery("div[id^='drop_']");
		var top = Math.round(_Y);
		var left = Math.round(_X);
		for (var i=0;i < $drops.length;i++)
		{
			if (top >= Math.round($drops[i].getBoundingClientRect().top)
					&& top <= Math.round($drops[i].getBoundingClientRect().bottom)
					&& left >= Math.round($drops[i].getBoundingClientRect().left)
					&& left <= Math.round($drops[i].getBoundingClientRect().right))
				return $drops[i];
		}
		return false;
	},

	/**
	 * Convert AM/PM dateTime format to 24h
	 *
	 * @param {string} _date dnd date format: dateTtime{am|pm}, eg. 121214T1205 am
	 *
	 * @return {string} 24h format date
	 */
	cal_dnd_tZone_converter : function (_date)
	{
		var date = _date;
		if (_date !='undefined')
		{
			var tZone = _date.split('T')[1];
			if (tZone.search('am') > 0)
			{
				tZone = tZone.replace(' am','');
				var tAm = tZone.substr(0,2);
				if (tAm == '12')
				{
					tZone = tZone.replace('12','00');
				}
				date = _date.split('T')[0] + 'T' + tZone;
			}
			if (tZone.search('pm') > 0)
			{
				var pmTime = tZone.replace(' pm','');
				var H = parseInt(pmTime.substring(0,2)) + 12;
				pmTime = H.toString() + pmTime.substr(2,2);
				date = _date.split('T')[0] + 'T' + pmTime;
			}

		}
		return date;
	},

	/**
	 * This function tries to recognise the type of dropped event, and sends relative request to server accordingly
	 *	-ATM we have three different requests:
	 *		-1. Event part of series
	 *		-2. Single Event (Normall Cal Event)
	 *		-3. Integrated Infolog Event
	 *
	 * @param {string} _id dragged event id
	 * @param {array} _date array of date,hour, and minute of dropped cell
	 * @param {string} _duration description
	 * @param {string} _eventFlag Flag to distinguish whether the event is Whole Day, Series, or Single
	 *	- S represents Series
	 *	- WD represents Whole Day
	 *	- WDS represents Whole Day Series (recurrent whole day event)
	 *	- '' represents Single
	 */
	dropEvent : function(_id, _date, _duration, _eventFlag)
	{
		var eventId = _id.substring(_id.lastIndexOf("drag_")+5,_id.lastIndexOf("_O"));
		var calOwner = _id.substring(_id.lastIndexOf("_O")+2,_id.lastIndexOf("_C"));
		var eventOwner = _id.substring(_id.lastIndexOf("_C")+2,_id.lastIndexOf(""));
		var date = this.cal_dnd_tZone_converter(_date);

		if (_eventFlag == 'S')
		{
			et2_dialog.show_dialog(function(_button_id)
			{
				if (_button_id == et2_dialog.OK_BUTTON)
				{
					egw().json('calendar.calendar_uiforms.ajax_moveEvent', [eventId, calOwner, date, eventOwner, _duration]).sendRequest();
				}
			},this.egw.lang("Do you really want to change the start of this series? If you do, the original series will be terminated as of today and a new series for the future reflecting your changes will be created."),
			this.egw.lang("This event is part of a series"), {}, et2_dialog.BUTTONS_OK_CANCEL , et2_dialog.WARNING_MESSAGE);
		}
		else
		{
			//Get infologID if in case if it's an integrated infolog event
			var infolog_id = eventId.split('infolog')[1];

			if (infolog_id)
			{
				// If it is an integrated infolog event we need to edit infolog entry
				egw().json('stylite_infolog_calendar_integration::ajax_moveInfologEvent', [infolog_id, date,_duration]).sendRequest();
			}
			else
			{
				//Edit calendar event
				egw().json('calendar.calendar_uiforms.ajax_moveEvent',[eventId,	calOwner, date,	eventOwner,	_duration]).sendRequest();
			}
		}
	},

	/**
	 * open the freetime search popup
	 *
	 * @param {string} _link
	 */
	freetime_search_popup: function(_link)
	{
		this.egw.open_link(_link,'ft_search','700x500') ;
	},

	/**
	 * send an ajax request to server to set the freetimesearch window content
	 *
	 */
	freetime_search: function()
	{
		var content = this.et2.getArrayMgr('content').data;
		content['start'] = this.et2.getWidgetById('start').get_value();
		content['end'] = this.et2.getWidgetById('end').get_value();
		content['duration'] = this.et2.getWidgetById('duration').get_value();

		var request = this.egw.json('calendar.calendar_uiforms.ajax_freetimesearch', [content],null,null,null,null);
		request.sendRequest();
	},

	/**
	 * Function for disabling the recur_data multiselect box
	 *
	 */
	check_recur_type: function()
	{
		var recurType = this.et2.getWidgetById('recur_type');
		var recurData = this.et2.getWidgetById('recur_data');

		if(recurType && recurData)
		{
			recurData.set_disabled(recurType.get_value() != 2);
		}
	},

	/**
	 * Show/Hide end date, for both edit and freetimesearch popups,
	 * based on if "use end date" selected or not.
	 *
	 */
	set_enddate_visibility: function()
	{
		var duration = this.et2.getWidgetById('duration');
		var start = this.et2.getWidgetById('start');
		var end = this.et2.getWidgetById('end');
		var content = this.et2.getArrayMgr('content').data;

		if (typeof duration != 'undefined' && typeof end != 'undefined')
		{
			end.set_disabled(duration.get_value()!=='');

			// Only set end date if not provided, adding seconds fails with DST
			if (!end.disabled && !content.end)
			{
				end.set_value(start.get_value());
				if (typeof content.duration != 'undefined') end.set_value("+"+content.duration);
			}
		}
	},

	/**
	 * handles actions selectbox in calendar edit popup
	 *
	 * @param {mixed} _event
	 * @param {et2_base_widget} widget "actions selectBox" in edit popup window
	 */
	actions_change: function(_event, widget)
	{
		var event = this.et2.getArrayMgr('content').data;
		if (widget)
		{
			var id = this.et2.getArrayMgr('content').data['id'];
			switch (widget.get_value())
			{
				case 'print':
					this.egw.open_link('calendar.calendar_uiforms.edit&cal_id='+id+'&print=1','_blank','700x700');
					break;
				case 'mail':
					this.egw.json('calendar.calendar_uiforms.ajax_custom_mail', [event, !event['id'], false],null,null,null,null).sendRequest();
					this.et2._inst.submit();
					break;
				case 'sendrequest':
					this.egw.json('calendar.calendar_uiforms.ajax_custom_mail', [event, !event['id'], true],null,null,null,null).sendRequest();
					this.et2._inst.submit();
					break;
				case 'infolog':
					this.egw.open_link('infolog.infolog_ui.edit&action=calendar&action_id='+($j.isPlainObject(event)?event['id']:event),'_blank','700x600','infolog');
					this.et2._inst.submit();
					break;
				case 'ical':
					this.et2._inst.postSubmit();
					break;
				default:
					this.et2._inst.submit();
			}
		}
	},

	/**
	 * open mail compose popup window
	 *
	 * @param {Array} vars
	 * @todo need to provide right mail compose from server to custom_mail function
	 */
	custom_mail: function (vars)
	{
		this.egw.open_link(this.egw.link("/index.php",vars),'_blank','700x700');
	},

	/**
	 * control delete_series popup visibility
	 *
	 * @param {et2_widget} widget
	 * @param {Array} exceptions an array contains number of exception entries
	 *
	 */
	delete_btn: function(widget,exceptions)
	{
		var content = this.et2.getArrayMgr('content').data;

		if (exceptions)
		{
			var buttons = [
				{
					button_id: 'keep',
					title: this.egw.lang('All exceptions are converted into single events.'),
					text: this.egw.lang('Keep exceptions'),
					id: 'button[delete_keep_exceptions]',
					image: 'keep', "default":true
				},
				{
					button_id: 'delete',
					title: this.egw.lang('The exceptions are deleted together with the series.'),
					text: this.egw.lang('Delete exceptions'),
					id: 'button[delete_exceptions]',
					image: 'delete'
				},
				{
					button_id: 'cancel',
					text: this.egw.lang('Cancel'),
					id: 'dialog[cancel]',
					image: 'cancel'
				}

			];
			var self = this;
			et2_dialog.show_dialog
			(
					function(_button_id)
					{
						if (_button_id != 'dialog[cancel]')
						{
							self.et2._inst.submit(_button_id);
							return true;
						}
						else
						{
							return false;
						}
					},
					this.egw.lang("Do you want to keep the series exceptions in your calendar?"),
					this.egw.lang("This event is part of a series"), {}, buttons , et2_dialog.WARNING_MESSAGE
			);
		}
		else if (content['recur_type'] !== 0)
		{
			et2_dialog.confirm(widget,'Delete this series of recuring events','Delete Series');
		}
		else
		{
			et2_dialog.confirm(widget,'Delete this event','Delete');
		}
	},

	/**
	 * print_participants_status(egw,widget)
	 * Handle to apply changes from status in print popup
	 *
	 * @param {mixed} _event
	 * @param {et2_base_widget} widget widget "status" in print popup window
	 *
	 */
	print_participants_status: function(_event, widget)
	{
		if (widget && window.opener)
		{
			//Parent popup window
			var editPopWindow = window.opener;

			if (editPopWindow)
			{
				//Update paretn popup window
				editPopWindow.etemplate2.getByApplication('calendar')[0].widgetContainer.getWidgetById(widget.id).set_value(widget.get_value());
			}
			this.et2._inst.submit();

			editPopWindow.opener.egw_refresh('status changed','calendar');
		}
		else if (widget)
		{
			window.egw_refresh(this.egw.lang('The original popup edit window is closed! You need to close the print window and reopen the entry again.'),'calendar');
		}
	},

	/**
	 * In edit popup, search for calendar participants.
	 * Resources need to have the start & duration (etc.)
	 * passed along in the query.
	 *
	 * @param {Object} request
	 * @param {et2_link_entry} widget
	 *
	 * @returns {boolean} True to continue with the search
	 */
	edit_participant_search: function(request, widget)
	{
		if(widget.app_select.val() == 'resources')
		{
			// Resources search is expecting exec
			var values = widget.getInstanceManager().getValues(widget.getRoot());
			if(typeof request.options != 'object' || request.options == null)
			{
				request.options = {};
			}
			request.options.exec = {
				start: values.start,
				end: values.end,
				duration: values.duration,
				participants: values.participants,
				recur_type: values.recur_type,
				event_id: values.link_to.to_id, // cal_id, if available
				show_conflict: (egw.preference('defaultresource_sel','calendar') == 'resources_without_conflict') ? '0' : '1'
			};
			if(values.whole_day)
			{
				request.options.exec.whole_date = true;
			}
		}
		return true;
	},

	/**
	 * Handles to select freetime, and replace the selected one on Start,
	 * and End date&time in edit calendar entry popup.
	 *
	 * @param {mixed} _event
	 * @param {et2_base_widget} _widget widget "select button" in freetime search popup window
	 *
	 */
	freetime_select: function(_event, _widget)
	{
		if (_widget)
		{
			var content = this.et2._inst.widgetContainer.getArrayMgr('content').data;
			// Make the Id from selected button by checking the index
			var selectedId = _widget.id.match(/^select\[([0-9])\]$/i)[1];

			var sTime = this.et2.getWidgetById(selectedId+'start');

			//check the parent window is still open before to try to access it
			if (window.opener && sTime)
			{
				var editWindowObj = window.opener.etemplate2.getByApplication('calendar')[0];
				if (typeof editWindowObj != "undefined")
				{
					var startTime = editWindowObj.widgetContainer.getWidgetById('start');
					var endTime = editWindowObj.widgetContainer.getWidgetById('end');
					if (startTime && endTime)
					{
						startTime.set_value(sTime.get_value());
						endTime.set_value(sTime.get_value());
						endTime.set_value('+'+content['duration']);
					}
				}
			}
			else
			{
				alert(this.egw.lang('The original calendar edit popup is closed!'));
			}
		}
		egw(window).close();
	},

	/**
	 * show/hide the filter of nm list in calendar listview
	 *
	 */
	filter_change: function()
	{
		var filter = this.et2 ? this.et2.getWidgetById('filter') : null;
		var dates = this.et2 ? this.et2.getWidgetById('calendar.list.dates') : null;

		if (filter && dates)
		{
			dates.set_disabled(filter.value !== "custom");
		}
	},

	/**
	 * this function try to fix ids which are from integrated apps
	 *
	 * @param {egw_action} _action
	 * @param {Array} _senders
	 */
	cal_fix_app_id: function(_action, _senders)
	{
		var app = 'calendar';
		var id = _senders[0].id;
		var matches = id.match(/^(?:calendar::)?([0-9]+)(:([0-9]+))?$/);
		if (matches)
		{
			id = matches[1];
		}
		else
		{
			matches = id.match(/^([a-z_-]+)([0-9]+)/i);
			if (matches)
			{
				app = matches[1];
				id = matches[2];
			}
		}
		var backup_url = _action.data.url;

		_action.data.url = _action.data.url.replace(/(\$|%24)id/,id);
		_action.data.url = _action.data.url.replace(/(\$|%24)app/,app);

		nm_action(_action, _senders);

		_action.data.url = backup_url;	// restore url
	},

	/**
	 * Open calendar entry, taking into accout the calendar integration of other apps
	 *
	 * calendar_uilist::get_rows sets var js_calendar_integration object
	 *
	 * @param _action
	 * @param _senders
	 *
	 */
	cal_open: function(_action, _senders)
	{

		var js_integration_data = _action.parent.data.nextmatch.options.settings.js_integration_data || this.et2.getArrayMgr('content').data.nm.js_integration_data;
		var id = _senders[0].id;
		var matches = id.match(/^(?:calendar::)?([0-9]+):([0-9]+)$/);
		if (matches)
		{
			this.edit_series(matches[1],matches[2]);
			return;
		}
		matches = id.match(/^([a-z_-]+)([0-9]+)/i);
		if (matches)
		{
			var js_integration_data = _action.parent.data.nextmatch.options.settings.js_integration_data || this.et2.getArrayMgr('content').data.nm.js_integration_data;
			if(typeof js_integration_data == 'string')
			{
				js_integration_data = JSON.parse(js_integration_data);
			}
		}
		matches = id.match(/^calendar::([a-z_-]+)([0-9]+)/i);
		if (matches && js_integration_data && js_integration_data[matches[1]])
		{
			var app = matches[1];
			_action.data.url = window.egw_webserverUrl+'/index.php?';
			var get_params = js_integration_data[app].edit;
			get_params[js_integration_data[app].edit_id] = matches[2];
			for(var name in get_params)
				_action.data.url += name+"="+encodeURIComponent(get_params[name])+"&";

			if (js_integration_data[app].edit_popup)
			{
				egw.open_link(_action.data.url,'_blank',js_integration_data[app].edit_popup,app);

				_action.data = backup;	// restore url, width, height, nm_action
				return;
			}
		}
		else
		{
			// Other app integration using link registry
			var data = egw.dataGetUIDdata(_senders[0].id);
			if(data && data.data)
			{
				return egw.open(data.data.app_id, data.data.app, 'edit');
			}
		}
		// Regular, single event
		egw.open(id.replace(/^calendar::/g,''),'calendar','edit');
	},

	/**
	 * Delete calendar entry, asking if you want to delete series or exception
	 *
	 *
	 * @param _action
	 * @param _senders
	 */
	cal_delete: function(_action, _senders)
	{
		var backup = _action.data;
		var matches = false;

		// Loop so we ask if any of the selected entries is part of a series
		for(var i = 0; i < _senders.length; i++)
		{
			var id = _senders[i].id;
			if(!matches)
			{
				matches = id.match(/^(?:calendar::)?([0-9]+):([0-9]+)$/);
			}
		}
		if (matches)
		{
			var popup = jQuery('#calendar-list_delete_popup').get(0);
			if (typeof popup != 'undefined')
			{
				// nm action - show popup
				nm_open_popup(_action,_senders);
			}
			return;
		}

		nm_action(_action, _senders);
	},

	/**
	 * Confirmation dialog for moving a series entry
	 *
	 * @param {object} _DOM
	 * @param {et2_widget} _button button Save | Apply
	 */
	move_edit_series: function(_DOM,_button)
	{
		var content = this.et2.getArrayMgr('content').data;
		var start_date = this.et2.getWidgetById('start').get_value();
		var whole_day = this.et2.getWidgetById('whole_day');
		var is_whole_day = whole_day && whole_day.get_value() == whole_day.options.selected_value;
		var button = _button;
		var that = this;
		if (typeof content != 'undefined' && content.id != null &&
			typeof content.recur_type != 'undefined' && content.recur_type != null && content.recur_type != 0
		)
		{
			if (content.start != start_date || content.whole_day != is_whole_day)
			{
				et2_dialog.show_dialog(function(_button_id)
					{
						if (_button_id == et2_dialog.OK_BUTTON)
						{
							that.et2._inst.submit(button);

						}
						else
						{
							return false;
						}
					},
					this.egw.lang("Do you really want to change the start of this series? If you do, the original series will be terminated as of today and a new series for the future reflecting your changes will be created."),
					this.egw.lang("This event is part of a series"), {}, et2_dialog.BUTTONS_OK_CANCEL , et2_dialog.WARNING_MESSAGE);
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	},

	/**
	 * Create edit exception dialog for recurrence entries
	 *
	 * @param {object} event
	 * @param {string} id cal_id
	 * @param {integer} date timestamp
	 */
	edit_series: function(event,id,date)
	{
		// Coming from list, there is no event
		if(arguments.length == 2)
		{
			date = id;
			id = event;
			event = null;
		}
		var edit_id = id;
		var edit_date = date;
		var that = this;
		var buttons = [
			{text: this.egw.lang("Edit exception"), id: "exception", class: "ui-priority-primary", "default": true},
			{text: this.egw.lang("Edit series"), id:"series"},
			{text: this.egw.lang("Cancel"), id:"cancel"}
		];
		et2_dialog.show_dialog(function(_button_id)
		{
			switch(_button_id)
			{
				case 'exception':
					that.egw.open(edit_id, 'calendar', 'edit', '&date='+edit_date+'&exception=1');
					break;
				case 'series':
					that.egw.open(edit_id, 'calendar', 'edit', '&date='+edit_date);
					break;
				case 'cancel':

				default:
					break;
			}
		},this.egw.lang("Do you want to edit this event as an exception or the whole series?"),
		this.egw.lang("This event is part of a series"), {}, buttons, et2_dialog.WARNING_MESSAGE);
	},

	/**
	 * Current state, get updated via set_state method
	 *
	 * @type object
	 */
	state: undefined,

	/**
	 * Method to set state for JSON requests (jdots ajax_exec or et2 submits can NOT use egw.js script tag)
	 *
	 * @param {object} _state
	 */
	set_state: function(_state)
	{
		if (typeof _state == 'object')
		{
			this.state = _state;
		}
	},

	/**
	 * Return state object defining current view
	 *
	 * Called by favorites to query current state.
	 *
	 * @return {object} description
	 */
	getState: function()
	{
		var state = this.state;

		if (!state)
		{
			var egw_script_tag = document.getElementById('egw_script_id');
			state = egw_script_tag.getAttribute('data-calendar-state');
			state = state ? JSON.parse(state) : {};
		}
		// we are currently in list-view
		if (this.et2 && this.et2.getWidgetById('nm'))
		{
			jQuery.extend(state, this._super.apply(this, arguments));	// call default implementation
		}

		// Don't store current user in state to allow admins to create favourites for all
		// Should make no difference for normal users.
		if(state.owner == egw.user('account_id'))
		{
			// 0 is always the current user, so if an admin creates a default favorite,
			// it will work for other users too.
			state.owner = 0;
		}
		// Don't store first and last
		delete state.first;
		delete state.last;

		return state;
	},

	/**
	 * Set a state previously returned by getState
	 *
	 * Called by favorites to set a state saved as favorite.
	 *
	 * @param {object} state containing "name" attribute to be used as "favorite" GET parameter to a nextmatch
	 */
	setState: function(state)
	{
		// State should be an object, not a string, but we'll parse
		if(typeof state == "string")
		{
			if(state.indexOf('{') != -1 || state =='null')
			{
				state = JSON.parse(state);
			}
		}

		if (jQuery.isEmptyObject(state)) state.state = {};

		// old calendar state handling on server-side (incl. switching to and from listview)
		var menuaction = 'calendar.calendar_uiviews.index';
		if (typeof state.state != 'undefined' && (typeof state.state.view == 'undefined' || state.state.view == 'listview'))
		{
			// 'blank' is the special name for no filters, send that instead of the nice translated name
			state.state.favorite = jQuery.isEmptyObject(state.state||state.filter) ? 'blank' : state.name.replace(/[^A-Za-z0-9-_]/g, '_');
			// set date for "No Filter" (blank) favorite to todays date
			if (state.state.favorite == 'blank')
				state.state.date = jQuery.datepicker.formatDate('yymmdd', new Date);

			menuaction = 'calendar.calendar_uilist.listview';
			state.state.ajax = 'true';
			// check if we already use et2 / are in listview
			if (this.et2 || etemplate2 && etemplate2.getByApplication('calendar'))
			{
				// current calendar-code can set regular calendar states only via a server-request :(
				// --> check if we only need to set something which can be handeled by nm internally
				// or we need a redirect
				// ToDo: pass them via nm's get_rows call to server (eg. by passing state), so we dont need a redirect
				var current_state = this.getState();
				var need_redirect = false;
				for(var attr in current_state)
				{
					switch(attr)
					{
						case 'cat_id':
						case 'owner':
						case 'filter':
							if (state.state[attr] != current_state[attr])
							{
								need_redirect = true;
								// reset of attributes managed on server-side
								if (state.state.favorite === 'blank')
								{
									switch(attr)
									{
										case 'cat_id':
											state.state.cat_id = 0;
											break;
										case 'owner':
											state.state.owner = egw.user('account_id');
											break;
										case 'filter':
											state.state.filter = 'default';
											break;
									}
								}
								break;
							}
							break;

						case 'view':
							// "No filter" (blank) favorite: if not in listview --> stay in that view
							if (state.state.favorite === 'blank' && current_state.view != 'listview')
							{
								menuaction = 'calendar.calendar_uiviews.index';
								delete state.state.ajax;
								need_redirect = true;
							}
					}
				}
				if (!need_redirect)
				{
					return this._super.apply(this, [state]);
				}
			}
		}
		// setting internal state now, that linkHandler does not intercept switching from listview to any old view
		this.state = state;

		var query = jQuery.extend({menuaction: menuaction},state.state||{});

		// prepend an owner 0, to reset all owners and not just set given resource type
		if(typeof query.owner != 'undefined')
		{
			query.owner = '0,'+ query.owner;
		}

		this.egw.open_link(this.egw.link('/index.php',query), 'calendar');

		// Stop the normal bubbling if this is called on click
		return false;
	},

	/**
	 * Enable/Disable custom Date-time for set Alarm
	 *
	 * @param {egw object} _egw
	 * @param {widget object} _widget new_alarm[options] selectbox
	 */
	alarm_custom_date: function (_egw,_widget)
	{
		var alarm_date = this.et2.getWidgetById('new_alarm[date]');
		var alarm_options = _widget || this.et2.getWidgetById('new_alarm[options]');
		var start = this.et2.getWidgetById('start');

		if (alarm_date && alarm_options
					&& start)
		{
			if (alarm_options.get_value() != '0')
			{
				alarm_date.set_class('calendar_alarm_date_display');
			}
			else
			{
				alarm_date.set_class('');
			}
			var startDate = typeof start.get_value != 'undefined'?start.get_value():start.value;
			if (startDate)
			{
				var date = new Date(startDate);
				date.setTime(date.getTime() - 1000 * parseInt(alarm_options.get_value()));
				alarm_date.set_value(date);
			}
		}
	},

	/**
	 * Set alarm options based on WD/Regular event user preferences
	 * Gets fired by wholeday checkbox
	 *
	 * @param {egw object} _egw
	 * @param {widget object} _widget whole_day checkbox
	 */
	set_alarmOptions_WD: function (_egw,_widget)
	{
		var alarm = this.et2.getWidgetById('alarm');
		if (!alarm) return;	// no default alarm
		var content = this.et2.getArrayMgr('content').data;
		var start = this.et2.getWidgetById('start');
		var self= this;
		var time = alarm.cells[1][0].widget;
		var event = alarm.cells[1][1].widget;
		// Convert a seconds of time to a translated label
		var _secs_to_label = function (_secs)
		{
			var label='';
			if (_secs <= 3600)
			{
				label = self.egw.lang('%1 minutes', _secs/60);
			}
			else if(_secs <= 86400)
			{
				label = self.egw.lang('%1 hours', _secs/3600);
			}
			return label;
		};
		if (typeof content['alarm'][1]['default'] == 'undefined')
		{
			// user deleted alarm --> nothing to do
		}
		else
		{
			var def_alarm = this.egw.preference(_widget.get_value() === "true" ?
				'default-alarm-wholeday' : 'default-alarm', 'calendar');
			if (!def_alarm && def_alarm !== 0)	// no alarm
			{
				jQuery('#calendar-edit_alarm > tbody :nth-child(1)').hide();
			}
			else
			{
				jQuery('#calendar-edit_alarm > tbody :nth-child(1)').show();
				start.set_hours(0);
				start.set_minutes(0);
				time.set_value(start.get_value());
				time.set_value('-'+(60 * def_alarm));
				event.set_value(_secs_to_label(60 * def_alarm));
			}
		}
	}
});
