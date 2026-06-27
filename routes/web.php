<?php

use App\Http\Controllers\ActImageController;
use App\Http\Controllers\AnnImageController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CalendarActivityController;
use App\Http\Controllers\MasterListController;
use App\Http\Controllers\ProfilePicController;
use App\Http\Controllers\StaffOfficialController;
use App\Http\Controllers\StaffOfficialProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Announcement;
use App\Models\CalendarActivity;
use App\Models\MasterList;
use App\Models\Payment;
use App\Models\StaffOfficial;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

//Routes
Route::get('/', function () {
    return view('Auth.Login');
});

Route::get('/profile', function(){
    if (Auth::check()){



        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Dashboard');
        }elseif (Auth::user()->role == "User"){
            return view('Users.User.Profile');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/dashboard', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Dashboard');
        }elseif (Auth::user()->role == "User"){
            return view('Users.User.Dashboard');
        }elseif (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.Dashboard');
        }elseif (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.Dashboard');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/users', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Users');
        }
    }else{
        return redirect('/');
    }
});
Route::get('/masterlists', function(){
    if (Auth::check()){
        if (Auth::user()->role== "Admin"){
            return view('Users.Admin.MasterLists');
        }else if (Auth::user()->role== "Punong Barangay"){
            return view('Users.Kapitan.MasterLists');
        }else if (Auth::user()->role== "Incharge"){
            return view('Users.Incharge.MasterLists');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/transactions', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Transactions');
        }elseif (Auth::user()->role == "User"){
            return view('Users.User.Transactions');
        }elseif (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.Transactions');
        }elseif (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.Transactions');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/resident-accounts', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.ResidentAccount');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Admin.ResidentAccount');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.ResidentAccount');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/request-document', function(){
    if (Auth::check()){
        if (Auth::user()->role == "User"){

            return view('Users.User.RequestDocument');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/staff-officials', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.StaffOfficial');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.StaffOfficial');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.StaffOfficial');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/organization-chart', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.OrganizationChart');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.OrganizationChart');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.OrganizationChart');
        }else if (Auth::user()->role == "User"){
            return view('Users.User.OrganizationChart');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/population', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Population');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.Population');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.Population');
        }else if (Auth::user()->role == "User"){
            return view('Users.User.Population');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/calendar-of-activities', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.CalendarOfActivities');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.CalendarOfActivities');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.CalendarOfActivities');
        }else if (Auth::user()->role == "User"){
            return view('Users.User.CalendarOfActivities');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/announcement', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Announcement');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.Announcement');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.Announcement');
        }else if (Auth::user()->role == "User"){
            return view('Users.User.Announcement');
        }
    }else{
        return redirect('/');
    }
});

Route::get('/reports', function(){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            return view('Users.Admin.Reports');
        }else if (Auth::user()->role == "Punong Barangay"){
            return view('Users.Kapitan.Reports');
        }else if (Auth::user()->role == "Incharge"){
            return view('Users.Incharge.Reports');
        }
    }else{
        return redirect('/');
    }
});



Route::get('/view-transaction/transaction-code={transactionCode}', function($transactionCode){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            $data = Transaction::where('code', $transactionCode)->with(['user'])->first();
            return view('Users.Admin.ViewTransaction', ['transaction' => $data]);
        }else if (Auth::user()->role == "Punong Barangay"){
            $data = Transaction::where('code', $transactionCode)->with(['user'])->first();
            return view('Users.Kapitan.ViewTransaction', ['transaction' => $data]);
        }else if (Auth::user()->role == "Incharge"){
            $data = Transaction::where('code', $transactionCode)->with(['user'])->first();
            return view('Users.Incharge.ViewTransaction', ['transaction' => $data]);
        }
    }else{
        return redirect('/');
    }
});

Route::get("/transactions/print-transaction/transaction-code={transactionCode}", function($transactionCode){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            $data = Transaction::where('code', $transactionCode)->with(['user', 'payment'])->first();
            return view('Users.Admin.PrintDocument', ['transaction' => $data]);
        }else if (Auth::user()->role == "Punong Barangay"){
            $data = Transaction::where('code', $transactionCode)->with(['user', 'payment'])->first();
            return view('Users.Kapitan.PrintDocument', ['transaction' => $data]);
        }else if (Auth::user()->role == "Incharge"){
            $data = Transaction::where('code', $transactionCode)->with(['user', 'payment'])->first();
            return view('Users.Incharge.PrintDocument', ['transaction' => $data]);
        }
    }else{
        return redirect('/');
    }
});

Route::get("/resident-accounts/view-account/user-code={userCode}", function($userCode){
    if (Auth::check()){
        if (Auth::user()->role == "Admin"){
            $data = User::where('userCode', $userCode)->first();
            return view('Users.Admin.ViewResidentAccount', ['user' => $data]);
        }else if (Auth::user()->role == "Punong Barangay"){
            $data = User::where('userCode', $userCode)->first();
            return view('Users.Kapitan.ViewResidentAccount', ['user' => $data]);
        }else if (Auth::user()->role == "Incharge"){
            $data = User::where('userCode', $userCode)->first();
            return view('Users.Incharge.ViewResidentAccount', ['user' => $data]);
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
Route::post('/approve-request', [TransactionController::class, 'approveRequest']);
Route::post('/reject-request', [TransactionController::class, 'rejectRequest']);

Route::post('/add-staff-official', [StaffOfficialController::class, 'addStaffOfficial']);

Route::post('/edit-staff-official-status', [StaffOfficialController::class, 'editStatus']);
Route::post('/remove-staff-official', [StaffOfficialController::class, 'deleteStatus']);

Route::post('/upload-staff-image', [StaffOfficialProfileController::class, 'store'])->name('upload.staff.image');

Route::post('/add-calendar-activity', [CalendarActivityController::class, 'addCalendarActivity']);
Route::post('/edit-calendar-activity', [CalendarActivityController::class, 'editCalendarActivity']);
Route::post('/delete-calendar-activity', [CalendarActivityController::class, 'deleteCalendarActivity']);

Route::post('/calendar-image/upload/{activityId}', [ActImageController::class, 'uploadImage'])->name('calendar.image.upload');
Route::delete('/calendar-image/delete/{activityId}', [ActImageController::class, 'deleteImage'])->name('calendar.image.delete');

Route::post('/add-announcement', [AnnouncementController::class, 'addAnnouncement']);
Route::post('/edit-announcement', [AnnouncementController::class, 'editAnnouncement']);
Route::post('/delete-announcement', [AnnouncementController::class, 'deleteAnnouncement']);

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

    if (Auth::user()->role == "Admin"){
        $data = Transaction::with(['user'])->get();
        return response()->json($data);
    }else if (Auth::user()->role == "Punong Barangay"){
        $data = Transaction::with(['user'])->get();
        return response()->json($data);
    }else if (Auth::user()->role == "Incharge"){
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

Route::get('/get-latest-ced-or-no', function(){
    $data = Payment::latest()->first();
    return response()->json($data);
});

Route::get("/get-resident-accounts", function(){
    $data = User::where("role", "User")->get();
    return response()->json($data);
});

Route::get('/get-staff-officials', function(){
    $data = StaffOfficial::with(['staffImage'])->get();
    return response()->json($data);
});

Route::get('/get-staff-official/code={code}', function($code){
    $data = StaffOfficial::where('code', $code)->with(['staffImage'])->get()->first();
    return response()->json($data);
});

Route::get('/get-population/option={option}/filter={filter}', function($option, $filter){
    if ($option == "All"){
        $data = User::where('role' , '!=', "Admin")->get();
        return response()->json($data);
    }else{
        if ($option == "Sector"){
            $data = User::where('purok', $filter)->where('role' , '!=', "Admin")->get();
            return response()->json($data);
        }else if ($option == "Sex"){
            $data = User::where('sex', $filter)->where('role' , '!=', "Admin")->get();
            return response()->json($data);
        }else if ($option == "Civil Status"){
            $data = User::where('civilStatus', $filter)->where('role' , '!=', "Admin")->get();
            return response()->json($data);
        }else if ($option == "Status"){
            $data = User::where('status', $filter)->where('role' , '!=', "Admin")->get();
            return response()->json($data);
        }
    }
});

Route::get('/get-calendar-activity', function(){
    $data = CalendarActivity::with(['getCalActImage'])->get();
    return response()->json($data);
});

Route::get('/get-calendar-act/act-id={actId}', function($actId){
    $data = CalendarActivity::with(['getCalActImage'])->find($actId);
    return response()->json($data);
});

Route::get('/get-announcements', function(){
    $data = Announcement::with('image')->get();
    return response()->json($data);
});

Route::get('/get-announcement/announcement-id={annId}', function($annId){
    $data = Announcement::with(['image'])->find($annId);
    return response()->json($data);
});

// Add these routes
Route::post('/upload-announcement-image', [AnnImageController::class, 'upload'])->name('upload.announcement.image');
Route::get('/get-announcement-image/{annId}', [AnnImageController::class, 'getImage']);


Route::get('/get-transaction-reports', function(Request $request){
    try {
        Log::info('Transaction reports endpoint called', ['request' => $request->all()]);
        
        $filterType = $request->get('filter_type', 'daily');
        
        // Start with base query
        $query = Transaction::where('status', 'Approved')->with(['user', 'payment']);
        
        switch ($filterType) {
            case 'daily':
                if ($request->has('date')) {
                    $dateInput = $request->get('date');
                    Log::info('Raw date input:', ['date' => $dateInput]);
                    
                    try {
                        // Parse the date from YYYY-MM-DD format
                        $date = Carbon::parse($dateInput);
                        
                        // Create both formats for comparison
                        $format1 = $date->format('Y-m-d'); // 2026-06-12
                        $format2 = $date->format('m-d-Y'); // 06-12-2026
                        $format3 = $date->format('m/d/Y'); // 06/12/2026
                        
                        Log::info('Searching for dates:', [
                            'format1' => $format1,
                            'format2' => $format2,
                            'format3' => $format3
                        ]);
                        
                        // Search for any of the formats
                        $query->where(function($q) use ($format1, $format2, $format3) {
                            $q->where('dateCreated', $format1)
                              ->orWhere('dateCreated', $format2)
                              ->orWhere('dateCreated', $format3);
                        });
                        
                    } catch (\Exception $e) {
                        Log::error('Date parsing error:', ['error' => $e->getMessage()]);
                    }
                }
                break;
                
            case 'weekly':
                if ($request->has('week')) {
                    $week = $request->get('week');
                    $year = substr($week, 0, 4);
                    $weekNumber = substr($week, 6);
                    
                    $startDate = Carbon::now()->setISODate($year, $weekNumber)->startOfWeek();
                    $endDate = Carbon::now()->setISODate($year, $weekNumber)->endOfWeek();
                    
                    // Check for dates in both formats within the week range
                    $startFormats = [
                        $startDate->format('Y-m-d'),
                        $startDate->format('m-d-Y'),
                        $startDate->format('m/d/Y')
                    ];
                    $endFormats = [
                        $endDate->format('Y-m-d'),
                        $endDate->format('m-d-Y'),
                        $endDate->format('m/d/Y')
                    ];
                    
                    $query->where(function($q) use ($startFormats, $endFormats) {
                        foreach ($startFormats as $index => $start) {
                            $end = $endFormats[$index];
                            // Use string comparison since dates are stored as strings
                            $q->orWhereBetween('dateCreated', [$start, $end]);
                        }
                    });
                }
                break;
                
            case 'monthly':
                if ($request->has('month')) {
                    $month = $request->get('month');
                    $parsedDate = Carbon::parse($month);
                    
                    $monthNum = $parsedDate->format('m');
                    $year = $parsedDate->format('Y');
                    
                    // For MM-DD-YYYY format
                    $query->where(function($q) use ($monthNum, $year) {
                        // Check for MM-DD-YYYY format
                        $q->where('dateCreated', 'like', $monthNum . '-%-' . $year)
                        // Check for MM/DD/YYYY format
                        ->orWhere('dateCreated', 'like', $monthNum . '/%/' . $year)
                        // Check for MM-YYYY format
                        ->orWhere('dateCreated', 'like', $monthNum . '-' . $year)
                        // Check for MM/YYYY format
                        ->orWhere('dateCreated', 'like', $monthNum . '/' . $year)
                        // Check for YYYY-MM-DD format
                        ->orWhere('dateCreated', 'like', $year . '-' . $monthNum . '-%');
                    });
                    
                    Log::info('Monthly filter applied', ['month' => $monthNum, 'year' => $year]);
                }
                break;
                
            case 'yearly':
                if ($request->has('year')) {
                    $year = $request->get('year');
                    
                    $query->where(function($q) use ($year) {
                        $q->where('dateCreated', 'like', $year . '%')    // 2026-06-12
                          ->orWhere('dateCreated', 'like', '%-' . $year)  // 06-12-2026
                          ->orWhere('dateCreated', 'like', '%/' . $year); // 06/12/2026
                    });
                }
                break;
        }
        
        $data = $query->get();
        Log::info('Query executed', ['count' => $data->count()]);
        
        // If no data found, return all approved transactions for debugging
        if ($data->isEmpty()) {
            Log::info('No data found with filter');
            $allData = Transaction::where('status', 'Approved')
                                 ->with(['user', 'payment'])
                                 ->get();
            Log::info('All approved transactions count:', ['count' => $allData->count()]);
        }
        
        return response()->json($data);
        
    } catch (\Exception $e) {
        Log::error('Error in transaction reports endpoint', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
});