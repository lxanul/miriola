@extends('layouts.app')

@section('title', 'Polityka Prywatności | Ośrodek Wypoczynkowy, Jarmark & Gospodarstwo MIRiOLA')
@section('meta_description', 'Polityka prywatności Ośrodka Wypoczynkowego, Jarmarku oraz Gospodarstwa Rolnego MIRiOLA w Gorzeniu Górnym k. Wadowic. Informacje o ochronie danych RODO.')
@section('robots', 'noindex, follow')

@section('content')
    <article class="max-w-[800px] mx-auto px-gutter py-16" data-aos="fade-up">
        <h1 class="font-display text-3xl md:text-headline-lg text-primary font-bold mb-8">Polityka Prywatności</h1>
        
        <div class="space-y-8 text-on-surface-variant font-body bg-surface p-6 md:p-10 rounded-2xl border border-primary/10 ambient-shadow">
            
            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    1. Administrator Danych Osobowych
                </h2>
                <p class="text-sm leading-relaxed">
                    Administratorem Państwa danych osobowych jest <strong>Ośrodek Wypoczynkowy MIRiOLA</strong> z siedzibą pod adresem: ul. Zakopiańska 192, 34-100 Gorzeń Górny (k. Wadowic), reprezentowany przez Mirosława Zadorę.
                </p>
                <p class="text-sm leading-relaxed">
                    W sprawach związanych z ochroną danych osobowych mogą Państwo kontaktować się z Administratorem:
                </p>
                <ul class="list-disc pl-6 space-y-1 text-sm leading-relaxed">
                    <li>Adres e-mail: <a href="mailto:miroslawzadora@wp.pl" class="text-primary font-bold hover:underline">miroslawzadora@wp.pl</a></li>
                    <li>Telefon kontaktowy: <a href="tel:+48608103119" class="text-primary font-bold hover:underline">+48 608 103 119</a></li>
                    <li>Adres pocztowy: ul. Zakopiańska 192, 34-100 Gorzeń Górny</li>
                </ul>
            </section>

            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    2. Zakres i Cele Przetwarzania Danych
                </h2>
                <p class="text-sm leading-relaxed">
                    Przetwarzamy dane osobowe w ramach trzech głównych obszarów działalności marki MIRiOLA:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-sm leading-relaxed mt-2">
                    <li>
                        <strong>Ośrodek Wypoczynkowy:</strong> realizacja rezerwacji oraz świadczenie usług noclegowych (pokoje, domki letniskowe) oraz wynajem sal restauracyjnych i bankietowych na przyjęcia okolicznościowe (art. 6 ust. 1 lit. b RODO).
                    </li>
                    <li>
                        <strong>Jarmark &amp; Kawiarnia Rzemieślnicza:</strong> organizacja oraz rezerwacja warsztatów kulinarno-artystycznych, pokazów i wydarzeń plenerowych (art. 6 ust. 1 lit. b i f RODO).
                    </li>
                    <li>
                        <strong>Gospodarstwo Rolne:</strong> obsługa zamówień telefonicznych oraz sprzedaż płodów rolnych (ogórków gruntowych, kiszonych, miodów naturalnych, wiejskich jajek) i kontakt z klientami (art. 6 ust. 1 lit. b RODO).
                    </li>
                    <li>
                        <strong>Obowiązki prawne i podatkowe:</strong> wystawianie paragonów, faktur, prowadzenie dokumentacji księgowej oraz realizacja obostrzeń meldunkowych (art. 6 ust. 1 lit. c RODO).
                    </li>
                    <li>
                        <strong>Uzasadniony interes Administratora:</strong> dochodzenie ewentualnych roszczeń finansowych lub ochrona przed roszczeniami (art. 6 ust. 1 lit. f RODO).
                    </li>
                </ul>
            </section>

            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    3. Odbiorcy Danych Osobowych
                </h2>
                <p class="text-sm leading-relaxed">
                    Państwa dane osobowe nie są i nigdy nie będą sprzedawane ani przekazywane podmiotom trzecim w celach komercyjnych czy marketingowych. Dostęp do danych mogą posiadać wyłącznie:
                </p>
                <ul class="list-disc pl-6 space-y-1 text-sm leading-relaxed">
                    <li>Upoważnieni pracownicy oraz współpracownicy Administratora.</li>
                    <li>Podmioty świadczące usługi księgowe, prawne, hostingowe oraz IT (wyłącznie na podstawie umów powierzenia przetwarzania danych i w minimalnym niezbędnym zakresie).</li>
                    <li>Uprawnione organy państwowe (np. Urząd Skarbowy, Policja) wyłącznie na podstawie przepisów prawa.</li>
                </ul>
            </section>

            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    4. Prawa Osoby, Której Dane Dotyczą
                </h2>
                <p class="text-sm leading-relaxed">
                    Zgodnie z przepisami RODO przysługuje Państwu prawo do:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-sm leading-relaxed">
                    <li>Dostępu do treści swoich danych oraz otrzymania ich kopii.</li>
                    <li>Sprostowania (poprawiania) nieprawidłowych danych.</li>
                    <li>Usunięcia danych („prawo do bycia zapomnianym”) w przypadkach określonych w art. 17 RODO.</li>
                    <li>Ograniczenia przetwarzania danych.</li>
                    <li>Wniesienia sprzeciwu wobec przetwarzania danych.</li>
                    <li>Wniesienia skargi do organu nadzorczego: <strong>Prezes Urzędu Ochrony Danych Osobowych (PUODO)</strong>, ul. Stawki 2, 00-193 Warszawa.</li>
                </ul>
            </section>
            
            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    5. Okres Przechowywania Danych
                </h2>
                <p class="text-sm leading-relaxed">
                    Dane osobowe przechowywane są przez okres niezbędny do realizacji usługi (noclegu, warsztatów, dostawy produktów), a po jej zakończeniu przez okres wymagany przepisami prawa podatkowego i rachunkowego (zazwyczaj 5 lat od końca roku kalendarzowego) lub do czasu przedawnienia ewentualnych roszczeń.
                </p>
            </section>

            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    6. Dobrowolność Podania Danych
                </h2>
                <p class="text-sm leading-relaxed">
                    Podanie danych osobowych (imię, nazwisko, numer telefonu, adres e-mail) jest dobrowolne, jednakże jest wymogiem niezbędnym do złożenia rezerwacji noclegu, rezerwacji sali, zapisu na warsztaty w Jarmarku lub złożenia zamówienia na produkty z Gospodarstwa Rolnego.
                </p>
            </section>

            <section class="space-y-3">
                <h2 class="font-display text-lg md:text-headline-sm text-primary font-bold flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent inline-block"></span>
                    7. Pliki Cookies i Usługi Stron Trzecich
                </h2>
                <p class="text-sm leading-relaxed">
                    Serwis internetowy wykorzystuje wyłącznie niezbędne pliki cookies (techniczne i sesyjne) w celu zapewnienia prawidłowego funkcjonowania strony oraz bezpieczeństwa.
                </p>
                <p class="text-sm leading-relaxed">
                    Na stronie znajdują się również odnośniki oraz osadzone treści dostawców zewnętrznych:
                </p>
                <ul class="list-disc pl-6 space-y-1 text-sm leading-relaxed">
                    <li><strong>Google Maps:</strong> interaktywna mapa dojazdu do Ośrodka oraz Jarmarku.</li>
                    <li><strong>Google Fonts:</strong> bezpieczne ładowanie czcionek internetowych.</li>
                    <li><strong>Profile społecznościowe (Facebook, Instagram, OLX):</strong> przyciski przekierowujące do oficjalnych profili MIRiOLA. Korzystanie z tych serwisów podlega ich własnym politykom prywatności.</li>
                </ul>
                <p class="text-sm leading-relaxed pt-2">
                    Administrator nie stosuje zautomatyzowanego podejmowania decyzji ani profilowania danych osobowych w rozumieniu RODO.
                </p>
            </section>
        </div>
    </article>
@endsection
