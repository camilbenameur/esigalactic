class GalaxyAPI {
  constructor(url, galaxyChoiceId, solarSystemChoiceId, planetDisplayId) {
    this.url = url;
    this.galaxyChoice = document.getElementById(galaxyChoiceId);
    this.solarSystemChoice = document.getElementById(solarSystemChoiceId);
    this.planetDisplay = document.getElementById(planetDisplayId);
    
    this.update = this.update.bind(this);
    this.solarSystemChoice.addEventListener('change', this.update);
    this.galaxyChoice.addEventListener('change', this.update);
  }
  
  async fetchData() {
    this.planetDisplay.innerHTML = '';
    const galaxyId = this.galaxyChoice.value;
    const solarSystemId = this.solarSystemChoice.value;
    const answer = await fetch(`${this.url}?galaxy-choice=${galaxyId}&solar-system-choice=${solarSystemId}`);
    return answer.json();
  }
  
  update() {
    this.fetchData().then(data => {
      console.log(data);
      data.forEach(element => {
        let planet = document.createElement('p');
        planet.id = 'planet-' + element.id;
        planet.classList.add('planet');
        planet.innerHTML = '<span>' + element.name + '</span><span>' + "Position : " + element.position + '</span><span>' + "Owner : " + element.player_id + '</span>';
        this.planetDisplay.appendChild(planet);
      });
    });
  }
  
  init() {
    window.onload = this.update;
  }
}

const galaxyAPI = new GalaxyAPI('http://esigalactic/api/galaxyAPI.php', 'galaxy-choice', 'solar-system-choice', 'planet-display');
galaxyAPI.init();
