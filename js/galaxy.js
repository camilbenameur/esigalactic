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
      const fetchPromises = data.map(element => {
        if (element.player_id) {
          return fetch('http://esigalactic/api/player-information.php' + '?player-id=' + element.player_id)
            .then(response => response.json())
            .then(playerData => {
              console.log(playerData);
              const playerName = playerData.name;
              let planet = document.createElement('p');
              planet.id = 'planet-' + element.id;
              planet.classList.add('planet');
              planet.innerHTML = '<span>' + element.name + '</span><span>' + "Position : " + element.position + '</span><span>' + "Owner : " + playerName + '</span>';
              return planet;
            });
        } else {
          let planet = document.createElement('p');
          planet.id = 'planet-' + element.id;
          planet.classList.add('planet');
          planet.innerHTML = '<span>' + element.name + '</span><span>' + "Position : " + element.position + '</span><span>' + "Owner : None" + '</span>';
          return Promise.resolve(planet);
        }
      });
  
      Promise.all(fetchPromises)
        .then(planets => {
          planets.forEach(planet => {
            this.planetDisplay.appendChild(planet);
          });
        });
    });
  } 
  
  init() {
    window.onload = this.update;
    this.planetDisplay.addEventListener('click', event => {
      const target = event.target;
      if (target.classList.contains('planet')) {
        const planetId = target.id.split('-')[1];
        fetch('http://esigalactic/api/planet-choice.php?planet-choice=' + planetId)
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              window.location.href = 'http://esigalactic/front/portal.php';
            } else {
              this.showError("You don't own this planet");
            }
          });
      }
    });
  }
  
  showError(message) {
    const errorElement = document.createElement('div');
    errorElement.classList.add('error-message');
    errorElement.textContent = message;
    document.body.appendChild(errorElement);
  
    setTimeout(() => {
      errorElement.classList.add('hide');
  
      setTimeout(() => {
        document.body.removeChild(errorElement);
      }, 300); 
    }, 3000);
  }
}

const galaxyAPI = new GalaxyAPI('http://esigalactic/api/galaxyAPI.php', 'galaxy-choice', 'solar-system-choice', 'planet-display');
galaxyAPI.init();

