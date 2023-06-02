function handleArchetypeChange(radio) {
    let selectedValue = radio.value;
    update(selectedValue);
}

async function enhanceInfrastructure(selectedArchetypeId, level) {
    fetch('http://esigalactic/api/infrastructure-buildAPI.php?archetype-choice=' + selectedArchetypeId + '&infrastructure-level=' + level);
    update(selectedArchetypeId);
}

let url = 'http://esigalactic/api/infrastructure-displayAPI.php';
let facilityDisplay = document.getElementById('facility-display');
let infrastructurePicture = document.getElementById('infrastructure-pic');
let metalDisplay = document.getElementById('metal-display');
let deuteriumDisplay = document.getElementById('deuterium-display');
let energyDisplay = document.getElementById('energy-display');

async function updateWalletData() {
    const walletAnswer = await fetch('http://esigalactic/api/walletAPI.php');
    const walletData = await walletAnswer.json();

    console.log(walletData);
    
    const metal = walletData[0].metal;
    const deuterium = walletData[0].deuterium;
    const energy = walletData[0].energy;

    metalDisplay.innerHTML = "Metal : " + metal;
    deuteriumDisplay.innerHTML = "Deuterium : " + deuterium;
    energyDisplay.innerHTML = "Energy : " + energy;
}


async function update(selectedValue) {
    updateWalletData();
    const archetypeId = selectedValue
    facilityDisplay.innerHTML = '';
    const answer = await fetch(url + '?archetype-choice=' + archetypeId);
    const data = await answer.json();
    console.log(data);

    if(data.infrastructure[0] == undefined) {
        var level = 0;
    } else {
        var level = data.infrastructure[0].level;
    }

    const infrastructureArchetype = data.infrastructureArchetype.archetype;
    const name = infrastructureArchetype.name;
    let building_time = infrastructureArchetype.building_time;
    let energy_cost = infrastructureArchetype.energy_cost;
    let metal_cost = infrastructureArchetype.metal_cost;
    let deuterium_cost = infrastructureArchetype.deuterium_cost;

    building_time *= Math.pow(2, level);

    energy_cost *= Math.pow(1.6, level);
    metal_cost *= Math.pow(1.6, level);
    deuterium_cost *= Math.pow(1.6, level);

    energy_cost = Math.round(energy_cost);
    metal_cost = Math.round(metal_cost);
    deuterium_cost = Math.round(deuterium_cost);

    const infrastructureName = document.createElement('p');
    const infrastructureLevel = document.createElement('p');
    const infrastructureMetalCost = document.createElement('p');
    const infrastructureDeuteriumCost = document.createElement('p');
    const infrastructureEnergyCost = document.createElement('p');
    const infrastructureBuildingTime = document.createElement('p');

    infrastructureName.innerHTML = name;
    infrastructureLevel.innerHTML = "Level : " + level;
    infrastructureMetalCost.innerHTML = "Metal Cost : " + metal_cost;
    infrastructureDeuteriumCost.innerHTML = "Deuterium Cost : " + deuterium_cost;
    infrastructureEnergyCost.innerHTML = "Energy Cost : " + energy_cost;
    infrastructureBuildingTime.innerHTML = "Building Time : " + building_time + " sec";

    facilityDisplay.appendChild(infrastructureName);
    facilityDisplay.appendChild(infrastructureLevel);
    facilityDisplay.appendChild(infrastructureMetalCost);
    facilityDisplay.appendChild(infrastructureDeuteriumCost);
    facilityDisplay.appendChild(infrastructureEnergyCost);
    facilityDisplay.appendChild(infrastructureBuildingTime);

    const defenceArchetype = data.infrastructureArchetype.defence;
    const resourceArchetype = data.infrastructureArchetype.resource;
    const facilityArchetype = data.infrastructureArchetype.facility;

    if(defenceArchetype != null) {
        let attackValue = defenceArchetype[0].offence_value;
        let defenceValue = defenceArchetype[0].defence_value;    
        const defenceValueDisplay = document.createElement('p');
        const attackValueDisplay = document.createElement('p');

        switch(infrastructureArchetype.name) {
            case "Laser artillery":
                infrastructurePicture.src = "../images/infrastructures/laser.jpg";
                attackValue *= Math.pow(1.05, level);
                break;
            case "Ion cannon":
                infrastructurePicture.src = "../images/infrastructures/artillery.jpg";
                attackValue *= Math.pow(1.05, level);
                break;
            case "Shield":
                infrastructurePicture.src = "../images/infrastructures/shield.jpg";
                defenceValue *= Math.pow(1.3, level);
                break;
            default:
                break;
        }
        attackValue = Math.round(attackValue);
        defenceValue = Math.round(defenceValue);
        attackValueDisplay.innerHTML = "Attack Value : " + attackValue;
        defenceValueDisplay.innerHTML = "Defence Value : " + defenceValue;
        facilityDisplay.appendChild(attackValueDisplay);
        facilityDisplay.appendChild(defenceValueDisplay);
    }
    else if(resourceArchetype != null) {
        let productionRate = resourceArchetype[0].production_rate;
        const productionRateDisplay = document.createElement('p');
        switch(infrastructureArchetype.name) {
            case "Metal mine":
                infrastructurePicture.src = "../images/infrastructures/metal-mine.jpg";
                productionRate *= Math.pow(1.5, level);
                break;
            case "Deuterium synthesizer":
                infrastructurePicture.src = "../images/infrastructures/deuterium.jpg";
                productionRate *= Math.pow(1.3, level);
                break;
            case "Solar plant":
                infrastructurePicture.src = "../images/infrastructures/solar-plant.jpg";
                productionRate *= Math.pow(1.4, level);
                break;
            case "Fusion plant":
                infrastructurePicture.src = "../images/infrastructures/solar-fusion.jpg";
                productionRate *= Math.pow(2, level);
            default:
                break;   
        }
        productionRate = Math.round(productionRate);
        productionRateDisplay.innerHTML = "Production Rate : " + productionRate;
        facilityDisplay.appendChild(productionRateDisplay);
    }
    else if(facilityArchetype != null) {
        switch(infrastructureArchetype.name) {
            case "Research lab":
                infrastructurePicture.src = "../images/infrastructures/lab.jpg";
                break;
            case "Shipyard":
                infrastructurePicture.src = "../images/infrastructures/shipyard.jpg";
                break;
            case "Nanite factory":
                infrastructurePicture.src = "../images/infrastructures/nanite-factory.jpg";
                break;
            default:
                break;
        }
    }
    if (level == 0) {
        const buildButton = document.createElement('button');
        buildButton.innerHTML = "BUILD";
        buildButton.addEventListener('click', function () {
          showModalAndStartTimer(archetypeId, level);
        });
        facilityDisplay.appendChild(buildButton);
      } else {
        const upgradeButton = document.createElement('button');
        upgradeButton.innerHTML = "UPGRADE";
        upgradeButton.addEventListener('click', function () {
          showModalAndStartTimer(archetypeId, level);
        });
        facilityDisplay.appendChild(upgradeButton);
      }
      function showModalAndStartTimer(archetypeId, level) {
        const modal = document.getElementById('upgradeModal');
        modal.style.display = 'block';
        const countdownTimer = document.getElementById('countdownTimer');
        countdownTimer.textContent = building_time;
        const timerDuration = building_time * 1000;
        let remainingTime = timerDuration;
        const countdownInterval = 1000; // 1 second
        const timerInterval = setInterval(function () {
          remainingTime -= countdownInterval;
          const seconds = Math.ceil(remainingTime / 1000);
          countdownTimer.textContent = seconds;
          if (remainingTime <= 0) {
            clearInterval(timerInterval);
            modal.style.display = 'none';
            enhanceInfrastructure(archetypeId, level);
            }
        }, countdownInterval);
      
        const closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', function () {
          clearInterval(timerInterval);
          modal.style.display = 'none';
        });
    }
}

const radioButtons = document.querySelectorAll('input[name="archetype-choice"]');
radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        handleArchetypeChange(this);
    });
});

window.onload = update(1);