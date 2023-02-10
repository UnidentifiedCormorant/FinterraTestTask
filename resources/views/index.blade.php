<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="{{ URL::asset ('css/style.css') }}">
</head>
<body>

<p style="font-size: larger">Категорически приветствуем вас, {{auth()->user()->name}}
    <br>
    Ваш балланс {{auth()->user()->money}}</p>

@error('transferredMoney')
<p style="color: red">{{$message}}</p>
@enderror

@error('date')
<p style="color: red">{{$message}}</p>
@enderror


<div style="display: flex; flex-wrap: wrap">
    @foreach($users as $user)

        <div style=" margin-right: 40px; ">
            <form action="{{route('donate', $user->u_id)}}" method="post" style="max-width: 300px">
                @csrf
                <b>{{$user->name}}</b>
                <br>Балланс {{$user->money}}
                <br>
                <fieldset>
                    <legend>Сумма перевода</legend>
                    <input name="transferredMoney" type="number" placeholder="Введите сумму перевода">
                    <legend>Дата перевода</legend>
                    <input type="date" name="date" value="today">
                    <input type="time" name="time" step="3600" value="00:00">
                </fieldset>
                <button type="submit">
                    <p class="btn-text">Задонатить</p>
                </button>
                <label for="exampleInputEmail1">@error('email') Неверный пароль @enderror</label>
            </form>

            @if(isset($user->user_id))
                <div style="margin-bottom: 60px;">
                    <b>Последний перевод</b> <br>
                    Сумма: {{$user->transferredMoney}} <br>
                    Дата: {{$user->date}} {{$user->time}} <br>
                    Статус: @if($user->status == 1) Выполнен @else Отложен @endif <br>
                    Получатель: {{\App\Models\User::find($user->getter_id)->name}}
                </div>
            @else
                <div><b>Пользователь пока не осуществлял <br> денежных переводов</b></div>
            @endif
        </div>


        <br>

    @endforeach
</div>

<p><a class="links__link" href="{{route('logout')}}">Выйти</a></p>

</body>
</html>
