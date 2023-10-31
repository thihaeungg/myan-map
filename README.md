Myanmap Composer Package
============

ကိုယ်တိုယ်လဲအသုံးပြုဖို့ရည်ရွယ်တာတစ်ကြောင်းရယ် တခြားသုံးချင်တဲ့ သူ ရှိရင်လည်း သုံးရအောင် ရေးရခြင်းဖြစ်ပါတယ်

Requirements
------------

* PHP >= 7.3;
* composer.

Features
--------

* PSR-4 autoloading compliant structure;
* Comprehensive guide and tutorial;
* Easy to use with Laravel Framework;

Installation
============

    composer require thiha-morph/myan-map
    
This will create a basic project structure for you:

* **/src** is where your codes will live in, each class will need to reside in its own file inside this folder;
* **.gitignore** there are certain files that we don't want to publish in Git, so we just add them to this fle for them to "get ignored by git";
* **LICENSE** terms of how much freedom other programmers is allowed to use this library;
* **README.md** it is a mini documentation of the library, this is usually the "home page" of your repo if you published it on GitHub and Packagist;
* **composer.json** is where the information about your library is stored, like package name, author and dependencies;

Setup & Data Seeding
============

Publish Tables:
--------

    php artisan vendor:publish --provider="ThihaMorph\MyanMap\DatabaseServiceProvider"
 
Run Command For Data Adding Into Your Database:
------------------

    php artisan myanmap:data

License
=======

Please refer to [LICENSE](https://github.com/thihaeungg/myan-map/blob/main/LICENSE).
