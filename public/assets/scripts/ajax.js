window.addEventListener("DOMContentLoaded", () => {

    const showPositions = document.querySelector(".showPositions"); //Обёртка позиций
    const addPositionButton = document.querySelector(".addPosition"); //кнопка добовления позиции
    const inputFields = document.querySelectorAll(".filterUnitValue");

    function showPosition(data) {
        //________Вывод выбранной позиции______________
        // data - массив данных в ajax-ответе
        
        const positions = document.querySelectorAll('.position'); // получение уже созданных позици
        let repeatingPosition = false;

        let positionsCount = 0
        if (positions) {
            positionsCount = positions.length;
        } else {
            positionsCount = 0;
        } 
        
        positions.forEach((position, index) => {
            if (position.querySelector('.articulField').value == data['article']) {
                position.querySelector('.quantity').value++;
                repeatingPosition = true;
            }
        });

        if (!repeatingPosition) {
            //______________Вывод позиции товара __________________
            const HTMLcontentAvailb = `<div class="position">
                                            <div class="positionFieldsWraper">
                                                <div class="positionTitleWraper">
                                                    <span class="positionTitle">Товар ${positionsCount+1}</span>
                                                    <div class="button deletePosition">
                                                        Удалить
                                                    </div>
                                                </div>
                                                <div class="positionInputWraper">
                                                    <lable class="positionFieldTitle">Артикул
                                                        <input class="field ajaxAutoload positionField articulField" type="text" name="positions[${positionsCount}][article]" value="${data['article']}" required readonly>
                                                    </lable>
                                                    <lable class=" positionFieldTitle">Название
                                                        <input class="field ajaxAutoload positionField" type="text" name="positions[${positionsCount}][product_name]" value="${data['name']}" required readonly>
                                                    </lable>
                                                    <lable class=" positionFieldTitle">Цена
                                                        <input class="field ajaxAutoload positionField" type="text" name="positions[${positionsCount}][product_price]" value="${data['price']}" required readonly>
                                                    </lable>
                                                    <lable class="positionFieldTitle quantityTitle">Количество
                                                        <input class="field positionField quantity" type="number" name="positions[${positionsCount}][quantity]" value="1" min=1>
                                                    </lable>
                                                    <input type="hidden" name="positions[${positionsCount}][good_id]" value="${data['id']}">
                                                </div>
                                            </div>
                                        </div>`;

            const newPosition = document.createElement('div'); // обёртка новой позиции

            newPosition.innerHTML = HTMLcontentAvailb;

            showPositions.appendChild(newPosition);

            showPositions.querySelectorAll('input').forEach(input => {
            if (input.value == 'undefined') {
                input.value = '';
                input.readOnly = false;
                input.classList.remove('ajaxAutoload');
            }
            });
        }
    }

    function setInputData(data, apiType) {
        // установка полученного ajax-ответа
        // data - массив данных в ajax-ответе
        // inputType - тип ajax запрос из какого поля отпрален
        if (apiType == 'get') {
            showPosition(data);
        }
    }

    function getInputData(event) {
        //______________________получение ajax-ответа___________________________
        // event событие определяющее поле с которого происходит
        let apiType;

        let formData = new FormData();

        if (event = event == 'showPos') {
            apiType = 'get';
            const selectElement = document.querySelector('.goodName');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            formData.append('good_id', selectedOption.value);
        } else {
            apiType = 'post';
            inputFields.forEach(input => {
                if (input.name) { // Проверяем, что у инпута есть имя
                    formData.append(input.name, input.value);
                }
            });
        }

        let str = '?';
        formData.forEach((value, key) => {
            str += key + '=' + value + '&';
        });
        str = str.replace(/ /g, '%20');
        str.replace(/&+$/, '');

        let url = location.protocol + '//' + location.host + location.pathname + str;
        if (event == 'post') {
            url = location.protocol + '//' + location.host + location.pathname;
        }

        //____________________________________КОНЕЦ генерация строки запроса_________________________
        getResourse(url, apiType)
            .then(data => setInputData(data, apiType))
            .catch(err => console.error(err));
    }

    //_________________________НАЧАЛО событие запрос получение параметров для вывода позиции_____________________
    addPositionButton.addEventListener('click', function(event) {
        getInputData('showPos')
    })
    //_________________________КОНЕЦ событие запрос получение параметров для вывода позиции_____________________

    async function getResourse(url, apiType) {
 
        let options;
        if (apiType == 'get') {
            options = {
                method: "GET"
            }
        } else if (apiType == 'post') {
            options = {
                method: "POST",
                mode: "cors",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({query: query, count: 6})
            }
        }

        const res = await fetch(`${url}`, options);

        if(!res.ok) {
            throw new Error(`Could not fetch ${url}, status: ${res.status}`);
        }
        return await res.json();
    }
})
