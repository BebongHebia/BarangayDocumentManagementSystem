<?php

use App\Http\Controllers\MasterListController;
use App\Http\Controllers\ProfilePicController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\MasterList;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Routes
Route::get('/', function () {
    return view('Auth.Login');
});

Route::get('/profile', function(){
    if (Auth::check()){

        if (auth()->user()->role == "Admin"){
            return view('Users.Admin.Dashboard');
        }elseif (auth()->user()->role == "User"){
            return view('Users.User.Profile');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/dashboard', function(){
    if (Auth::check()){
        if (auth()->user()->role == "Admin"){
            return view('Users.Admin.Dashboard');
        }elseif (auth()->user()->role == "User"){
            return view('Users.User.Dashboard');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/users', function(){
    if (Auth::check()){
        if (auth()->user()->role == "Admin"){
            return view('Users.Admin.Users');
        }
    }else{
        return redirect('/');
    }
});
Route::get('/masterlists', function(){
    if (Auth::check()){
        if (auth()->user()->role == "Admin"){
            return view('Users.Admin.MasterLists');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/transactions', function(){
    if (Auth::check()){
        if (auth()->user()->role == "Admin"){
            return view('Users.Admin.Transactions');
        }elseif (auth()->user()->role == "User"){
            return view('Users.User.Transactions');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/request-document', function(){
    if (Auth::check()){
        if (auth()->user()->role == "User"){

            return view('Users.User.RequestDocument');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/view-transaction/transaction-code={transactionCode}', function($transactionCode){
    if (Auth::check()){
        if (auth()->user()->role == "Admin"){
            $data = Transaction::where('code', $transactionCode)->with(['user'])->get()->first();
            return view('Users.Admin.ViewTransaction', ['transaction' => $data]);
        }
    }else{
        return redirect('/');
    }
});


Route::get('/get-master-lists', function(){
    return view('Auth.SearchMasterLists');
});




//Authentications Controls
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//Function Controls
Route::post('/add-user', [UserController::class, 'addUser']);
Route::post('/edit-user', [UserController::class, 'editUser']);
Route::post('/delete-user', [UserController::class, 'deleteUser']);
Route::post('/edit-profile', [UserController::class, 'editProfile']);

Route::post('/add-masterlist', [MasterListController::class, 'addMasterLists']);
Route::post('/edit-masterlist', [MasterListController::class, 'editMasterLists']);
Route::post('/delete-masterlist', [MasterListController::class, 'deleteMasterLists']);


Route::post('/upload-image', [ProfilePicController::class, 'uploadImage']);

Route::post('/register', [UserController::class, 'register']);

Route::post('/submit-request', [TransactionController::class, 'addRequest']);
Route::post('/edit-transaction', [TransactionController::class, 'editTransaction']);
Route::post('/delete-transaction', [TransactionController::class, 'deleteTransaction']);
Route::post('/process-request', [TransactionController::class, 'processRequest']);

//Getter Controls
Route::get('/get-users/option={option}/filter={filter}', function($option, $filter){
    if ($option == "All"){
        $data = User::where("role", "!=", "Admin")->get();
        return response()->json($data);
    }else{
        $data = User::where($option, $filter)->where("role", "!=", "Admin")->get();
         return response()->json($data);
    }
});

Route::get('/get-user/user-id={userId}', function($userId){
    $data = User::find($userId);
    return response()->json($data);
});

Route::get('/get-masterlists', function(){
    $data = MasterList::with(['user'])->get();
    return response()->json($data);
});

Route::get('/get-masterlist/list-id={listId}', function($listId){
    $data = MasterList::find($listId);
    return response()->json($data);
});

Route::post('/search-masterlists', function(Request $request){
     $query = MasterList::query();

        // Apply filters if values are provided
        if ($request->filled('firstName')) {
            $query->where('firstName', 'LIKE', '%' . $request->firstName . '%');
        }

        if ($request->filled('middleName')) {
            $query->where('middleName', 'LIKE', '%' . $request->middleName . '%');
        }

        if ($request->filled('lastName')) {
            $query->where('lastName', 'LIKE', '%' . $request->lastName . '%');
        }

        // If no search criteria, return all records
        if (!$request->filled('firstName') &&
            !$request->filled('middleName') &&
            !$request->filled('lastName')) {
            $masterLists = MasterList::all();
        } else {
            $masterLists = $query->get();
        }

        return response()->json($masterLists);
});
Route::get('/register/list-code={listCode}', function($listCode){

    $data = User::where('listCode', $listCode)->count();
    if ($data > 0){
        return redirect('/');
    } else {
        return view('Auth.Register', ['listCode' => $listCode]);
    }

})->name('register.check');


Route::get('/get-profile-details/user-code={userCode}', function($userCode){
    $data = User::where('userCode', $userCode)->get()->first();
    return response()->json($data);
});

Route::get('/get-transactions/user-code={userCode}', function($userCode){

    if (auth()->user()->role == "Admin"){
        $data = Transaction::with(['user'])->get();
        return response()->json($data);
    }else{
        $data = Transaction::where('userCode', $userCode)->with(['user'])->get();
        return response()->json($data);
    }

});

Route::get('/get-transactions/transaction-code={transactionCode}', function($transactionCode){
    $data = Transaction::where('code', $transactionCode)->with(['user'])->get()->first();
    return response()->json($data);
});
