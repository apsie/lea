
function voir_select(this_value)
		{
		 document.getElementById(this_value).style.display='block';
		}




function afficherAutre(c1,c2)
 {

if(document.getElementById(c1).value=='Autre')
{

document.getElementById(c2).style.display='block';
document.getElementById(c1).style.display='none';
document.getElementById(c2).name=c1;
document.getElementById(c1).name=c2;
}

}

function verif_champ(c)
{
if(document.getElementById(c).value!="")
{
document.getElementById(c).style.display='block';
}
}
