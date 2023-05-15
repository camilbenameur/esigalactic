const url = 'http://esigalactic/api/galaxyAPI.php';
const galaxyChoice = document.getElementById('galaxy-choice');
const solarSystemChoice = document.getElementById('solar-system-choice');




async function update() {
  let galaxyId = galaxyChoice.value;
  let solarSystemId = solarSystemChoice.value;
  const answer = await fetch(url + '?galaxy-choice=' + galaxyId + '&solar-system-choice=' + solarSystemId);
  const data = await answer.json();
  data.forEach(element => {
    console.log(element);
  });
  
}

const formButton = document.getElementById('form-button');
formButton.addEventListener('click', update);