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

    const infrastructureArchetype = data.infrastructureArchetype.archetype;
    const name = infrastructureArchetype.name;
    const building_time = infrastructureArchetype.building_time;
    const energy_cost = infrastructureArchetype.energy_cost;
    const metal_cost = infrastructureArchetype.metal_cost;
    const deuterium_cost = infrastructureArchetype.deuterium_cost;

    if(data.infrastructure[0] == undefined) {
        var level = 0;
    } else {
        var level = data.infrastructure[0].level;
    }

    const infrastructureName = document.createElement('p');
    infrastructureName.innerHTML = name;
    const infrastructureLevel = document.createElement('p');
    infrastructureLevel.innerHTML = "Level : " + level;
    const infrastructureMetalCost = document.createElement('p');
    infrastructureMetalCost.innerHTML = "Metal Cost : " + metal_cost;
    const infrastructureDeuteriumCost = document.createElement('p');
    infrastructureDeuteriumCost.innerHTML = "Deuterium Cost : " + deuterium_cost;
    const infrastructureEnergyCost = document.createElement('p');
    infrastructureEnergyCost.innerHTML = "Energy Cost : " + energy_cost;
    const infrastructureBuildingTime = document.createElement('p');
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

    console.log(infrastructurePicture);

    if(defenceArchetype != null) {
        const attackValue = defenceArchetype[0].offence_value;
        const defenceValue = defenceArchetype[0].defence_value;    
        const defenceValueDisplay = document.createElement('p');
        defenceValueDisplay.innerHTML = "Defence Value : " + defenceValue;
        facilityDisplay.appendChild(defenceValueDisplay);

        const attackValueDisplay = document.createElement('p');
        attackValueDisplay.innerHTML = "Attack Value : " + attackValue;
        facilityDisplay.appendChild(attackValueDisplay);

        infrastructurePicture.src = "../images/infrastructures/artillery.jpg";

    }
    else if(resourceArchetype != null) {
        const productionRate = resourceArchetype[0].production_rate;
        const productionRateDisplay = document.createElement('p');
        productionRateDisplay.innerHTML = "Production Rate : " + productionRate;
        facilityDisplay.appendChild(productionRateDisplay);

        infrastructurePicture.src = "../images/infrastructures/lab.jpg";

    }
    else if(facilityArchetype != null) {
        infrastructurePicture.src = "../images/infrastructures/lab.jpg";
    }

    if(level == 0) {
        const buildButton = document.createElement('button');
        buildButton.innerHTML = "BUILD";
        buildButton.addEventListener('click', function() {
            enhanceInfrastructure(archetypeId, level);
        });
        facilityDisplay.appendChild(buildButton);
    }
    else {
        const upgradeButton = document.createElement('button');
        upgradeButton.innerHTML = "UPGRADE";
        upgradeButton.addEventListener('click', function() {
            enhanceInfrastructure(archetypeId, level);
        });
        facilityDisplay.appendChild(upgradeButton);
    }
}

const radioButtons = document.querySelectorAll('input[name="archetype-choice"]');
radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        handleArchetypeChange(this);
    });
});

window.onload = update(1);