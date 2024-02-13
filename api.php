<h1>API та бекенд</h1>
<div class="card-panel teal">
    <button class="btn green" onclick="getClick()">CREATE</button>
    <button class="btn indigo" onclick="postClick()">POST</button>
    <div id="api-result"></div>

</div>
<h2>Робота з БД</h2>
<p>    
    Підготовчі роботи.
    Встановлюємо СУБД (MySQL/MariaDB).
    Створюємо окрему БД для проєкту, користувача для неї.<br/>
    <code>CREATE DATABASE php_spd_111;</code><br/>
    <code>CREATE USER 'spd_111_user'@'localhost' IDENTIFIED BY 'spd_pass';</code><br/>
    Даємо користувачу права на дану БД<br/>
    <code>GRANT ALL PRIVILEGES ON php_spd_111.* TO 'spd_111_user'@'localhost';</code><br/>
    Оновлюємо таблицю доступу<br/>
    <code>FLUSH PRIVILEGES</code><br/>
</p>
<p>
    Підключення.
    Є дві групи технологій роботи з БД: "індивідуальні" - набори команд
    під кожну БД окремо (mysql_connect(), ib_connect(),...);
    та "універсальна" - технологія PDO (аналог ADO у .NET)
    Далі розглядаємо PDO.   
</p>
<script>
    function getClick(){
        fetch("/test")
        .then(r => r.text())
        .then(t => {
            document.getElementById("api-result").innerText = t;
        });
    }
    function postClick(){
        fetch("/test",{
            method: 'POST'
        })
        .then(r => r.text())
        .then(t => {
            document.getElementById("api-result").innerText = t;
        });
    }
</script>