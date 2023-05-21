function handleArchetypeChange(radio) {
    let selectedValue = radio.value;
    update(selectedValue);
}

let url = 'http://esigalactic/api/infrastructure-displayAPI.php';


async function update(selectedValue) {
    const archetypeId = selectedValue
    console.log("Archetype ID : " + archetypeId);
    const answer = await fetch(url + '?archetype-choice=' + archetypeId);
    const data = await answer.json();
    console.log(data);
    
}

const radioButtons = document.querySelectorAll('input[name="archetype-choice"]');
radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        handleArchetypeChange(this);
    });
});