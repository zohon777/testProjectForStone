<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <script
            src="https://code.jquery.com/jquery-3.6.3.js"
            integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
            crossorigin="anonymous"></script>

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    @csrf
    <form action="{{route('calcSalary')}}" enctype="multipart/form-data" method="POST" class="d-flex flex-column" id="salary_form">
        <label for="full_name">ФИО:</label><br>
        <input type="text" id="full_name" name="full_name" placeholder="Иванов Иван Иванович" required><br>
        <label for="age">Возраст:</label><br>
        <input type="number" id="age" name="age" placeholder="18" required><br>
        <label for="children">Сколько детей:</label><br>
        <input type="number" id="children" name="children" placeholder="0" required><br>
        <label for="company_car">Водит служебную машину:</label><br>
        <input type="radio" id="yes" name="company_car" value="yes">
        <label for="yes">Да</label><br>
        <input type="radio" id="no" name="company_car" value="no">
        <label for="no">Нет</label><br>
        <label for="salary">Оклад:</label><br>
        <input type="number" id="salary" name="salary" placeholder="100000" required><br>
        <button class="" id="calc_button" data-type="calc" type="button">Расчитать</button>
    </form>

    <div class="" id="container" style="display: none">
        <h3>Ваша зарплата</h3>
        <h4>НДФЛ:</h4>
        <div class="" id="ndfl"></div>
        <h4>часть зп если больше 2 детей:</h4>
        <div class="" id="for_kids"></div>
        <h4>надбавка если возраст больше 50 лет:</h4>
        <div class="" id="for_age"></div>
        <h4>За служебную машину</h4>
        <div class="" id="for_car"></div>
        <h4>Зарплата:</h4>
        <div class="" id="final_salary"></div>
    </div>

    </body>
<script>
    $('#calc_button').click(function (e){
        e.preventDefault();
        let form = $('#salary_form');
        let data = form.serialize();
        axios.post(form.attr('action'), data).then(r => {
            if (r.data.success){
                $('#container').show();
                $('#final_salary').text(r.data.salary);
                $('#ndfl').text(r.data.ndfl);
                $('#for_kids').text(r.data.for_kids);
                $('#for_age').text(r.data.for_age);
                $('#for_car').text(r.data.for_car);
                $('#sum').text(r.data.sum);
            } else {
                $('#result').text("Ошибка");
            }
        });
    });

</script>
</html>
