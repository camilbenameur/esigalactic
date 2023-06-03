const url = 'http://esigalactic/api/ship-displayAPI.php';


let metalDisplay = document.getElementById('metal-display');
let deuteriumDisplay = document.getElementById('deuterium-display');
let energyDisplayD = document.getElementById('energy-display');

let fighterQuantityDisplay = document.getElementById('fighter-quantity');
let cruiserQuantityDisplay = document.getElementById('cruiser-quantity');
let transporterQuantityDisplay = document.getElementById('transporter-quantity');
let coloniserQuantityDisplay = document.getElementById('coloniser-quantity');

let buildButtons = document.querySelectorAll('input[type="submit"]');
let buildButtonsArray = Array.from(buildButtons);

buildButtonsArray.forEach((element, index) => {
    element.addEventListener('click', () => {
        const time = parseInt(element.dataset.time);
        let defaultTime = time;
        let currentTime = time;
        element.disabled = true;

        const countdown = setInterval(() => {
            currentTime--;
            element.value = `Build : ${currentTime} s`;

            if (currentTime === 0) {
                clearInterval(countdown);
                element.disabled = false;

                switch (index) {
                    case 0:
                        fetch('http://esigalactic/api/ship-buildAPI.php?archetype-choice=1');
                        break;
                    case 1:
                        fetch('http://esigalactic/api/ship-buildAPI.php?archetype-choice=2');
                        break;
                    case 2:
                        fetch('http://esigalactic/api/ship-buildAPI.php?archetype-choice=3');
                        break;
                    case 3:
                        fetch('http://esigalactic/api/ship-buildAPI.php?archetype-choice=4');
                        break;
                }
                Promise.all([updateWalletData(), update()]).then(() => {
                    element.value = `Build : ${defaultTime} s`;
                });
            }
        }, 1000);
    });
});




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


async function update() {
    updateWalletData();
    const answer = await fetch(url);
    const data = await answer.json();
    console.log(data);

    const ships = data.ships;

    let fighterQuantity = 0;
    let cruiserQuantity = 0;
    let transporterQuantity = 0;
    let coloniserQuantity = 0;

    ships.forEach(element => {
        if (element.archetype_id == 1) {
            fighterQuantity += parseInt(element.amount);
        } else if (element.archetype_id == 2) {
            cruiserQuantity += parseInt(element.amount);
        } else if (element.archetype_id == 3) {
            transporterQuantity += parseInt(element.amount);
        } else if (element.archetype_id == 4) {
            coloniserQuantity += parseInt(element.amount);
        }
    });
    
    fighterQuantityDisplay.innerHTML = "Available : " + fighterQuantity;
    cruiserQuantityDisplay.innerHTML = "Available : " + cruiserQuantity;
    transporterQuantityDisplay.innerHTML = "Available : " + transporterQuantity;
    coloniserQuantityDisplay.innerHTML = "Available : " + coloniserQuantity;
   
}



window.onload = update;