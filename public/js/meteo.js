// Mettre en majuscule la premiére lettre.

function capitalize(str){
  return str[0].toUpperCase() + str.slice(1);
}

function capitalized(str){
  return str[0].toLowerCase() + str.slice(1);
}


// Affichage des icones en fonctions des résultats de l'api météo (conditions).

const weatherIcons = {
  "Rain"   : "wi wi-day-rain",
  "Clouds" : "wi wi-day-cloudy",
  "Clear"  : "wi wi-day-sunny",
  "Snow"   : "wi wi-day-snow",
  "Mist"   : "wi wi-day-fog",
  "Drizzle": "wi wi-day-sleet",
  "Haze"   : "wi wi-day-haze",
  "Fog"    : "wi wi-day-fog",
}


async function main(){


// 1. Récupération de l'adresse Ip grâce à l'api ipify.


   ville = document.querySelector('#city').textContent;


const meteo = await window.fetch('https://api.openweathermap.org/data/2.5/forecast?q=' + ville +'&appid=aa93877621d77c7fe990a67a5fa2e8a5&lang=fr&units=metric')
  .then(resultat => resultat.json())
  .then(json     => (json))
console.log(meteo);

const departement = await window.fetch('https://geo.api.gouv.fr/communes?nom=' + ville + '&fields=departement')
  .then(resultat => resultat.json())
  .then(json     =>  (json))
  console.log(departement);




//.Préparation de l'affichage de la méteo

displayWeatherInfos(meteo)
displayInfos(departement)


}

//.Récupération et affichage des informations concernnant le département.

function displayInfos(donnee){
    const code = donnee[0].departement.code
    const nom  = donnee[0].departement.nom
    console.log(code);

    document.querySelector('#code').textContent = code;
    document.querySelector('#nom').textContent  = nom;

}

function displayWeatherInfos(data){

//.Données du premier jour.
    const name         = data.city.name;
    const txt0         = data.list[0].dt_txt;
    const conditions0  = data.list[0].weather[0].main;
    const temperature0 = data.list[0].main.temp;
    const description0 = data.list[0].weather[0].description;
    let   vent0        = data.list[0].wind.speed;
    let   direction0   = data.list[0].wind.deg;


    //console.log(vent);

//.Données du deuxieme jour.

    const txt1         = data.list[8].dt_txt;
    const conditions1  = data.list[8].weather[0].main;
    const temperature1 = data.list[8].main.temp;
    const description1 = data.list[8].weather[0].description;
    let   vent1        = data.list[8].wind.speed;
    let   direction1   = data.list[8].wind.deg;


//.Données du troisiéme jour.

    const txt2         = data.list[16].dt_txt;
    const conditions2  = data.list[16].weather[0].main;
    const temperature2 = data.list[16].main.temp;
    const description2 = data.list[16].weather[0].description;
    let   vent2        = data.list[16].wind.speed;
    let   direction2   = data.list[16].wind.deg;



//.Données du quatriéme jour.

    const txt3         = data.list[24].dt_txt;
    const conditions3  = data.list[24].weather[0].main;
    const temperature3 = data.list[24].main.temp;
    const description3 = data.list[24].weather[0].description;
    let   vent3        = data.list[24].wind.speed;
    let   direction3   = data.list[24].wind.deg;




//.Convertion de la vitesse du vent.

          vent0  = vent0 * 3.6;
          vent1  = vent1 * 3.6;
          vent2  = vent2 * 3.6;
          vent3  = vent3 * 3.6;
          //vent4  = vent4 * 3.6;


//.Convertion de la direction du vent.

if (direction0, direction1, direction2, direction3 < 23) {

    direction0  = "Nord";
    direction1  = "Nord";
    direction2  = "Nord";
    direction3  = "Nord";
   // direction4  = "Nord";

}

else if (direction0, direction1, direction2, direction3 < 68) {

    direction0   = "Nord - Est";
    direction1   = "Nord - Est";
    direction2   = "Nord - Est";
    direction3   = "Nord - Est";
    //direction4   = "Nord - Est";
}

else if (direction0, direction1, direction2, direction3 < 113) {

    direction0  = "Est";
    direction1  = "Est";
    direction2  = "Est";
    direction3  = "Est";
   // direction4  = "Est";
}

else if (direction0, direction1, direction2, direction3 < 158) {

    direction0   = "Sud - Est";
    direction1   = "Sud - Est";
    direction2   = "Sud - Est";
    direction3   = "Sud - Est";
   // direction4   = "Sud - Est";
}

else if (direction0, direction1, direction2, direction3 < 203) {

    direction0   = "Sud";
    direction1   = "Sud";
    direction2   = "Sud";
    direction3   = "Sud";
    direction4   = "Sud";
}

else if (direction0, direction1, direction2, direction3 < 248) {

    direction0   = "Sud - Ouest";
    direction1   = "Sud - Ouest";
    direction2   = "Sud - Ouest";
    direction3   = "Sud - Ouest";
   // direction4   = "Sud - Ouest";
}

else if (direction0, direction1, direction2, direction3 < 293) {

    direction0   = "Ouest";
    direction1   = "Ouest";
    direction2   = "Ouest";
    direction3   = "Ouest";
   // direction4   = "Ouest";
}

else if (direction0, direction1, direction2, direction3 < 338) {

    direction0   = "Nord - Ouest";
    direction1   = "Nord - Ouest";
    direction2   = "Nord - Ouest";
    direction3   = "Nord - Ouest";
   // direction4   = "Nord - Ouest";

}

else if (direction0, direction1, direction2, direction3, direction4 <= 360) {

    direction0  =  "Nord";
    direction1  =  "Nord";
    direction2  =  "Nord";
    direction3  =  "Nord";
   // direction4  =  "Nord";
}





//.Affichage du premier jour.

document.querySelector('#ville').textContent        = name;
document.querySelector('#txt').textContent          = txt0;
document.querySelector('#description').textContent  = capitalize(description0);
//document.querySelector('#conditions').textContent   = conditions0;
document.querySelector('#temperature').textContent  = Math.round(temperature0);
document.querySelector('#vent').textContent         = Math.round(vent0);
document.querySelector('#direction').textContent    = direction0;


//.Affichage du deuxieme jour.

document.querySelector('#txt1').textContent          = txt1;
document.querySelector('#description1').textContent  = capitalize(description1);
//document.querySelector('#conditions').textContent   = conditions;
document.querySelector('#temperature1').textContent  = Math.round(temperature1);
document.querySelector('#vent1').textContent         = Math.round(vent1);
document.querySelector('#direction1').textContent    = direction1;


//.Affichage du troisiéme jour.

document.querySelector('#txt2').textContent          = txt2;
document.querySelector('#description2').textContent  = capitalize(description2)
//document.querySelector('#conditions').textContent   = conditions;
document.querySelector('#temperature2').textContent  = Math.round(temperature2);
document.querySelector('#vent2').textContent         = Math.round(vent2);
document.querySelector('#direction2').textContent    = direction2;


//.Affichage du quatriéme jour.

document.querySelector('#txt3').textContent          = txt3;
document.querySelector('#description3').textContent  = capitalize(description3)
//document.querySelector('#conditions').textContent   = conditions;
document.querySelector('#temperature3').textContent  = Math.round(temperature3);
document.querySelector('#vent3').textContent         = Math.round(vent3);
document.querySelector('#direction3').textContent    = direction3;


// Affichage de l'icône WeatherIcones en fonction des conditions météo.

document.querySelector('i.wi').className  = weatherIcons [conditions0];
document.querySelector('i.wi1').className = weatherIcons [conditions1];
document.querySelector('i.wi2').className = weatherIcons [conditions2];
document.querySelector('i.wi3').className = weatherIcons [conditions3];
//document.querySelector('i.wi4').className = weatherIcons [conditions4];




// Affichage du fond d'ecran en fonction des conditions météo.

     document.getElementById('jour0').className = conditions0.toLowerCase();
     document.getElementById('jour1').className = conditions1.toLowerCase();
     document.getElementById('jour2').className = conditions2.toLowerCase();
     document.getElementById('jour3').className = conditions3.toLowerCase();
    // document.getElementById('jour4').className = conditions4.toLowerCase()

}


main();
