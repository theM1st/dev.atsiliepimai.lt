<?php

return [
    'date' => 'Data',
    'created_date' => 'Sukūrimo data',
    'hello' => 'Sveiki',
    'all_rights_reserved' => 'Visos teisės saugomos',
    'ok' => 'Gerai',
    'create' => 'Sukurti',
    'update' => 'Atnaujinti',
    'save' => 'Išsaugoti',
    'edit' => 'Redaguoti',
    'delete' => 'Trinti',
    'cancel' => 'Atšaukti',
    'sign_in' => 'Prisijungimas',
    'sign_up' => 'Registracija',
    'logout' => 'Atsijungti',
    'forgot_password' => 'Pamiršote slaptažodį?',
    'your_email' => 'Jūsų el. paštas',
    'description' => 'Aprašymas',
    'product' => 'Produktas',
    'service' => 'Paslauga',
    'product_service' => 'Produktas/Paslauga',
    'review' => 'Atsiliepimas',
    'reviews' => 'Atsiliepimai',
    'reviews_plural' => '{0} atsiliepimas|{1} atsiliepimai|{2} atsiliepimų',
    'advices_plural' => '{0} patarimas|{1} patarimai|{2} patarimų',
    'last_review' => 'Paskutinis atsiliepimas',
    'rating' => 'Įvertinimas',
    'fail' => 'Atsiprašome, įvyko klaida. Bandykite vėliau',
    'show_censor_commentable' => 'Parodyti netinkamą turinį',
    'form' => [
        'select' => 'Pasirinkite',
        'sign_in' => 'Prisijungti',
        'sign_up' => 'Registruotis',
        'reset_password' => 'Atstatyti slaptažodį',
        'change_password' => 'Pakeisti slaptažodį',
        'country' => [
            'name' => 'Pavadinimas',

        ],
        'listing' => [
            'title' => 'Produkto/paslaugos pavadinimas',
            'title_help' => 'Ne daugiau nei 80 simbolių',
            'description' => 'Produkto detalės',
            'suitable_category' => 'Tinkama kategorija',
            'select_category' => 'Pasirinkite tinkamą kategoriją',
            'listing_type' => 'Apie ką jūsų atsiliepimas?',
            'active' => 'Aktyvus',
            'main_attribute' => 'Pagrindinis atributas',
            'another_attributes' => 'Kiti atributai',
            'picture' => 'Nuotrauka',
            'sortby' => [
                'newest' => 'Naujesni',
                'rating_high' => 'Labiausi įvertinti',
                'number_of_reviews' => 'Atsiliepimų kiekis',
            ]
        ],
        'review' => [
            'title' => 'Atsiliepimo antraštė',
            'title_placeholder' => 'Pavyzdys: Labai geras daiktas, negaliu be jo gyventi!',
            'title_help' => 'Ne daugiau nei 80 simbolių',
            'description' => 'Jūsų atsiliepimas',
            'description_placeholder' => 'Kuo įmanoma objektyviai ir aiškiai aprašykite savo naudojimo patirtį, nenaudokite agresyvios leksikos ir nerašykite asmeninių duomenų.',
            'description_help' => 'Minimaliai 50 simbolių',
            'rating' => 'Kaip įvertintumėte :name?',
            'active' => 'Aktyvus atsiliepimas',
            'cannot_find_my_option' => 'Negaliu rasti savo variantą',
            'write_your_option' => 'Parašykite savo variantą',
            'user_option' => 'Vartotojo įrašytas variantas',
            'rating_values' => [
                'excellent' => 'Puiku',
                'good' => 'Gerai',
                'ok' => 'Normalu',
                'bad' => 'Blogai',
                'terrible' => 'Baisu',
            ],
            'sortby' => [
                'newest' => 'Naujesni',
                'rating_high' => 'Aukščiausias įvertinimas',
                'rating_low' => 'Žemiausias įvertinimas',
                'helpful' => 'Labiausiai naudingi',
                'oldest' => 'Senesni',
            ],
            'create' => [
                'success' => 'Ačiū, Jūsų atsiliepimas priimtas. Po sėkmingo patvirtinimo bus patalpintas portale.',
                'fail' => 'Nepavyko išsaugoti atsiliepimą, bandykite vėliau.'
            ],
        ],
        'question' => [
            'create' => [
                'success' => 'Ačiū, Jūsų klausimas priimtas.',
                'fail' => 'Nepavyko išsaugoti atsiliepimą, bandykite vėliau.'
            ],
        ],
        'page' => [
            'title' => 'Pavadinimas',
            'description' => 'Puslapio aprašymas (meta description)',
            'content' => 'Puslapio turinys',
            'active' => 'Aktyvus puslapis',
            'sendMessage' => [
                'success' => 'Ačiū, Jūsų žinutė išsiųsta.',
            ],
        ],
        'censor' => [
            'content' => 'Priežastis',
            'commentable' => 'Netinkamas turinys',
            'create' => [
                'success' => 'Ačiū, Jūsų skundas priimtas.',
                'fail' => 'Įvyko klaidą, bandykite vėliau.'
            ],
        ],
        'category' => [
            'main' => 'Pagrindinė',
            'name' => 'Pavadinimas',
            'description' => 'Kategorijos aprašymas (meta description)',
            'parent' => 'Priklauso kategorijai',
            'popular' => 'Populiari kategorija',
            'active' => 'Aktyvuota',
            'picture' => 'Nuotrauka',
        ],
        'message' => [
            'title' => 'Žinutės tema',
            'content' => 'Žinutė',
            'send' => 'Siųsti žinutę',
        ],
        'attribute' => [
            'main' => 'Pagrindinis atributas',
            'name' => 'Atributo pavadinimas',
            'name_help' => 'Tiklus pavadinimas. Matosi tik adminui, kad būtų paprasčiau rasti sąraše pvz. IPhone 6 modeliai, BMW 3 serijos karta ir t.t.',
            'title' => 'Atributo antraštė',
            'title_help' => 'Bendras pavadinimas, matosi vartotojui, pvz. Modeliai, karta ir t.t.',
        ],
        'picture_rules' => 'Nuotrauka turi būti .jpg, .gif arba .png formatu, mažiau nei 3MB.',
    ],
    'listing' => [
        'questions_answers' => 'Klausimai ir atsakymai'
    ],
    'user' => [
        'email' => 'El. paštas',
        'username' => 'Slapyvardis',
        'password' => 'Slaptažodis',
        'new_password' => 'Naujas slaptažodis',
        'repeat_password' => 'Pakartoti slaptažodį',
        'current_password' => 'Dabartinis slaptažodis',
        'current_password_help' => 'Prašom, įvesti dabartinį slaptažodį duomenų atnaujinimui',
        'name' => 'Vardas pavardė',
        'your_first_name' => 'Jūsų vardas',
        'first_name' => 'Vardas',
        'last_name' => 'Pavardė',
        'birthday' => 'Gimimo data',
        'telephone' => 'Telefono numeris',
        'address' => 'Gatvės adresas',
        'city' => 'Miestas',
        'country' => 'Šalis',
        'place' => 'Vieta',
        'picture' => 'Nuotrauka',
        'gender' => 'Lytis',
        'male' => 'Vyras',
        'female' => 'Moteris',
        'registration' => 'Registracija',
        'user_role' => 'Teisės',
        'admin' => 'Administratorius',
        'remember_me' => 'Prisiminti jūsų prisijungimo duomenis',
    ],
    'profile' => [
        'name' => 'Profilis',
        'settings' => 'Nustatymai',
        'sections' => [
            'me' => 'Mano profilis',
            'reviews' => 'Atsiliepimai',
            'questions' => 'Klausimai',
            'answers' => 'Atsakymai',
            'About' => 'Keisti aprašą',
            'Photo' => 'Keisti nuotrauką',
            'Address' => 'Keisti adresą',
            'Email' => 'Keisti el. paštą',
            'Password' => 'Keisti slaptažodį',
        ],
        'form' => [
            'edit' => 'Redaguoti profilį',
            'update' => 'Atnaujinti profilį',
        ],
        'update' => [
            'success' => 'Jūsų nustatymai sėkmingai pakeisti',
            'fail' => 'Nepavyko pakeisti nustatymus'
        ],
    ],
    'messages' => [
        'name' => 'Žinutės',
        'create' => 'Rašyti žinutę',
        'inbox' => 'Gautos',
        'outbox' => 'Išsiųstos',
    ],
    'review_vote' => [
        'success' => 'Ačiū, jūsų balsas priimtas',
    ]
];