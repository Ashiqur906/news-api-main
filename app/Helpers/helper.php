<?php
if (!function_exists('number_to_word')) {
    function number_to_word()
    {
     return [
               '0' => 'zero', 
               '1' => 'one',
               '2' => 'two',
               '3' => 'three',
               '4' => 'four',
               '5' => 'five',
               '6' => 'six',
               '7' => 'seven',
               '8' => 'eight',
               '9' =>  'nine',
               '10' => 'ten',
               '11' => 'eleven',
               '12' => 'twelve',
               '13' => 'thirteen',
               '14' => 'fourteen',
               '15' => 'fifteen',
               '16' => 'sixteen',
               '17' => 'seventeen',
               '18' => 'eighteen',
               '19' => 'nineteen',
               '20' => 'twenty',
            ];

         
    }

    if (!function_exists('n2w')) {
        function n2w($data)
        {
            $number_to_word = number_to_word();
            $converted = strtr($data, $number_to_word);
            return $converted;
        }
    }

    if (!function_exists('distrcit')) {
        function distrcit()
        {
            $districts = [
                    
                            'title_bn' => [
                                "কুমিল্লা", "চট্টগ্রাম", "ফেনী", "ব্রাহ্মণবাড়িয়া", "রাঙ্গামাটি", "নোয়াখালী", "চাঁদপুর", "লক্ষ্মীপুর", "কক্সবাজার", "খাগড়াছড়ি", "বান্দরবান", "সিরাজগঞ্জ", "পাবনা", "বগুড়া", "রাজশাহী", "নাটোর", "জয়পুরহাট",
                                "চাঁপাইনবাবগঞ্জ", "নওগাঁ", "যশোর", "সাতক্ষীরা", "মেহেরপুর", "নড়াইল", "চুয়াডাঙ্গা", "কুষ্টিয়া", "মাগুরা", "খুলনা", "বাগেরহাট", "ঝিনাইদহ", "ঝালকাঠি", "পটুয়াখালী", "পিরোজপুর", "বরিশাল", "ভোলা", "বরগুনা", "সিলেট", "মৌলভীবাজার", "হবিগঞ্জ", "সুনামগঞ্জ", "নরসিংদী",
                                "গাজীপুর", "শরীয়তপুর", "নারায়ণগঞ্জ", "টাঙ্গাইল", "কিশোরগঞ্জ", "মানিকগঞ্জ", "ঢাকা", "মুন্সিগঞ্জ", "রাজবাড়ী", "মাদারীপুর", "গোপালগঞ্জ", "ফরিদপুর", "পঞ্চগড়", "দিনাজপুর", "লালমনিরহাট", "নীলফামারী", "গাইবান্ধা", "ঠাকুরগাঁও", "রংপুর", "কুড়িগ্রাম", "শেরপুর",
                                "ময়মনসিংহ", "জামালপুর", "নেত্রকোণা"
                            ],
                            'title_en' => [
                                "Cumilla", "Chattogram", "Feni", "Brahmanbaria", "Rangamati", "Noakhali", "Chandpur", "Lakshmipur", "Coxsbazar", "Khagrachhari", "Bandarban", "Sirajganj", "Pabna", "Bogura", "Rajshahi", "Natore", "Joypurhat", "Chapainawabganj", "Naogaon",
                                "Jashore", "Satkhira", "Meherpur", "Narail", "Chuadanga", "Kushtia", "Magura", "Khulna", "Bagerhat", "Jhenaidah", "Jhalakathi", "Patuakhali", "Pirojpur", "Barishal", "Bhola", "Barguna", "Sylhet", "Moulvibazar", "Habiganj", "Sunamganj", "Narsingdi", "Gazipur",
                                "Shariatpur", "Narayanganj", "Tangail", "Kishoreganj", "Manikganj", "Dhaka", "Munshiganj", "Rajbari", "Madaripur", "Gopalganj", "Faridpur", "Panchagarh", "Dinajpur", "Lalmonirhat", "Nilphamari", "Gaibandha", "Thakurgaon", "Rangpur", "Kurigram", "Sherpur",
                                "Mymensingh", "Jamalpur", "Netrokona"
                            ],
                            'slug'     => [
                                "cumilla", "chattogram", "feni", "brahmanbaria", "rangamati", "noakhali", "chandpur", "lakshmipur", "coxsbazar", "khagrachhari", "bandarban", "sirajganj", "pabna", "bogura", "rajshahi", "natore", "joypurhat", "chapainawabganj", "naogaon",
                                "jashore", "satkhira", "meherpur", "narail", "chuadanga", "kushtia", "magura", "khulna", "Bagerhat", "jhenaidah", "jhalakathi", "patuakhali", "pirojpur", "barishal", "bhola", "barguna", "sylhet", "moulvibazar", "habiganj", "sunamganj", "narsingdi", "gazipur",
                                "shariatpur", "narayanganj", "tangail", "kishoreganj", "manikganj", "dhaka", "munshiganj", "rajbari", "madaripur", "gopalganj", "faridpur", "panchagarh", "dinajpur", "lalmonirhat", "nilphamari", "gaibandha", "thakurgaon", "rangpur", "kurigram", "sherpur",
                                "mymensingh", "jamalpur", "netrokona"
                            ]
                       
            ];
            return  $districts;
        }
    }

    
}        