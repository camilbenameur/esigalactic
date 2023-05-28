
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

  
    energyTechnology.research_time *= Math.pow(2, energyTechnologyLevel);  
    energyTechnology.deuterium_cost *= Math.pow(1.5, energyTechnologyLevel);

    energyTechnology.research_time = Math.round(energyTechnology.research_time);
    energyTechnology.deuterium_cost = Math.round(energyTechnology.deuterium_cost);

    name.innerHTML = energyTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + energyTechnology.deuterium_cost;
    researchTime.innerHTML = "Research time : " + energyTechnology.research_time;
    upgradeButton.type = "button";
    upgradeButton.name = "energy";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const answ = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=energy" + "&level=" + energyTechnologyLevel)
        const data = await answ.json();
        
        if(data == "success") {
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

    laserTechnology.deuterium_cost *= Math.pow(1.5, laserTechnologyLevel);
    laserTechnology.research_time *= Math.pow(2, laserTechnologyLevel);

    laserTechnology.deuterium_cost = Math.round(laserTechnology.deuterium_cost);
    laserTechnology.research_time = Math.round(laserTechnology.research_time);

    name.innerHTML = laserTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + laserTechnology.deuterium_cost;
    researchTime.innerHTML = "Research time : " + laserTechnology.research_time;
    upgradeButton.type = "button";
    upgradeButton.name = "laser";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const answ = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=laser" + "&level=" + laserTechnologyLevel)
        const data = await answ.json();

        if(data == "success") {
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

    ionTechnology.deuterium_cost *= Math.pow(1.5, ionTechnologyLevel);
    ionTechnology.research_time *= Math.pow(2, ionTechnologyLevel);

    ionTechnology.deuterium_cost = Math.round(ionTechnology.deuterium_cost);
    ionTechnology.research_time = Math.round(ionTechnology.research_time);

    name.innerHTML = ionTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + ionTechnology.deuterium_cost;
    researchTime.innerHTML = "Research time : " + ionTechnology.research_time;
    upgradeButton.type = "button";
    upgradeButton.name = "ion";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const answ = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=ion" + "&level=" + ionTechnologyLevel)
        const data = await answ.json();

        if(data == "success") {
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

    shieldTechnology.deuterium_cost *= Math.pow(1.5, shieldTechnologyLevel);
    shieldTechnology.research_time *= Math.pow(2, shieldTechnologyLevel);

    shieldTechnology.deuterium_cost = Math.round(shieldTechnology.deuterium_cost);
    shieldTechnology.research_time = Math.round(shieldTechnology.research_time);

    name.innerHTML = shieldTechnology.name;
    deuteriumCost.innerHTML = "Deuterium cost : " + shieldTechnology.deuterium_cost;
    researchTime.innerHTML = "Research time : " + shieldTechnology.research_time;
    upgradeButton.type = "button";
    upgradeButton.name = "shield";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const answ = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=shield" + "&level=" + shieldTechnologyLevel)
        const data = await answ.json();

        if(data == "success") {
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

    weaponryTechnology.metal_cost *= Math.pow(1.5, weaponryTechnologyLevel);
    weaponryTechnology.deuterium_cost *= Math.pow(1.5, weaponryTechnologyLevel);
    weaponryTechnology.research_time *= Math.pow(2, weaponryTechnologyLevel);

    weaponryTechnology.research_time = Math.round(weaponryTechnology.research_time);
    weaponryTechnology.metal_cost = Math.round(weaponryTechnology.metal_cost);
    weaponryTechnology.deuterium_cost = Math.round(weaponryTechnology.deuterium_cost);

    name.innerHTML = weaponryTechnology.name;
    metalCost.innerHTML = "Metal cost : " + weaponryTechnology.metal_cost;
    deuteriumCost.innerHTML = "Deuterium cost : " + weaponryTechnology.deuterium_cost;
    researchTime.innerHTML = "Research time : " + weaponryTechnology.research_time;
    upgradeButton.type = "button";
    upgradeButton.name = "weaponry";
    upgradeButton.value = "upgrade";

    display.appendChild(name);
    display.appendChild(metalCost);
    display.appendChild(deuteriumCost);
    display.appendChild(researchTime);
    display.appendChild(upgradeButton);

    upgradeButton.addEventListener('click', async function() {
        const answ = await fetch("http://esigalactic/api/technologies-upgradeAPI.php?technology=weaponry" + "&level=" + weaponryTechnologyLevel)
        const data = await answ.json();
        console.log(data);

        if(data == "success"){
            weaponryTechnologyLevel++;
            weaponryDisplay(weaponryTechnology, weaponryTechnologyLevel);
        }
        update();
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
    } else {
        energyDiv.className = "technology researched";
        arrow1.src = "../images/research-lab/arrow-green.jpg";
        arrow4.src = "../images/research-lab/arrow-green.jpg";        
    }

    if(laserTechnologyLevelValue == 0) {
        laserDiv.className = "technology blocked";
    } else {
        laserDiv.className = "technology researched";
        arrow2.src = "../images/research-lab/arrow-green.jpg";
    }

    if(ionTechnologyLevelValue == 0) {
        ionDiv.className = "technology blocked";
    } else {
        ionDiv.className = "technology researched";
        arrow3.src = "../images/research-lab/arrow-green.jpg";
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