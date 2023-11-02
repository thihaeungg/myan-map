Myan Map Composer Package
============

ကိုယ်တိုယ်လဲအသုံးပြုဖို့ရည်ရွယ်တာတစ်ကြောင်းရယ် တခြားသုံးချင်တဲ့ သူ ရှိရင်လည်း သုံးရအောင် ရေးရခြင်းဖြစ်ပါတယ်

15 State & Regions,
6 Self Administers,
295 Cities,
Yangon Mandalay Naypyitaw Townships

Requirements
------------

* PHP >= 7.3;
* composer.

Features
--------

* PSR-4 autoloading compliant structure;
* Easy to use with Laravel Framework;

Installation
============

    composer require thiha-morph/myan-map
    
Setup & Data Seeding
============

Publish Tables:
--------

    php artisan vendor:publish --provider="ThihaMorph\MyanMap\DatabaseServiceProvider"
 
And

    php artisan migrate
    
Run Command For Data Adding Into Your Database:
------------------

    php artisan myanmap:data

* **Note** You can refresh the State,SelfAdminister,City,Township Data by this command and remember that command will be fresh these table data and will covert to default

Usage:
------------------

* **Eloquent** State,SelfAdminister,City,Township. You can manage the query [Eloquent](https://laravel.com/docs/10.x/eloquent).

* **State Relationship Query** cities,self_administers,capital,cities.townships,self_administers.capital. Example:

    State::with(['cities', 'self_administers', 'capital'])->first();

    State::with(['cities', 'self_administers', 'capital'])->get();

    State::with(['cities.townships', 'self_administers.capital'])->first();
    
    State::with(['cities.townships', 'self_administers.capital'])->get();

* **Self Administer Relationship Query** cities,state,capital,cities.townships. Example:

    SelfAdminister::with(['cities', 'state', 'capital'])->first();

    SelfAdminister::with(['cities', 'state', 'capital'])->get();

    SelfAdminister::with(['cities.townships'])->first();

    SelfAdminister::with(['cities.townships'])->get();

* **City Relationship Query** townships,state,self_administer, self_administer.capital, state.cities. Example:

    City::with(['townships', 'self_administer', 'state'])->first();

    City::with(['townships', 'self_administer', 'state'])->get();

    City::with(['self_administer.capital', 'state.cities'])->first();

    City::with(['self_administer.capital', 'state.cities'])->get();

* **Township Relationship Query** city. Example:

    Township::with(['city'])->first();

    Township::with(['city'])->get();

    Township::with(['city.state', 'city.self_administer'])->first();

    Township::with(['city.state', 'city.self_administer'])->get();

* **Eloquent Command**. For the command for eloquent, you can simply use like you always use Create,Delete,Update,Status Update ( Example - Active ( true ) , Inactive ( false ));

* **Font Conversion** Currently Default Font is Unicode but anyway you can use name_mm_zg for Zawgyi Font instead of name_mm ( Credit - Rabbit-PHP )

License
=======

Please refer to [LICENSE](https://github.com/thihaeungg/myan-map/blob/main/LICENSE).
