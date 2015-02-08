<?php

/*
Nazwa: Fałszywe IP
Autor: Destroy666
Wersja: 1.0
Informacje: Plugin dla skryptu MyBB, zakodowany dla wersji 1.8.x.
Zamienia wszystkie adresy IP w bazie na fałszywy IP podany w ustawieniach. 
1 nowe ustawienie
Licencja: GNU GPL v3, 29 June 2007. Więcej informacji w pliku LICENSE.md.
Support: oficjalne forum MyBB - http://community.mybb.com/mods.php?action=profile&uid=58253 (nie odpowiadam na PM, tylko na posty)
Zgłaszanie błędów: mój github - https://github.com/Destroy666x

© 2015 - date("Y")
*/

$l['store_fake_ips'] = 'Fałszywe IP';
$l['store_fake_ips_info'] = 'Zamienia wszystkie adresy IP w bazie na fałszywy IP podany w ustawieniach.';

$l['store_fake_ips_settings'] = 'Ustawienia dla pluginu "Fałszywe IP"';
$l['store_fake_ips_ip'] = 'Fałszywe IP';
$l['store_fake_ips_ip_desc'] = 'Podaj prawidłowy adres IPv4 lub IPv6, np. 127.0.0.1. Jeśli adres nie będzie prawidłowy, plugin nie zadziała.';

$l['store_fake_ips_current'] = 'Sfałszuj wszystkie adresy IP aktualnie przechowywane w bazie danych.';
$l['store_fake_ips_confirm'] = 'Czy na pewno chcesz sfałszować wszystkie adresy IP w bazie danych? Jest to nieodwracalny proces.';
$l['store_fake_ips_confirm_title'] = 'Sfałszować wszystkie IP?';
$l['store_fake_ips_done'] = 'Pomyślnie słaszowano adresy IP.';
$l['store_fake_ips_wrong_ip'] = 'IP podany w ustawieniach jest niepoprawny. Upewnij się czy wpisujesz adres IPv6 lub IPv4 zgodny ze specyfikacją.';
$l['store_fake_ips_wrong_version'] = 'Musisz zaktualizować MyBB przynajmniej do 1.8.0 żeby używać tą modyfikację.';
$l['store_fake_ips_dont_ban'] = 'Nie możesz zbanować tego adresu IP, gdyż zablokuje to dostęp do forum wszystkim użytkownikom.';