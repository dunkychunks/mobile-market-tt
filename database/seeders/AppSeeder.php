<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Seeds the product catalogue with real Caribbean / Trinidadian produce.
     *
     * Each item calls Product::factory()->create([...]) so that the factory's
     * randomImage() method still picks a product image from storage, while
     * the text fields are supplied directly here.
     *
     * Categories in use: fruits, vegetables, herbs, ground-provisions, seasonings
     * Classification values: default, featured, upcoming
     */
    public function run(): void
    {
        $products = [

            // ── FRUITS ────────────────────────────────────────────────────────
            ['title' => 'Julie Mango',          'category' => 'fruits',           'price' => 25, 'short_description' => 'Sweet, juicy Julie mangoes — a Trinidad favourite. Perfect for chow, juices, or eating fresh.', 'classification' => 'featured'],
            ['title' => 'Long Mango',            'category' => 'fruits',           'price' => 18, 'short_description' => 'Large, fibre-free long mangoes with a rich golden flesh. Great for slicing and salads.'],
            ['title' => 'Pineapple',             'category' => 'fruits',           'price' => 20, 'short_description' => 'Locally grown, sun-ripened pineapples bursting with tropical sweetness.', 'classification' => 'featured'],
            ['title' => 'Pawpaw (Papaya)',       'category' => 'fruits',           'price' => 15, 'short_description' => 'Bright orange pawpaw — naturally sweet and loaded with enzymes. Ideal for breakfast.'],
            ['title' => 'Watermelon',            'category' => 'fruits',           'price' => 30, 'short_description' => 'Crisp, sweet watermelons grown in the sun-drenched fields of central Trinidad.'],
            ['title' => 'Banana (Cavendish)',   'category' => 'fruits',           'price' => 12, 'short_description' => 'Classic Cavendish bananas — great for snacking, smoothies, and baking.'],
            ['title' => 'Plantain (Ripe)',       'category' => 'fruits',           'price' => 14, 'short_description' => 'Perfectly ripened plantains, ready for frying into sweet maduros.'],
            ['title' => 'Sugar Apple (Sweetsop)','category' => 'fruits',           'price' => 22, 'short_description' => 'Creamy, fragrant sugar apples with a custard-like sweetness. A real local treasure.'],
            ['title' => 'Sapodilla (Naseberry)', 'category' => 'fruits',           'price' => 18, 'short_description' => 'Brown-skinned sapodillas with a malty, caramel sweetness that is unique to the Caribbean.'],
            ['title' => 'Soursop',               'category' => 'fruits',           'price' => 28, 'short_description' => 'Prickly soursop with a tangy-sweet pulp. Famously used for juice, ice cream, and teas.'],
            ['title' => 'Golden Apple (Pommecythere)', 'category' => 'fruits',    'price' => 10, 'short_description' => 'Crunchy golden apples — perfect for making tangy chow with peppers and shadow beni.'],
            ['title' => 'Passion Fruit',         'category' => 'fruits',           'price' => 20, 'short_description' => 'Intensely aromatic passion fruit packed with antioxidants. Great for drinks and desserts.'],
            ['title' => 'Guava',                 'category' => 'fruits',           'price' => 15, 'short_description' => 'Pink-fleshed guavas with a floral, sweet-tart flavour. Used fresh or for guava cheese.'],
            ['title' => 'Tamarind',              'category' => 'fruits',           'price' => 12, 'short_description' => 'Tangy tamarind pods — the base of Trinidad\'s favourite pepper sauce and sweet tamarind balls.'],
            ['title' => 'Coconut (Dry)',         'category' => 'fruits',           'price' => 10, 'short_description' => 'Mature dry coconuts for grating, coconut milk, and traditional desserts.'],
            ['title' => 'Coconut (Jelly)',       'category' => 'fruits',           'price' => 12, 'short_description' => 'Fresh jelly coconuts with cool refreshing water and soft, silky jelly meat.'],
            ['title' => 'Orange',                'category' => 'fruits',           'price' => 15, 'short_description' => 'Locally grown oranges — juicy, sweet, and ideal for fresh-squeezed morning juice.'],
            ['title' => 'Lime',                  'category' => 'fruits',           'price' => 10, 'short_description' => 'Bright, acidic limes essential for cooking, cocktails, and seasoning meat.'],
            ['title' => 'Grapefruit',            'category' => 'fruits',           'price' => 18, 'short_description' => 'Large, tangy grapefruits — great for juicing or eating fresh with a sprinkle of salt.'],
            ['title' => 'Portugal (Mandarin)',   'category' => 'fruits',           'price' => 16, 'short_description' => 'Easy-peel Portugal mandarins with a sweet, mellow flavour beloved by children and adults alike.'],
            ['title' => 'Five Finger (Carambola)', 'category' => 'fruits',        'price' => 14, 'short_description' => 'Star-shaped five fingers with a crisp, tart flavour. Makes beautiful garnishes and fresh chow.'],
            ['title' => 'West Indian Cherry',    'category' => 'fruits',           'price' => 20, 'short_description' => 'Tiny but powerful — West Indian cherries are among the richest natural sources of Vitamin C.'],
            ['title' => 'Pomerac (Otaheite Apple)', 'category' => 'fruits',       'price' => 16, 'short_description' => 'Rose-water-scented pomerac with crisp white flesh. Refreshing eaten fresh or made into jam.'],
            ['title' => 'Caimite (Star Apple)',  'category' => 'fruits',           'price' => 22, 'short_description' => 'Smooth-skinned caimite with a milky, sweet purple flesh. A favourite after-school snack.'],
            ['title' => 'Breadfruit',            'category' => 'fruits',           'price' => 18, 'short_description' => 'Versatile breadfruit that can be roasted, fried, or boiled. A true Caribbean staple.'],
            ['title' => 'Jackfruit',             'category' => 'fruits',           'price' => 35, 'short_description' => 'Massive, flavourful jackfruit with a sweet aroma. Eaten ripe as a fruit or green as a meat substitute.'],

            // ── VEGETABLES ────────────────────────────────────────────────────
            ['title' => 'Tomato',                'category' => 'vegetables',       'price' => 15, 'short_description' => 'Ripe, locally grown tomatoes perfect for sauces, salads, and curries.', 'classification' => 'featured'],
            ['title' => 'Onion (White)',          'category' => 'vegetables',       'price' => 12, 'short_description' => 'Fresh white onions essential to every Trinidadian cook\'s pantry.'],
            ['title' => 'Garlic',                'category' => 'vegetables',       'price' => 15, 'short_description' => 'Aromatic fresh garlic grown locally. Used in almost every savoury dish.'],
            ['title' => 'Scotch Bonnet Pepper',  'category' => 'vegetables',       'price' => 18, 'short_description' => 'Fiery Scotch bonnets — the backbone of Trinidadian pepper sauce and hot cooking.'],
            ['title' => 'Sweet Pepper',          'category' => 'vegetables',       'price' => 14, 'short_description' => 'Colourful sweet peppers for stir-fries, stuffing, and fresh salads.'],
            ['title' => 'Seasoning Pepper',      'category' => 'vegetables',       'price' => 12, 'short_description' => 'Mild flavour-packed seasoning peppers — used for their aroma rather than heat.'],
            ['title' => 'Patchoi (Bok Choy)',    'category' => 'vegetables',       'price' => 14, 'short_description' => 'Tender green patchoi leaves ideal for stir-frying with garlic and oyster sauce.'],
            ['title' => 'Bhaji (Spinach)',        'category' => 'vegetables',       'price' => 13, 'short_description' => 'Soft, leafy bhaji used in the classic Trinidadian spin-off of saag.'],
            ['title' => 'Cabbage',               'category' => 'vegetables',       'price' => 16, 'short_description' => 'Crisp local cabbage — great for coleslaw, stir-fries, and pelau garnish.'],
            ['title' => 'Lettuce',               'category' => 'vegetables',       'price' => 14, 'short_description' => 'Fresh, crunchy lettuce heads perfect for salads, wraps, and sandwiches.'],
            ['title' => 'Carrot',                'category' => 'vegetables',       'price' => 13, 'short_description' => 'Firm, sweet carrots grown locally. A staple in pelau, stews, and juicing.'],
            ['title' => 'Cucumber',              'category' => 'vegetables',       'price' => 12, 'short_description' => 'Cool, crisp cucumbers — great in salads, raita, and chilled water.'],
            ['title' => 'Ochro (Okra)',           'category' => 'vegetables',       'price' => 14, 'short_description' => 'Fresh ochro for traditional crab and callaloo or roasted as a side dish.'],
            ['title' => 'Christophene (Chayote)', 'category' => 'vegetables',      'price' => 13, 'short_description' => 'Mild, versatile christophene — great steamed, stuffed, or added to stews.'],
            ['title' => 'Pumpkin',               'category' => 'vegetables',       'price' => 20, 'short_description' => 'Golden-fleshed pumpkin perfect for pumpkin rice, soups, and curries.', 'classification' => 'featured'],
            ['title' => 'Eggplant (Melongene)',  'category' => 'vegetables',       'price' => 15, 'short_description' => 'Glossy purple melongene for baiganee, choka, and curries.'],
            ['title' => 'Corn (Maize)',          'category' => 'vegetables',       'price' => 12, 'short_description' => 'Sweet, fresh corn on the cob. Boil it, roast it, or grill it at your next lime.'],

            // ── GROUND PROVISIONS ─────────────────────────────────────────────
            ['title' => 'Dasheen',               'category' => 'ground-provisions','price' => 18, 'short_description' => 'Starchy dasheen root — the heart of callaloo and a must-have side for any Sunday lunch.'],
            ['title' => 'Yam',                   'category' => 'ground-provisions','price' => 20, 'short_description' => 'Earthy, filling yam boiled or roasted alongside saltfish and provision.'],
            ['title' => 'Cassava (Yuca)',        'category' => 'ground-provisions','price' => 15, 'short_description' => 'Fresh cassava root for making cassava pone, frying, or boiling as a provision.'],
            ['title' => 'Sweet Potato',          'category' => 'ground-provisions','price' => 16, 'short_description' => 'Orange-fleshed sweet potatoes that are naturally sweet and nutrient-dense.'],
            ['title' => 'Irish Potato',          'category' => 'ground-provisions','price' => 14, 'short_description' => 'Versatile white potatoes for curries, macaroni pie, and potato balls.'],
            ['title' => 'Eddoe',                 'category' => 'ground-provisions','price' => 15, 'short_description' => 'Small, hairy eddoes with a creamy texture. A traditional Trini Sunday lunch staple.'],
            ['title' => 'Tannia (Cocoyam)',      'category' => 'ground-provisions','price' => 16, 'short_description' => 'Tannia with a rich, starchy flesh. Often used alongside dasheen in provisions.'],
            ['title' => 'Green Fig (Unripe Banana)', 'category' => 'ground-provisions', 'price' => 14, 'short_description' => 'Firm green figs boiled and eaten as a ground provision — hearty and filling.'],

            // ── HERBS & SEASONINGS ────────────────────────────────────────────
            ['title' => 'Shadow Beni (Culantro)', 'category' => 'herbs',           'price' => 10, 'short_description' => 'Intensely aromatic shadow beni — the signature herb of Trinidadian green seasoning.', 'classification' => 'featured'],
            ['title' => 'Thyme',                 'category' => 'herbs',            'price' => 10, 'short_description' => 'Fresh thyme sprigs for stews, meats, and rice dishes.'],
            ['title' => 'Chive (Spring Onion)',  'category' => 'herbs',            'price' => 10, 'short_description' => 'Fresh chives — an essential ingredient in homemade green seasoning.'],
            ['title' => 'Parsley',               'category' => 'herbs',            'price' => 10, 'short_description' => 'Curly parsley for garnishing, salads, and flavouring sauces.'],
            ['title' => 'Celery',                'category' => 'herbs',            'price' => 12, 'short_description' => 'Crunchy celery stalks used fresh in salads or as a base for Trini-style stocks.'],
            ['title' => 'Basil',                 'category' => 'herbs',            'price' => 12, 'short_description' => 'Fragrant basil leaves for pasta, salads, and fresh pesto.'],

            // ── SEASONINGS ────────────────────────────────────────────────────
            ['title' => 'Ginger',                'category' => 'seasonings',       'price' => 13, 'short_description' => 'Fresh ginger root for ginger beer, chai, stir-fries, and marinades.'],
            ['title' => 'Turmeric Root',         'category' => 'seasonings',       'price' => 14, 'short_description' => 'Fresh turmeric root for curries, golden milk, and natural food colouring.'],
            ['title' => 'Pimento Pepper',        'category' => 'seasonings',       'price' => 12, 'short_description' => 'Mild allspice pimento peppers used to season meat and add depth to sauces.'],
            ['title' => 'Bodi Beans (Yardlong)', 'category' => 'vegetables',       'price' => 13, 'short_description' => 'Long, slender bodi beans for curries, stir-fries, and side dishes.'],
            ['title' => 'Pigeon Peas (Fresh)',   'category' => 'vegetables',       'price' => 16, 'short_description' => 'Fresh pigeon peas — the star of pelau and a staple of Trinidadian cooking.', 'classification' => 'featured'],
            ['title' => 'Green Seasoning Blend', 'category' => 'seasonings',       'price' => 20, 'short_description' => 'Pre-blended fresh green seasoning with shadow beni, chive, thyme, and garlic. Ready to use.', 'classification' => 'featured'],
        ];

        foreach ($products as $item) {
            // Factory handles randomImage(); we override everything else with real data
            Product::factory()->create([
                'title'             => $item['title'],
                'short_description' => $item['short_description'],
                'full_description'  => $item['short_description'] . ' Freshly harvested and delivered directly from local farms across Trinidad and Tobago.',
                'category'          => $item['category'],
                'price'             => $item['price'],
                'classification'    => $item['classification'] ?? 'default',
                'status'            => 'active',
            ]);
        }
    }
}
