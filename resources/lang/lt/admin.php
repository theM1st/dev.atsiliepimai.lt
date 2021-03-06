<?php

return [
    'control_management_system' => 'Valdymo sistema',

    'create' => [
        'success' => 'Įrašas sėkmingai sukurtas',
        'fail' => 'Nepavyko sukurti'
    ],
    'update' => [
        'success' => 'Informacija sėkmingai atnaujinta',
        'fail' => 'Nepavyko atnaujinti'
    ],
    'delete' => [
        'success' => 'Įrašas sėkmingai ištrintas',
        'fail' => 'Nepavyko ištrinti'
    ],
    'categories' => [
        'index' => 'Kategorijos',
        'create' => 'Nauja kategorija',
        'edit' => 'Kategorijos redagavimas',
        'destroy' => [
            'fail' => 'Negalima ištrinti kategoriją kol yra atsiliepimai. Ištrinkite visus kategorijos atsiliepimus.'
        ],
    ],
    'users' => [
        'index' => 'Vartotojų sąrašas',
        'create' => 'Naujas vartotojas',
        'edit' => 'Vartotojo redagavimas',
        'admin' => [
            'destroy' => [
                'fail' => 'Negalima ištrinti paskutinį administratorių'
            ],
            'update' => [
                'fail' => 'Negalima pakeisti teises, nes yra tik vienas administratorius'
            ],
        ],
    ],
    'brands' => [
        'index' => 'Gamintojai',
        'create' => 'Naujas gamintojas',
        'edit' => 'Gamintojo redagavimas',
    ],
    'pages' => [
        'index' => 'Puslapiai',
        'create' => 'Naujas puslapis',
        'edit' => 'Puslapio redagavimas',
    ],
    'countries' => [
        'index' => 'Šalys',
        'create' => 'Nauja šalis',
        'edit' => 'Šalies redagavimas',
    ],
    'listings' => [
        'index' => 'Produktai/Paslaugos',
        'create' => 'Parašyti atsiliepimą',
        'edit' => 'Produkto/Paslaugos redagavimas',
    ],
    'reviews' => [
        'index' => 'Atsiliepimai',
        'edit' => 'Atsiliepimo redagavimas',
        'move' => 'Perkelti atsiliepimą į kitą produktą/paslaugą',
    ],
    'questions' => [
        'index' => 'Klausimai',
        'edit' => 'Klausimo redagavimas',
    ],
    'answers' => [
        'index' => 'Atsakymai',
        'edit' => 'Atsakymo redagavimas',
    ],
    'attributes' => [
        'index' => 'Atributai',
        'create' => 'Naujas atributas',
        'edit' => 'Atributo redagavimas',
    ],
    'censors' => [
        'index' => 'Netinkamas turinys',
    ],
];