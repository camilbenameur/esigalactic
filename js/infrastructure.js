function handleArchetypeChange(radio) {
    let selectedValue = radio.value;
    update(selectedValue);
}

function build(selectedArchetypeId) {
    console.log("Build");
}

function upgrade(selectedArchetypeId) {
    console.log("Upgrade");
}

let url = 'http://esigalactic/api/infrastructure-displayAPI.php';
let facilityDisplay = document.getElementById('facility-display');
console.log(facilityDisplay);

async function fetchWalletData() {
    const walletAnswer = await fetch('http://esigalactic/api/walletAPI.php');
    const walletData = await walletAnswer.json();
    
    const metal = walletData[0].metal;
    const deuterium = walletData[0].deuterium;
    const energy = walletData[0].energy;
}


async function update(selectedValue) {
    const archetypeId = selectedValue
    console.log("Archetype ID : " + archetypeId);
    facilityDisplay.innerHTML = '';
    const answer = await fetch(url + '?archetype-choice=' + archetypeId);
    const data = await answer.json();

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

    if(level == 0) {
        const buildButton = document.createElement('button');
        buildButton.innerHTML = "BUILD";
        buildButton.addEventListener('click', function() {
            build(archetypeId);
        });
        facilityDisplay.appendChild(buildButton);
    }
    else {
        const upgradeButton = document.createElement('button');
        upgradeButton.innerHTML = "UPGRADE";
        upgradeButton.addEventListener('click', function() {
            upgrade(archetypeId);
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