class FleetAPI {
    constructor(url, url2, galaxyChoiceId, solarSystemChoiceId, planetChoiceId, planetDisplayId) {
      this.url = url;
      this.url2 = url2;
      this.galaxyChoice = document.getElementById(galaxyChoiceId);
      this.solarSystemChoice = document.getElementById(solarSystemChoiceId);
      this.planetChoice = document.getElementById(planetChoiceId);
      this.planetDisplay = document.getElementById(planetDisplayId);
  
      this.update = this.update.bind(this);
      this.solarSystemChoice.addEventListener('change', this.update);
      this.galaxyChoice.addEventListener('change', this.update);

      this.fighterQuantityDisplay = document.getElementById('fighterNbr');
      this.cruiserQuantityDisplay = document.getElementById('cruiserNbr');
      this.transporterQuantityDisplay = document.getElementById('transporterNbr');
      this.coloniserQuantityDisplay = document.getElementById('colonizationNbr');

      this.fighterInpt = document.getElementById("fighter-inpt");
      this.cruiserInpt = document.getElementById("cruiser-inpt");
      this.transporterInpt = document.getElementById("transporter-inpt");
      this.colonizationInpt = document.getElementById("colonization-inpt");


      this.attackStats = document.getElementById("attack-stats");
      this.defStats = document.getElementById("def-stats");
      this.fretStats = document.getElementById("fret-stats");



      this.planetChoice.addEventListener('change', this.displayPlanetInformation.bind(this));
    }
  
    async fetchData() {
      this.planetChoice.innerHTML = '';
      const galaxyId = this.galaxyChoice.value;
      const solarSystemId = this.solarSystemChoice.value;
      const response = await fetch(`${this.url}?galaxy-choice=${galaxyId}&solar-system-choice=${solarSystemId}`);
      const data = await response.json();
      return data;
    }

    async fetchShipInformation() {
      const response = await fetch(this.url2);
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

      this.fetchShipInformation().then(data => {
        console.log(data);
        const ships = data.ships;
        let fighterQuantity = 0;
        let cruiserQuantity = 0;
        let transporterQuantity = 0;
        let coloniserQuantity = 0;
    
        ships.forEach(element => {
            if(element.archetype_id == 1) {
                fighterQuantity += parseInt(element.amount);
            }
            else if(element.archetype_id == 2) {
                cruiserQuantity += parseInt(element.amount);
            }
            else if(element.archetype_id == 3) {
                transporterQuantity += parseInt(element.amount);
            }
            else if(element.archetype_id == 4) {
                coloniserQuantity += parseInt(element.amount);
            }
        });
    
    
        this.fighterQuantityDisplay.innerText = "fighter : " + fighterQuantity;
        this.cruiserQuantityDisplay.innerHTML = "cruiser : " + cruiserQuantity;
        this.transporterQuantityDisplay.innerHTML = "transporter : " + transporterQuantity;
        this.coloniserQuantityDisplay.innerHTML = "colonization ship : " + coloniserQuantity;


        //set initial value of inputs to 0
        this.fighterInpt.value = 0;
        this.cruiserInpt.value = 0;
        this.transporterInpt.value = 0;
        this.colonizationInpt.value = 0;

        //max value for input type 'number'

        this.fighterInpt.addEventListener("input", () =>{
          if(parseInt(this.fighterInpt.value) > fighterQuantity){
            this.fighterInpt.value = fighterQuantity;
          }
        });

        this.cruiserInpt.addEventListener("input", () => {
          if(parseInt(this.cruiserInpt.value) > cruiserQuantity){
            this.cruiserInpt.value = cruiserQuantity;
          }
        });

        this.transporterInpt.addEventListener("input", () => {
          if(parseInt(this.transporterInpt.value) > transporterQuantity){
            this.transporterInpt.value = transporterQuantity;
          }
        });

        this.colonizationInpt.addEventListener("input", () => {
          if(parseInt(this.colonizationInpt.value) > coloniserQuantity){
            this.colonizationInpt.value = coloniserQuantity;
          }
        });


        console.log(this.fighterInpt.value);


      })

    

      this.displayPlanetInformation();

      //display statistics called every second
      setInterval(this.displayStatistics.bind(this), 1000);
    }



    displayPlanetInformation() {
      const selectedPlanet = this.planetChoice.value;
  
      if (selectedPlanet) {
        // Faire une requête à l'API pour obtenir les informations de la planète sélectionnée
        fetch(`${this.url}?galaxy-choice=${this.galaxyChoice.value}&solar-system-choice=${this.solarSystemChoice.value}&planet-choice=${selectedPlanet}`)
          .then(response => response.json())
          .then(data => {
            console.log(data);
            // Afficher les informations de la planète dans le div planetDisplay
            console.log(selectedPlanet);
            data.forEach(element =>{
              if(selectedPlanet===element.name){
                //refresh inner html
                this.planetDisplay.innerHTML = "";

                //create <p> elements
                const planetName = document.createElement('p');
                const planetOwner = document.createElement('p');
                const planetAttack = document.createElement('p');
                const planetDef = document.createElement('p');
                const planetMetal = document.createElement('p');
                const planetDeuterium = document.createElement('p');

                planetName.textContent = element.name;
                planetOwner.textContent = "owner : " + element.player_id;
                planetAttack.textContent = "Attack points : ";
                planetDef.textContent = "Defense points : ";
                planetMetal.textContent = "Metal : ";
                planetDeuterium.textContent = "Deuterium: ";

                //append childs
                this.planetDisplay.appendChild(planetName);
                this.planetDisplay.appendChild(planetOwner);
                this.planetDisplay.appendChild(planetAttack);
                this.planetDisplay.appendChild(planetDef);
                this.planetDisplay.appendChild(planetMetal);
                this.planetDisplay.appendChild(planetDeuterium);
              }
              
            })
          });
      } else {
        this.planetDisplay.innerHTML = 'no selected planet';
      }
    }

    displayStatistics() {
      var attackPts = 0;
      var defPts = 0;
      var fretPts = 0;

      //work out statistics
      attackPts = this.fighterInpt.value*75 + this.cruiserInpt.value*400;
      defPts = this.fighterInpt.value*50 + this.cruiserInpt.value*150 + this.transporterInpt.value*50 + this.colonizationInpt.value*50;
      fretPts = this.transporterInpt.value*100000;

      //display statistics
      this.attackStats.innerText = "attack points : " + attackPts;
      this.defStats.innerText = "Defense points : " + defPts;
      this.fretStats.innerText = "Fret capacity : " + fretPts;
    }
  
    init() {
      this.update();
    }
}
  
const fleetAPI = new FleetAPI('http://esigalactic/api/galaxyAPI.php','http://esigalactic/api/ship-displayAPI.php', 'galaxy-choice', 'solar-system-choice', 'planet-choice', 'planet-info');
fleetAPI.init();


async function getShips() {
  const response = await fetch('http://esigalactic/api/ship-displayAPI.php');
  const data = await response.json();
  console.log(data);
}

async function getInfrastructures() {
  const response = await fetch('http://esigalactic/api/infrastructure-displayAPI.php?archetype-choice=8');
  const laserArtillery = await response.json();

  const response2 = await fetch('http://esigalactic/api/infrastructure-displayAPI.php?archetype-choice=9');
  const ionCannon = await response2.json();

  const response3 = await fetch('http://esigalactic/api/infrastructure-displayAPI.php?archetype-choice=10');
  const shield = await response3.json();

  console.log(laserArtillery);


  if(laserArtillery.infrastructure[0] != undefined){
    var laserArtilleryLevel = laserArtillery.infrastructure[0].level;
    var laserDefaultOffenseValue = laserArtillery.infrastructureArchetype.defence[0].offence_value;
    var laserDefaultDefenseValue = laserArtillery.infrastructureArchetype.defence[0].defence_value;
  } else {
    var laserArtilleryLevel = 0;
  }

  if(ionCannon.infrastructure[0].level != undefined){
    var ionCannonLevel = ionCannon.infrastructure[0].level;
    var ionDefaultOffenseValue = ionCannon.infrastructureArchetype.defence[0].offence_value;
    var ionDefaultDefenseValue = ionCannon.infrastructureArchetype.defence[0].defence_value;
  } else {
    var ionCannonLevel = 0;
  }

  if(shield.infrastructure[0].level != undefined){
    var shieldLevel = shield.infrastructure[0].level;
  } else {
    var shieldLevel = 0;
  }


  const shieldDefaultDefenseValue = shield.defence[0].defence_value;

  const laserOffenseValue = Math.round(laserDefaultOffenseValue * Math.pow(1.05, laserArtilleryLevel));
  const ionOffenseValue = Math.round(ionDefaultOffenseValue * Math.pow(1.05, ionCannonLevel));

  const shieldDefenseValue = Math.round(shieldDefaultDefenseValue * Math.pow(1.3, shieldLevel));

  const offenseValue = laserOffenseValue + ionOffenseValue;
  const defenseValue = laserDefaultDefenseValue + ionDefaultDefenseValue + shieldDefenseValue;

  console.log(offenseValue);
  console.log(defenseValue);
}


// getShips();
// getInfrastructures();
