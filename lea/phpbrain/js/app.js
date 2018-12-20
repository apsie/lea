/**
 * EGroupware phpbrain static javascript code
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package phpbrain
 * @link http://www.egroupware.org
 * @author Klaus Leithoff <kl@stylite.de>
 * @version $Id: app.js 39111 2012-05-04 12:33:37Z leithoff $
 */

function toggleAllCheckboxes(which)
{
	var selected = document.getElementsByName('exec[nm][rows][selected][]');

	for (i=0; i<selected.length; i++)
	{
		if (selected[i].checked)
		{
			selected[i].checked = false;
		}
		else
		{
			selected[i].checked = true;
		}
	}
}
