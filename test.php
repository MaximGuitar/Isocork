<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("тест");
?>
<form style="margin:300px;" action="" style="margin:auto;">
    <input id="name" type="text">
    <a onclick="test()">Отправить</a>
    <span id="text">а?</span>
</form>

<script>
    function test() {
        let val = document.getElementById('name').value;
        const data = {
            value: val
        };

        var options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' // Установка заголовка Content-Type для JSON
            },
            body: JSON.stringify(data)
        };

        fetch('ajaxPriem.php', options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Сетевая ошибка: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                // Обработка ответа от сервера
                document.getElementById('text').innerText = data;
            })
            .catch(error => {
                // Обработка ошибок
                console.error('Произошла ошибка:', error);
            });
    }
</script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>