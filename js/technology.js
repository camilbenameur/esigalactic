
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

let arrow1 = document.getElementById('arrow-1');
let arrow2 = document.getElementById('arrow-2');
let arrow3 = document.getElementById('arrow-3');
let arrow4 = document.getElementById('arrow-4');

let display = document.getElementById('display');


function energyDisplay(energyTechnology, energyTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    let currentDeuteriumCost = Math.round(energyTechnology.deuterium_cost * Math.pow(1.5, energyTechnologyLevel));
    let currentResearchTime = Math.round(energyTechnology.research_time * Math.pow(2, energyTechnologyLevel));

    name.innerHTML = energyTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + currentDeuteriumCost;
    researchTime.innerHTML = "Research time : " + currentResearchTime;
    upgradeButton.type = "button";
    upgradeButton.name = "energy";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const response = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=energy" + "&level=" + energyTechnologyLevel);
        const data = await response.json();
        
        if (data === "success") {
            energyTechnologyLevel++;
            energyDisplay(energyTechnology, energyTechnologyLevel);
        }
        update();
    });
}

function laserDisplay(laserTechnology, laserTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    let currentDeuteriumCost = Math.round(laserTechnology.deuterium_cost * Math.pow(1.5, laserTechnologyLevel));
    let currentResearchTime = Math.round(laserTechnology.research_time * Math.pow(2, laserTechnologyLevel));

    name.innerHTML = laserTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + currentDeuteriumCost;
    researchTime.innerHTML = "Research time : " + currentResearchTime;
    upgradeButton.type = "button";
    upgradeButton.name = "laser";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const response = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=laser" + "&level=" + laserTechnologyLevel);
        const data = await response.json();

        if (data === "success") {
            laserTechnologyLevel++;
            laserDisplay(laserTechnology, laserTechnologyLevel);
        }
        update();
    });
}

function ionDisplay(ionTechnology, ionTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    let currentDeuteriumCost = Math.round(ionTechnology.deuterium_cost * Math.pow(1.5, ionTechnologyLevel));
    let currentResearchTime = Math.round(ionTechnology.research_time * Math.pow(2, ionTechnologyLevel));

    name.innerHTML = ionTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + currentDeuteriumCost;
    researchTime.innerHTML = "Research time : " + currentResearchTime;
    upgradeButton.type = "button";
    upgradeButton.name = "ion";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const response = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=ion" + "&level=" + ionTechnologyLevel);
        const data = await response.json();

        if (data === "success") {
            ionTechnologyLevel++;
            ionDisplay(ionTechnology, ionTechnologyLevel);
        }
        update();
    });
}

function shieldDisplay(shieldTechnology, shieldTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    let currentDeuteriumCost = Math.round(shieldTechnology.deuterium_cost * Math.pow(1.5, shieldTechnologyLevel));
    let currentResearchTime = Math.round(shieldTechnology.research_time * Math.pow(2, shieldTechnologyLevel));

    name.innerHTML = shieldTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + currentDeuteriumCost;
    researchTime.innerHTML = "Research time : " + currentResearchTime;
    upgradeButton.type = "button";
    upgradeButton.name = "shield";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const response = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=shield" + "&level=" + shieldTechnologyLevel);
        const data = await response.json();

        if (data === "success") {
            shieldTechnologyLevel++;
            shieldDisplay(shieldTechnology, shieldTechnologyLevel);
        }
        update();
    });
}

function weaponryDisplay(weaponryTechnology, weaponryTechnologyLevel) {
    display.innerHTML = "";
    let name = document.createElement('p');
    let metalCost = document.createElement('p');
    let deuteriumCost = document.createElement('p');
    let researchTime = document.createElement('p');
    let upgradeButton = document.createElement('input');

    let currentMetalCost = Math.round(weaponryTechnology.metal_cost * Math.pow(1.5, weaponryTechnologyLevel));
    let currentDeuteriumCost = Math.round(weaponryTechnology.deuterium_cost * Math.pow(1.5, weaponryTechnologyLevel));
    let currentResearchTime = Math.round(weaponryTechnology.research_time * Math.pow(2, weaponryTechnologyLevel));

    name.innerHTML = weaponryTechnology.name;
    metalCost.innerHTML = "Metal cost : " + currentMetalCost;
    deuteriumCost.innerHTML = "Deuterium cost : " + currentDeuteriumCost;
    researchTime.innerHTML = "Research time : " + currentResearchTime;
    upgradeButton.type = "button";
    upgradeButton.name = "weaponry";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(metalCost);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const response = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=weaponry" + "&level=" + weaponryTechnologyLevel);
        const data = await response.json();

        if (data === "success") {
            weaponryTechnologyLevel++;
            weaponryDisplay(weaponryTechnology, weaponryTechnologyLevel);
        }
        update();
    });
}


async function update() {
    updateWalletData();
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

    var energyTechnologyLevelValue = 0;
    var laserTechnologyLevelValue = 0;
    var ionTechnologyLevelValue = 0;
    var shieldTechnologyLevelValue = 0;
    var weaponryTechnologyLevelValue = 0;

    technologies.forEach(element => {
        if(element.archetype_id == 1) {
            energyTechnologyLevelValue = element.level;
        }
        else if(element.archetype_id == 2) {
            laserTechnologyLevelValue = element.level;
        }
        else if(element.archetype_id == 3) {
            ionTechnologyLevelValue = element.level;
        }
        else if(element.archetype_id == 4) {
            shieldTechnologyLevelValue = element.level;
        }
        else if(element.archetype_id == 5) {
            weaponryTechnologyLevelValue = element.level;
        }
    });
    
    energyTechnologyLevel.innerHTML = "Level : " + energyTechnologyLevelValue;
    laserTechnologyLevel.innerHTML = "Level : " + laserTechnologyLevelValue;
    ionTechnologyLevel.innerHTML = "Level : " + ionTechnologyLevelValue;
    shieldTechnologyLevel.innerHTML = "Level : " + shieldTechnologyLevelValue;
    weaponryTechnologyLevel.innerHTML = "Level : " + weaponryTechnologyLevelValue;

    energyDiv.addEventListener('click', function() {
        energyDisplay(energyTechnology, energyTechnologyLevelValue);
        energyDiv.removeEventListener('click', function() {
            energyDisplay(energyTechnology, energyTechnologyLevelValue);
        }
        );
    });

    laserDiv.addEventListener('click', function() {
        laserDisplay(laserTechnology, laserTechnologyLevelValue);
    });

    ionDiv.addEventListener('click', function() {
        ionDisplay(ionTechnology, ionTechnologyLevelValue);
    });

    shieldDiv.addEventListener('click', function() {
        shieldDisplay(shieldTechnology, shieldTechnologyLevelValue);
    });

    weaponryDiv.addEventListener('click', function() {
        weaponryDisplay(weaponryTechnology, weaponryTechnologyLevelValue);
    });

    if(energyTechnologyLevelValue == 0) {
        energyDiv.className = "technology blocked";
    }  else {
        energyDiv.className = "technology researched";
    }
    if(energyTechnologyLevelValue >= 5) {
        arrow1.src = "../images/research-lab/arrow-green.png";
    } 
    if(energyTechnologyLevelValue >= 8) {
        arrow4.src = "../images/research-lab/arrow-green.png";    
    }
      

    if(laserTechnologyLevelValue == 0) {
        laserDiv.className = "technology blocked";
    } else {
        laserDiv.className = "technology researched";
    }
    if (laserTechnologyLevelValue >= 5) {
        arrow2.src = "../images/research-lab/arrow-green.png";
    } 
    

    if(ionTechnologyLevelValue == 0) {
        ionDiv.className = "technology blocked";
    } else {
        ionDiv.className = "technology researched";
    }
    if(ionTechnologyLevelValue >= 2) {
        arrow3.src = "../images/research-lab/arrow-green.png";
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

let metalDisplay = document.getElementById('metal-display');
let deuteriumDisplay = document.getElementById('deuterium-display');
let energyDisplayD = document.getElementById('energy-display');

async function updateWalletData() {
    const walletAnswer = await fetch('http://esigalactic/api/walletAPI.php');
    const walletData = await walletAnswer.json();
    
    const metal = walletData[0].metal;
    const deuterium = walletData[0].deuterium;
    const energy = walletData[0].energy;

    metalDisplay.innerHTML = "Metal : " + metal;
    deuteriumDisplay.innerHTML = "Deuterium : " + deuterium;
    energyDisplayD.innerHTML = "Energy : " + energy;
}

window.onload = update();