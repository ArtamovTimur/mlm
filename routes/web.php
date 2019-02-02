<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

   //\App\Invoice::create(1); // создал счет
   //\App\Invoice::replenish(1, 5000); // поплнил счет
    //App\Invoice::pay(1, 2000); //  списал со счета
    //\App\Tarif::userPay(1, 1); // купил тариф
    //$test->go();
    //var_dump(\App\BinaryTree::getCountChilds(19));
    //return response(\App\BinaryTree::getUserChilds(1), 200);

    //return view('welcome', ['tree' => \App\BinaryTree::getUserChilds(1)]);



   // $node = new \App\BinaryTree(1, 2);
   // $test = new \App\BinaryTree(1, 3);

   // $node = new \App\BinaryTree(2, 4);
   // $test = new \App\BinaryTree(2, 5);

   // $node = new \App\BinaryTree(3, 6);
   // $test = new \App\BinaryTree(3, 7);

   // return response(\App\BinaryTree::getUserChilds(1),200);
    //return response(\App\BinaryTree::getLegCount(1),200);

    //return response(\App\BinaryTree::getUserChildsTop(1), 200);


     //\App\BinaryTree::addSponsor(2, 1);
     //\App\BinaryTree::addSponsor(3, 1);

   //return response(\App\BinaryTree::getTree(1), 200);
    //return response(\App\BinaryTree::getTree(1));





    //\App\PV::createPVInvoice(1); // создание счета для pv
    //var_dump(\App\PV::getPV(1)); // получение по id пользователя
    //\App\PV::replenishPV(1, 300); // увеличение pv(наример при покуаке в магазе)
   // \App\PV::spendTarif(1, 2); // покупка тарифа по неактивиронному pv


});


