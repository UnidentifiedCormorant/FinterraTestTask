<p style="font-size: larger">Категорически приветствуем вас, {{auth()->user()->name}}
<br>
Ваш балланс {{auth()->user()->money}}</p>

@foreach($users as $user)

    <b>{{$user->name}}</b>
    <br>Балланс {{$user->money}}
    <br>

    <div>
        <form action="{{route('donate', $user->id)}}" method="post" style="max-width: 300px">
            @csrf
            <fieldset>
                <legend>Сумма перевода</legend>
                <input  name="money" type="number" placeholder="Введите сумму перевода">
                <legend>Дата перевода</legend>
                <input type="date" name="date">
                <input type="time" name="time">
            </fieldset>
            <button type="submit">
                <p class="btn-text">Задонатить</p>
            </button>
            <label for="exampleInputEmail1">@error('email') Неверный пароль @enderror</label>
        </form>
    </div>

    <br>

@endforeach

<p><a class="links__link" href="{{route('logout')}}">Выйти</a></p>
