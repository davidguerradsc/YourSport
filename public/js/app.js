
// Affichage des icones en fonctions des résultats de l'api météo.

const weatherIcons = {
  "Rain"   : "wi wi-day-rain",
  "Clouds" : "wi wi-day-cloudy",
  "Clear"  : "wi wi-day-sunny",
  "Snow"   : "wi wi-day-snow",
  "Mist"   : "wi wi-day-fog",
  "Drizzle": "wi wi-day-sleet",
  "Haze"   : "wi wi-day-haze"
}



// Mettre en majuscule la premiére lettre.

function capitalize(str){
  return str[0].toUpperCase() + str.slice(1);
}


// Fonction d'affichage de la météo:

async function main(withIP = true){

  let ville;

  if(withIP){

// 1. Récupération de l'adresse Ip grâce à l'api ipify.

const ip = await fetch('https://api.ipify.org?format=json')
 .then(resultat => resultat.json())
 .then(json     =>  json.ip)


// 2. Récuperer la ville grâce à l'adresse IP:

   ville = await fetch('http://api.ipstack.com/' + ip + '?access_key=f8235302669e9034b6acfea7bf969128&lang=fr')
  .then(resultat => resultat.json())
  .then(json     => json.city)


   code  = await fetch('http://api.ipstack.com/' + ip + '?access_key=f8235302669e9034b6acfea7bf969128&lang=fr')
  .then(resultat => resultat.json())
  .then(json     => json.country_code)


  // 2-Bis. Récupération de la région administratve.

/*const region = await fetch('http://api.ipstack.com/' + ip + '?access_key=f8235302669e9034b6acfea7bf969128&lang=fr')
  .then(resultat => resultat.json())
  .then(json     => json.region_name)*/


  } else {

    ville = document.querySelector('#ville').textContent;
  }



// 3. Récupération de infos météo de la ville avec l'api OpenWeatherMap.

const meteo = await fetch('https://api.openweathermap.org/data/2.5/weather?q=' + ville + '&appid=aa93877621d77c7fe990a67a5fa2e8a5&lang=fr&units=metric')
    .then(resultat => resultat.json())
    .then(json     => json )


const region = await fetch('https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=' + ville + '&format=json&limit=1')
  .then(resultat => resultat.json())
  .then(json     => json)



    console.log(meteo);

// 4. Afficher les informations sur la page.

displayWeatherInfos(meteo)
displayRegionInfos(region)


}

// Récupération des différentes données météorologique.

function displayWeatherInfos(data){

      const name        = data.name;
      const temperature = data.main.temp;
      let   vent        = data.wind.speed;
      let   direction   = data.wind.deg;
      const conditions  = data.weather[0].main;
      const description = data.weather[0].description;
      const longitude   = data.coord.lon;
      const latitude    = data.coord.lat;



// Convertion de la forçe du vent.

      vent = vent * 3.6;


// Convertion de la direction du vent.

if (direction < 23) {

    direction = "Nord";
}

else if (direction < 68) {

    direction = "Nord - Est";
}

else if (direction < 113) {

    direction = "Est";
}

else if (direction < 158) {

    direction = "Sud - Est";
}

else if (direction < 203) {

    direction = "Sud";
}

else if (direction < 248) {

    direction = "Sud - Ouest";
}

else if (direction < 293) {

    direction = "Ouest";
}

else if (direction < 338) {

    direction = "Nord - Ouest";
}

else if (direction <= 360) {

    direction = "Nord";
}


// Affichage des données météo précédemment récupérées.

      document.querySelector('#ville').textContent = name;
      document.querySelector('#temperature').textContent = Math.round(temperature);
      document.querySelector('#conditions').textContent = capitalize(description);
      document.querySelector('#longitude').textContent = longitude;
      document.querySelector('#latitude').textContent = latitude;
      document.querySelector('#vent').textContent = Math.round(vent);
      document.querySelector('#direction').textContent = direction;






// Affichage de l'icône WeatherIcones en fonction des conditions météo.

      document.querySelector('i.wi').className = weatherIcons [conditions];


// Affichage du fond d'ecran en fonction des conditions météo.

    document.getElementById('meteo').className = conditions.toLowerCase()




}

// Affichage des données informations concernant la ville.

function displayRegionInfos(data){

      const state   = data[0].address.state;
      const country = data[0].address.country;

      document.querySelector('#state').textContent   = state;
      document.querySelector('#country').textContent  = country;

}


// Choisir une ville.

const ville = document.querySelector('#ville');

ville.addEventListener('click', () => {
  ville.contentEditable = true;
});

ville.addEventListener('keydown', (e) => {
  if(e.keyCode === 13){
    e.preventDefault();
    ville.contentEditable = false;
    main(false);
  }
})

main();
