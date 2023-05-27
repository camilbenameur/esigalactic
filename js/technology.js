
let energyTechnologyLevel = document.getElementById('energy-tech-level');
let laserTechnologyLevel = document.getElementById('laser-tech-level');
let ionTechnologyLevel = document.getElementById('ion-tech-level');
let shieldTechnologyLevel = document.getElementById('shield-tech-level');
let weaponryTechnologyLevel = document.getElementById('weaponry-tech-level');

let energyDiv = document.getElementById('energy');
let laserDiv = document.getElementById('laser');
let ionDiv = document.getElementById('ion');
let shieldDiv = document.getElementById('shield');
let weaponryDiv = document.getElementById('weaponry');

let display = document.getElementById('display');


function energyDisplay(energyTechnology, energyTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let metalCost = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    name.innerHTML = energyTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + energyTechnology.deuterium_cost * Math.pow(1.5, energyTechnologyLevel.innerHTML.split(" ")[2]);
    researchTime.innerHTML = "Research time : " + energyTechnology.research_time * Math.pow(2, energyTechnologyLevel.innerHTML.split(" ")[2]);
    upgradeButton.type = "button";
    upgradeButton.name = "energy";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', function() {
        fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=energy")
        .then(response => response.json())
        .then(data => console.log(data));
    });
}

function laserDisplay(laserTechnology, laserTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    name.innerHTML = laserTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + laserTechnology.deuterium_cost * Math.pow(1.5, laserTechnologyLevel.innerHTML.split(" ")[2]);
    researchTime.innerHTML = "Research time : " + laserTechnology.research_time * Math.pow(2, laserTechnologyLevel.innerHTML.split(" ")[2]);
    upgradeButton.type = "button";
    upgradeButton.name = "laser";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', function() {
        fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=laser")
        .then(response => response.json())
        .then(data => console.log(data));
    });
}

function ionDisplay(ionTechnology, ionTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    name.innerHTML = ionTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + ionTechnology.deuterium_cost * Math.pow(1.5, ionTechnologyLevel.innerHTML.split(" ")[2]);
    researchTime.innerHTML = "Research time : " + ionTechnology.research_time * Math.pow(2, ionTechnologyLevel.innerHTML.split(" ")[2]);
    upgradeButton.type = "button";
    upgradeButton.name = "ion";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', function() {
        fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=ion")
        .then(response => response.json())
        .then(data => console.log(data));
    });
}

function shieldDisplay(shieldTechnology, shieldTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    name.innerHTML = shieldTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + shieldTechnology.deuterium_cost * Math.pow(1.5, shieldTechnologyLevel.innerHTML.split(" ")[2]);
    researchTime.innerHTML = "Research time : " + shieldTechnology.research_time * Math.pow(2, shieldTechnologyLevel.innerHTML.split(" ")[2]);
    upgradeButton.type = "button";
    upgradeButton.name = "shield";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', function() {
        fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=shield")
        .then(response => response.json())
        .then(data => console.log(data));
    });
}

function weaponryDisplay(weaponryTechnology, weaponryTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let metalCost = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    name.innerHTML = weaponryTechnology.name;
    metalCost.innerHTML = "Metal cost : " + weaponryTechnology.metal_cost * Math.pow(1.5, weaponryTechnologyLevel.innerHTML.split(" ")[2]);
    deuteriumCost.innerHTML = "Deuterium cost : " + weaponryTechnology.deuterium_cost * Math.pow(1.5, weaponryTechnologyLevel.innerHTML.split(" ")[2]);
    researchTime.innerHTML = "Research time : " + weaponryTechnology.research_time * Math.pow(2, weaponryTechnologyLevel.innerHTML.split(" ")[2]);
    upgradeButton.type = "button";
    upgradeButton.name = "weaponry";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(metalCost);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', function() {
        fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=weaponry")
        .then(response => response.json())
        .then(data => console.log(data));
    });
}


async function update() {
    const answ = await fetch("http://esigalactic/api/technologies-displayAPI.php");
    const data = await answ.json();
    console.log(data);

    const technologies = data.technology;
    const technologiesArchetype = data.technology_archetype;

    var energyTechnology = technologiesArchetype[0];
    var laserTechnology = technologiesArchetype[1];
    var ionTechnology = technologiesArchetype[2];
    var shieldTechnology = technologiesArchetype[3];
    var weaponryTechnology = technologiesArchetype[4];

    energyDiv.addEventListener('click', function() {
        energyDisplay(energyTechnology, energyTechnologyLevel);
    });

    laserDiv.addEventListener('click', function() {
        laserDisplay(laserTechnology, laserTechnologyLevel);
    });

    ionDiv.addEventListener('click', function() {
        ionDisplay(ionTechnology, ionTechnologyLevel);
    });

    shieldDiv.addEventListener('click', function() {
        shieldDisplay(shieldTechnology, shieldTechnologyLevel);
    });

    weaponryDiv.addEventListener('click', function() {
        weaponryDisplay(weaponryTechnology, weaponryTechnologyLevel);
    });

    const technologyLevels = [0, 0, 0, 0, 0];

    for (let i = 0; i < technologies.length; i++) {
      if (technologies[i] !== undefined) {
        technologyLevels[i] = technologies[i].level;
      }
    }
    
    const [
      energyTechnologyLevelValue,
      laserTechnologyLevelValue,
      ionTechnologyLevelValue,
      shieldTechnologyLevelValue,
      weaponryTechnologyLevelValue,
    ] = technologyLevels;
    
    energyTechnologyLevel.innerHTML = "Level : " + energyTechnologyLevelValue;
    laserTechnologyLevel.innerHTML = "Level : " + laserTechnologyLevelValue;
    ionTechnologyLevel.innerHTML = "Level : " + ionTechnologyLevelValue;
    shieldTechnologyLevel.innerHTML = "Level : " + shieldTechnologyLevelValue;
    weaponryTechnologyLevel.innerHTML = "Level : " + weaponryTechnologyLevelValue;

    if(energyTechnologyLevelValue == 0) {
        energyDiv.className = "technology blocked";
    } else {
        energyDiv.className = "technology researched";
    }

    if(laserTechnologyLevelValue == 0) {
        laserDiv.className = "technology blocked";
    } else {
        laserDiv.className = "technology researched";
    }

    if(ionTechnologyLevelValue == 0) {
        ionDiv.className = "technology blocked";
    } else {
        ionDiv.className = "technology researched";
    }

    if(shieldTechnologyLevelValue == 0) {
        shieldDiv.className = "technology blocked";
    } else {
        shieldDiv.className = "technology researched";
    }

    if(weaponryTechnologyLevelValue == 0) {
        weaponryDiv.className = "technology blocked";
    } else {
        weaponryDiv.className = "technology researched";
    }

}

window.onload = update();