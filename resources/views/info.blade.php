@extends('layouts.app')
@section('content')

<div class="card-body" style="border: none;">
    <div class="container">
        <h3 class="text-center mb-4 mt-3 mt-md-0">Projektről</h3>
        Luna egy interaktív online szótanító webalkalmazás, amely segít a felhasználóknak bővíteni és megerősíteni a szókincsüket játékos és interaktív módon.
        <h4 class="mt-4 mb-3">Főbb jellemzők:</h4>
        <ul>
          <li><b>Autentikáció és Személyreszabás:</b>
            <br>
            Az alkalmazás autentikációs rendszere biztosítja, hogy minden felhasználó számára egyéni, személyre szabott lehetőségek legyenek elérhetőek.</li>
            <br>
          <li><b>Saját Szótár Készítés: </b>
            <br>
            A felhasználóknak lehetőségük van létrehozni egyéni szótárakat, amelyekben szavakat menthetnek el és szabadon szerkeszthetnek.</li>
            <br>
            <li><b>Szókincs Gyakorlása:</b>
            <br>
            Az alkalmazás többnyire olyan szavakat választ ki kérdésként, amelyeket a felhasználók kevésbé ismernek vagy egyáltalán nem ismernek. Az ismert szavakat kevésbé gyakran gyakoroltatja, hogy a felhasználók minél hatékonyabban bővítsék szókincsüket. Ezen felül a felhasználók saját szótáraikból is választhatnak szavakat, és ezekből generálhatnak kérdéseket angol vagy magyar nyelven. A generált válaszokat ellenőrizhetik. Amennyiben egy adott szó nem ismert, a felhasználó segítséget kérhet, ami magyarázattal szolgál a szó jelentésének megértéséhez.</li>
            <br>
            <li><b>Olvasás Gyakorlása: </b>
            <br>
            Az alkalmazás lehetővé teszi a felhasználók számára az olvasási készségük fejlesztését. Ezen belül a felhasználók saját szótáraik alapján generálhatnak egyéni olvasmányokat. Ideiglenesen hozzáadott szavakból is létrehozhatnak olvasmányokat. A szövegeket lefordíthatják a kiválasztott nyelvről a célnyelvre.</li>
            <br>
            <li><b>Kérdések és Mondatok Gyakorlása: </b>
            <br>
            A felhasználók gyakorolhatják a kérdéseket és mondatokat az alkalmazás segítségével. Az alkalmazás ellenőrzi, kijavítja és magyarázza az esetleges hibákat, így segítve a felhasználókat a tanulás során.</li>
        </ul>
      </div>
</div>

<script>
    const chatInputDiv = document.getElementById("chatInput");
    chatInputDiv.style.display = "none";
</script>

@endsection
