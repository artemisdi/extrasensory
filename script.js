/**
 * функция дял сокращения кода при связывании js с разметкой
 * @param id
 * @returns {HTMLElement}
 */
let docId = function (id) {
    return document.getElementById(id);
};
document.addEventListener("DOMContentLoaded", addAjax('check.php', 'application/x-www-form-urlencoded')); // вызов функции AJAX при перезагрузке страницы

/*
* клик по кнопке генерации экстрасенсов с проверкой на число и что бы было больше 1
* */
window.onload = function () {
    docId('buttonOne').onclick = function () {
        if (docId('dataOne').value.match(/^[0-9]+$/gm) && docId('dataOne').value >= 1) {
            docId('dataOne').style.boxShadow = '0 0 0 .2rem rgba(0,123,255,.25)';
            let params = 'dataExtra=' + docId('dataOne').value;
            addAjax('check.php', 'application/x-www-form-urlencoded', params);
            docId('dataOne').value = '';
            if (docId('dataOne').value >= 11) {
                document.getElementsByTagName('body').style.color = 'red';
            }
        } else {
            docId('dataOne').style.border = '1px solid red';
        }

    }
};
/*
* клик по кнопке загадывания числа с проверкой на число и что бы было больше 10
* */
document.getElementById('buttonTwo').onclick = () => {
    let params = 'number=' + docId('dataTwo').value;
    if (docId('dataTwo').value.match(/^[0-9]+$/gm) && docId('dataTwo').value >= 10) {
        docId('dataTwo').style.boxShadow = '0 0 0 .2rem rgba(0,123,255,.25)';
        addAjax('server.php', 'application/x-www-form-urlencoded', params);
        docId('dataTwo').value = '';

    } else {
        docId('dataTwo').style.boxShadow = '0 0 0 .2rem red';
    }

};


/**
 * Функция запроса AJAX
 * @param url - адрес куда полетит запрос
 * @param code - кодировка
 * @param params - передаваемый параметр на сервер
 */
function addAjax(url, code, params) {
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', code);
    request.send(params);
    request.onreadystatechange = () => {
        if (request.readyState !== 4) return;
        if (request.status !== 200) {
            console.log('не 200');
        } else {
            // ЕСЛИ ОТВЕТ НЕ FALSE , ТО РАБОТАЕМ С ДАННЫМИ
            if (request.status === 200) {
                if (request.response !== false) {
                    if (request.response) {
                        let x = JSON.parse(request.response);
                        // если только имена
                        if (x.name && x.numberUser === undefined) {
                            if (x.name.length > 11) {
                                console.log('больше 11 lets go');
                                document.body.style.display = 'block';
                            }
                            docId('tHeadRow').innerHTML = '<td>ИГРОКИ /<br> ДАННЫЕ</td>';
                            docId('tHeadRow').innerHTML += '<td>ИГРОК</td>';
                            docId('tBodyPrestige').innerHTML = '<td>ПРЕСТИЖ</td><td></td>';
                            docId('tBodyResult').innerHTML = '<td>РЕЗУЛЬТАТ</td>';
                            for (let i = 0; i < x.name.length; i++) {
                                docId('tHeadRow').innerHTML += '<td>' + x.name[i] + '</td>';
                                docId('tBodyPrestige').innerHTML += '<td id="prestige-' + i + '"></td>';
                            }
                            for (let i = 0; i < x.name.length + 1; i++) {
                                docId('tBodyResult').innerHTML += '<td id="result-' + i + '"><ol id="ol-' + i + '"></ol></td>';
                            }
                            docId('formOne').classList.add('disabled');
                            docId('formTwo').classList.remove('disabled');
                            // если имена и данные есть
                        } else if (x.name && x.numberUser) {
                            if (x.name.length > 11) {
                                document.body.style.display = 'block';
                            }
                            docId('tHeadRow').innerHTML = '<td>ИГРОКИ /<br> ДАННЫЕ</td>';
                            docId('tHeadRow').innerHTML += '<td>ИГРОК</td>';
                            docId('tBodyPrestige').innerHTML = '<td>ПРЕСТИЖ</td><td></td>';
                            docId('tBodyResult').innerHTML = '<td>РЕЗУЛЬТАТ</td>';
                            for (let i = 0; i < x.name.length; i++) {
                                // console.log(x.name[i]);
                                docId('tHeadRow').innerHTML += '<td>' + x.name[i] + '</td>';
                                docId('tBodyPrestige').innerHTML += '<td id="prestige-' + i + '"></td>';
                            }
                            for (let i = 0; i < x.name.length + 1; i++) {
                                docId('tBodyResult').innerHTML += '<td id="result-' + i + '"><ol id="ol-' + i + '"></ol></td>';
                            }
                            docId('window').classList.add('active');
                            for (let i = 0; i < x.numberUser.length; i++) {
                                let userNumber = document.getElementById('ol-0');
                                userNumber.innerHTML += '<li>' + x.numberUser[i] + '</li>';
                            }
                            //цикл для построения ячеек
                            for (let j = 0; j < x.numberExtraArray.length; j++) {
                                let counter = j + 1;
                                let extraNumber = document.getElementById("ol-" + counter);
                                let nestedListInCell = '';
                                //цикл для построения списков в ячейках
                                for (let i = 0; i < x.numberExtraArray[j].numberGuessed.length; i++) {
                                    // console.log(x.numberExtraArray[j].matchId[i]);
                                    if (x.numberExtraArray[j].matchId[i]) {
                                        nestedListInCell += '<li class="matchId">' + x.numberExtraArray[j].numberGuessed[i] + '</li>';
                                    } else {
                                        nestedListInCell += '<li>' + x.numberExtraArray[j].numberGuessed[i] + '</li>';
                                    }
                                }
                                extraNumber.innerHTML = nestedListInCell;
                                document.getElementById('prestige-' + j).innerHTML = x.numberExtraArray[j].prestige;
                            }
                            //добавление последнего значения пользователя в шар
                            docId('imageUserData').innerHTML = '<span>' + x.numberUser[x.numberUser.length - 1] + '</span><div class="sprite-lip" id="spriteLip"></div>';
                            //скрывание  и отоброжение окон
                            docId('formOne').classList.add('disabled');
                            docId('formTwo').classList.remove('disabled');
                            //при нажатии на кнопку загадать число
                        } else if (x.numberExtraArray) {
                            for (let i = 0; i < x.numberUser.length; i++) {
                                let userNumber = document.getElementById('ol-0');
                                userNumber.innerHTML += '<li>' + x.numberUser[x.numberUser.length - 1] + '</li>';
                                break;
                            }
                            for (let j = 0; j < x.numberExtraArray.length; j++) {
                                let counter = j + 1;
                                let extraNumber = document.getElementById("ol-" + counter);
                                if (x.numberExtraArray[j].matchId[x.numberUser.length - 1] === true) {
                                    extraNumber.innerHTML += '<li class="matchId">' + x.numberExtraArray[j].numberGuessed[x.numberExtraArray[j].numberGuessed.length - 1] + '</li>';
                                }
                                //проверка на совпадение, для отображения стилей
                                else {
                                    extraNumber.innerHTML += '<li>' + x.numberExtraArray[j].numberGuessed[x.numberExtraArray[j].numberGuessed.length - 1] + '</li>';
                                }
                                document.getElementById('prestige-' + j).innerHTML = x.numberExtraArray[j].prestige;
                            }
                            //добавление последнего значения пользователя в шар
                            docId('imageUserData').innerHTML = '<span>' + x.numberUser[x.numberUser.length - 1] + '</span><div class="sprite-lip" id="spriteLip"></div>';
                        }
                    }
                }
            }

        }
    };
}
