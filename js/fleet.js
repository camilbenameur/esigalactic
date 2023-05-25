class FleetAPI {
    constructor(url, galaxyChoiceId, solarSystemChoiceId, planetChoiceId, planetDisplayId) {
      this.url = url;
      this.galaxyChoice = document.getElementById(galaxyChoiceId);
      this.solarSystemChoice = document.getElementById(solarSystemChoiceId);
      this.planetChoice = document.getElementById(planetChoiceId);
      this.planetDisplay = document.getElementById(planetDisplayId);
  
      this.update = this.update.bind(this);
      this.solarSystemChoice.addEventListener('change', this.update);
      this.galaxyChoice.addEventListener('change', this.update);
    }
  
    async fetchData() {
      this.planetChoice.innerHTML = '';
      const galaxyId = this.galaxyChoice.value;
      const solarSystemId = this.solarSystemChoice.value;
      const response = await fetch(`${this.url}?galaxy-choice=${galaxyId}&solar-system-choice=${solarSystemId}`);
      const data = await response.json();
      return data;
    }
  
    update() {
      this.fetchData().then(data => {
        console.log(data);
        data.forEach(element => {
          const name = element.name;
          const planetOption = document.createElement('option');
          planetOption.text = name;
          this.planetChoice.add(planetOption);
        });
      });
    }
  
    init() {
      this.update();
    }
  }
  
  const fleetAPI = new FleetAPI('http://esigalactic/api/galaxyAPI.php', 'galaxy-choice', 'solar-system-choice', 'planet-choice', 'planet-display');
  fleetAPI.init();
  

/*let planetChoice = document.getElementById("planet-choice");


async function updatePlanetData() {
    try {
        const planetAnswer = await fetch('http://esigalactic/api/galaxyAPI.php');
        const planetData = await planetAnswer.json();

        console.log(planetAnswer);

        planetData.forEach((planet) => {
            const name = planet.name;
            const planetOption = document.createElement('option');
            planetOption.text = name;

            planetChoice.add(planetOption);
        });
    } catch (error) {
        console.error(error);
    }
}

async function test() {
    const planetAnswer = await fetch('http://esigalactic/api/galaxyAPI.php');
    const planetData = await planetAnswer.json();

    fetch(data);
    console.log(Data);
}
test();
updatePlanetData();


async function fetchData() {
    planetDisplay.innerHTML = '';
    const galaxyId = galaxyChoice.value;
    const solarSystemId = solarSystemChoice.value;
    const answer = await fetch(`${this.url}?galaxy-choice=${galaxyId}&solar-system-choice=${solarSystemId}`);
    return answer.json();
  }
  
  update() {
    fetchData().then(data => {
      console.log(data);
      data.forEach(element => {
        planet.id = 'planet-' + element.id;
        planet.classList.add('planet');
        planet.innerHTML = '<option>' + element.name + '</option>';
        planetChoice.appendChild(planet);
      });
    });
  }
*/


