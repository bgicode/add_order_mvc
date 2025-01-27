window.addEventListener("DOMContentLoaded", () => {
    const positionContainer = document.querySelector('.showPositions');
    positionContainer.addEventListener('click', function(event) {
        if (event.target.closest('.deletePosition')) {
            const positionUnit = event.target.closest('.position');
            if (positionUnit) {
                positionUnit.remove();
            } else {
                console.error('НЕ УДАЛИЛОСЬ');
            }

            const allPositions = document.querySelectorAll(".position");

            
            allPositions.forEach((position, index) => {
                const inputs = position.querySelectorAll('input');

                position.querySelector('.positionFieldsWraper > .positionTitleWraper > .positionTitle').innerHTML = 'Товар ' + (index + 1);
                let positionIndex = index;
                inputs.forEach(input => {
                    // Получаем текущее значение name
                    const currentName = input.getAttribute('name');
                    
                    
                    // Используем регулярное выражение для замены
                    const newName = currentName.replace(/positions\[\d+\]\[(.+?)\]/, `positions[${positionIndex}][$1]`);
      
                    // Устанавливаем новое значение name
                    input.setAttribute('name', newName);
                });

            });
        }
    });
})
