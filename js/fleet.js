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
      })

      this.displayPlanetInformation();
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
                this.planetDisplay.innerText = element.name + " owner : " + element.player_id;
              }
              
            })
          });
      } else {
        this.planetDisplay.innerHTML = 'no selected planet';
      }
    }
  
    init() {
      this.update();
    }
  }
  
  const fleetAPI = new FleetAPI('http://esigalactic/api/galaxyAPI.php','http://esigalactic/api/ship-displayAPI.php', 'galaxy-choice', 'solar-system-choice', 'planet-choice', 'planet-info');
  fleetAPI.init();
  




