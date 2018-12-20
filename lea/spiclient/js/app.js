/**
 * EGroupware - spiclient - Javascript UI
 *
 * @link http://www.egroupware.org
 * @package spiclient
 * @author 
 * @copyright 
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $
 */

/**
 * UI for spiclient
 *
 * @augments AppJS
 */
app.classes.spiclient = AppJS.extend(
{
	appname: 'spiclient',
	/**
	 * et2 widget container
	 */
	et2: null,
	/**
	 * path widget
	 */

	/**
	 * Constructor
	 *
	 * @memberOf app.spiclient
	 */
	init: function()
	{
		// call parent
		this._super.apply(this, arguments);
	},

	/**
	 * Destructor
	 */
	destroy: function()
	{
		//delete this.et2;
		// call parent
		this._super.apply(this, arguments);
	},

	/**
	 * This function is called when the etemplate2 object is loaded
	 * and ready.  If you must store a reference to the et2 object,
	 * make sure to clean it up in destroy().
	 *
	 * @param et2 etemplate2 Newly ready object
	 */
	et2_ready: function(et2)
	{
		// call parent
		this._super.apply(this, arguments);

		if (typeof et2.templates['spiclient.client.index'] != "undefined")
		{
			this.filter_change();
			this.filter2_change();
		}
	}
	});
