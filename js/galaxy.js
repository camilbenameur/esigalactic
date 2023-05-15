let url = 'http://esigalactic/api/galaxyAPI.php';
let galaxyChoice = document.getElementById('galaxy-choice');
let solarSystemChoice = document.getElementById('solar-system-choice');
let planetDisplay = document.getElementById('planet-display');

async function update() {
  planetDisplay.innerHTML = '';
  const galaxyId = galaxyChoice.value;
  const solarSystemId = solarSystemChoice.value;
  const answer = await fetch(url + '?galaxy-choice=' + galaxyId + '&solar-system-choice=' + solarSystemId);
  const data = await answer.json();
  data.forEach(element => {

    let planet = document.createElement('p');
    planet.id = 'planet-' + element.id;
    planet.classList.add('planet');
    planet.innerHTML = '<span>' +  element.name + '</span><span>' + "Position : " + element.position + '</span><span>' + "Owner : " + element.player_id + '</span>';
    planetDisplay.appendChild(planet);

    });
}

const formButton = document.getElementById('form-button');

solarSystemChoice.addEventListener('change', update);
galaxyChoice.addEventListener('change', update);