<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="" type="image/x-icon">
    <title>Тестовое задание</title>
</head>

<body>
<section class="form">
    <div class="border">

        <p class="form__title">Авторизация</p>

        <div class="container-form">

            <div class="form__head">
                <div class="form__head--text">
                    <h2>Клуб анонимных волонтёров<br></h2>
                    <p class="subtitle">Здесь случайные люди помогают другим случайным людям<br>
                        ...но без фанатизма</p>
                </div>
            </div>

            <div class="form__content">

                <form action="{{route('auth')}}">
                    <fieldset>
                        <legend class="form__content--text" for="exampleInputEmail1">Учётная запись</legend>
                        <input class="form__content--input" name="email" placeholder="Введите email">
                        <legend class="form__content--text">Пароль</legend>
                        <input class="form__content--input" type="password" placeholder="Введите пароль" name="password">
                    </fieldset>
                    <button class="form__content--btn" type="submit">
                        <p class="btn-text">Войти</p>
                    </button>
                    <label for="exampleInputEmail1">@error('email') Неверный пароль @enderror</label>
                </form>
            </div>

        </div>

    </div>
</section>
</body>

</html>
