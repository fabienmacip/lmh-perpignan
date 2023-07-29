mois = parseInt(mois);
mois = ((mois - 1) % 12);
if(mois === 0) { mois = 12; }

if (mois === 12){
an = parseInt(an) - 1;
}
lastMonth = an+'-'+mois+'-01';
newMonth = new Date(lastMonth);

mois = newMonth.getMonth() + 1;
if(mois < 10){
mois = "0"+mois;
}
an = newMonth.getFullYear();

id = an.toString()+mois.toString();
loadOneMustangCalendarMonth(id);
