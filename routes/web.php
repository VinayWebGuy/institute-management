<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\TicketController;


Route::get('/',[HomeController::class,'login']);
Route::get('/login',[HomeController::class,'login']);
Route::post('/login',[ProcessController::class,'auth']);
Route::post('/login-with-key',[ProcessController::class,'authWithKey']);
Route::get('logout',[ProcessController::class,'logout']);


Route::group(['middleware'=>'loginauth'],function(){
    Route::prefix('/admin')->name('admin.')->namespace('admin')->group(function()
    {
        Route::group(['middleware'=>'adminauth'],function(){
            Route::get('/',[HomeController::class,'admin_index']);
            Route::get('/add-staff',[HomeController::class,'addStaff']);
            Route::get('/all-staff',[HomeController::class,'allStaff']);
            Route::get('/get-state',[HomeController::class,'getState']);
            Route::get('/edit-staff/get-state',[HomeController::class,'getState']);
            Route::get('/get-city',[HomeController::class,'getCity']);
            Route::get('/edit-staff/get-city',[HomeController::class,'getCity']);
            Route::get('/generate-login-key',[ProcessController::class,'generateLoginKey']);
            Route::get('/change-staff-status/{user_id}',[ProcessController::class,'changeStaffStatus']);
            Route::get('/get-user-name',[ProcessController::class,'getUserName']);
            Route::get('delete-user/{user_id}',[ProcessController::class,'deleteUser']);
            Route::get('edit-staff/{user_id}',[HomeController::class,'editStaff']);
            Route::get('manage-staff-salary',[StaffController::class,'manageStaffSalary']);
            Route::get('manage-staff-attendance',[StaffController::class,'manageStaffAttendance']);
            Route::get('save-staff-attendance',[StaffController::class,'saveStaffAttendance']);
            Route::get('get-salary-details',[StaffController::class,'getSalaryDetails']);
            Route::get('staff-attendance/{id}',[StaffController::class,'staffAttendance']);
            
            Route::post('/add-staff',[ProcessController::class,'addStaff'])->name('add-staff');
            Route::post('/edit-staff',[ProcessController::class,'editStaff'])->name('edit-staff');
            Route::post('/manage-staff-salary',[StaffController::class,'saveStaffSalary'])->name('manage-staff-salary');
            Route::get('/provide-staff-salary',[StaffController::class,'provideStaffSalary']);
            Route::get('/add-staff-salary/{key}',[StaffController::class,'addStaffSalary']);
            Route::post('/add-staff-salary}',[StaffController::class,'saveSalary'])->name('add-staff-salary');
            Route::get('/edit-staff-salary/{key}/{sid}',[StaffController::class,'editStaffSalary']);
            Route::post('/edit-staff-salary}',[StaffController::class,'updateSalary'])->name('edit-staff-salary');
            Route::get('/manage-staff-permission/{key}',[StaffController::class,'manageStaffPermission']);
            Route::post('/update-staff-permission',[StaffController::class,'updateStaffPermission'])->name('permission');
            


            Route::get('add-batch',[BatchController::class,'addBatch']);
            Route::post('add-batch',[BatchController::class,'saveBatch'])->name('add-batch');
            Route::get('all-batch',[BatchController::class,'allBatches']);
            Route::get('change-batch-status/{id}',[BatchController::class,'changeBatchStatus']);
            Route::get('edit-batch/{id}',[BatchController::class,'editBatch']);
            Route::post('edit-batch',[BatchController::class,'updateBatch'])->name('edit-batch');

            Route::get('add-student',[StudentController::class,'addStudent']);
            Route::post('add-student',[StudentController::class,'saveStudent'])->name('add-student');
            Route::get('all-students',[StudentController::class,'allStudents']);
            Route::get('/edit-student/get-state',[HomeController::class,'getState']);
            Route::get('/edit-student/get-city',[HomeController::class,'getCity']);
            Route::get('edit-student/{user_id}',[StudentController::class,'editStudent']);
            Route::post('edit-student',[StudentController::class,'updateStudent'])->name('edit-student');
            Route::get('manage-student-attendance',[StudentController::class,'manageStudentAttendance']);
            Route::get('manage-student-fees',[StudentController::class,'manageStudentFees']);
            Route::get('add-student-fees/{key}',[StudentController::class,'addStudentFees']);
            Route::post('add-student-fees',[StudentController::class,'saveStudentFees'])->name('add-student-fees');
            Route::get('change-student-status/{id}',[StudentController::class,'changeStudentStatus']);
            Route::get('student-attendance/{id}',[StudentController::class,'studentAttendance']);

            Route::get('add-study-material',[StudentController::class,'addStudyMaterial']);
            Route::post('add-study-material',[StudentController::class,'saveStudyMaterial'])->name('add-study-material');
            Route::get('all-study-materials',[StudentController::class,'allStudyMaterials']);
            Route::get('change-study-material-status/{id}',[StudentController::class,'changeStudyMaterialStatus']);
            Route::get('delete-study-material/{id}',[StudentController::class,'deleteStudyMaterial']);

            Route::get('expense-manager',[ExpenseController::class,'expenseManager']);
            Route::get('add-expense',[ExpenseController::class,'addExpense']);
            Route::post('add-expense',[ExpenseController::class,'saveExpense'])->name('add-expense');
            

            Route::get('ielts/add-score',[ScoreController::class,'addIeltsScore']);
            Route::post('ielts/save-score',[ScoreController::class,'saveIeltsScore'])->name('ielts.save-score');
            Route::get('ielts/manage-score',[ScoreController::class,'manageIeltsScore']);
            Route::get('ielts/score-report',[ScoreController::class,'ieltsScoreReport']);
            Route::get('ielts/today-score-summary/{key}',[ScoreController::class,'todayIeltsScoreSummary']);
            Route::get('ielts/overall-score-summary/{key}',[ScoreController::class,'overallIeltsScoreSummary']);
            
            
            
            Route::get('pte/manage-score',[ScoreController::class,'managePteScore']);
            Route::get('pte/add-score',[ScoreController::class,'addPteScore']);
            Route::post('pte/save-score',[ScoreController::class,'savePteScore'])->name('pte.save-score');
            Route::get('pte/score-report',[ScoreController::class,'pteScoreReport']);
            Route::get('pte/today-score-summary/{key}',[ScoreController::class,'todayPteScoreSummary']);
            Route::get('pte/overall-score-summary/{key}',[ScoreController::class,'overallPteScoreSummary']);


            Route::get('add-enquiry',[EnquiryController::class,'addEnquiry']);
            Route::post('add-enquiry',[EnquiryController::class,'saveEnquiry'])->name('add-enquiry');
            Route::get('all-enquiries',[EnquiryController::class,'allEnquiries']);
            Route::get('view-enquiry/{id}',[EnquiryController::class,'viewEnquiry']);
            Route::get('download-english-enquiry/{id}',[ReportController::class,'downloadEnglishEnquiry']);
            Route::get('download-study-visa-enquiry/{id}',[ReportController::class,'downloadStudyVisaEnquiry']);
            Route::post('update-enquiry',[EnquiryController::class,'updateEnquiry'])->name('update-enquiry');
            Route::get('delete-enquiry/{id}',[EnquiryController::class, 'deleteEnquiry']);
            
            Route::get('tickets/{type?}',[TicketController::class,'tickets']);
            Route::get('view-ticket/{id}',[TicketController::class,'viewAdminTicket']);
            Route::post('add-ticket-comment',[TicketController::class,'addTicketComment'])->name('add-ticket-comment');
            Route::get('change-ticket-status/{id}/{status}',[TicketController::class,'changeTicketStatus']);
            
            Route::get('add-custom-notification',[HomeController::class,'addCustomNotification']);
            Route::get('all-custom-notifications',[HomeController::class,'allCustomNotifications']);
            Route::post('add-custom-notification',[ProcessController::class,'saveCustomNotification'])->name('add-custom-notification');

            Route::get('add-help-block',[HomeController::class,'addHelpBlock']);
            Route::post('add-help-block',[HomeController::class,'saveHelpBlock'])->name('help');
            Route::get('all-help-block',[HomeController::class,'allHelpBlock']);
            Route::get('change-help-block-status/{status}/{id}',[HomeController::class,'changeHelpBlockStatus']);
            Route::get('edit-help-block/{id}',[HomeController::class,'editHelpBlock']);
            Route::post('edit-help-block',[HomeController::class,'updateHelpBlock'])->name('helpUpdate');
            Route::get('delete-help-block/{id}',[HomeController::class,'deleteHelpBlock']);
            
            Route::get('reports',[ReportController::class,'reports']);
            Route::get('generate-report',[ReportController::class,'generateReport']);
            Route::get('create-pdf',[ReportController::class,'createPDF']);
        });
    });
    Route::prefix('/staff')->name('staff.')->namespace('staff')->group(function()
    {
        Route::group(['middleware'=>'staffauth'],function(){
            Route::get('/',[HomeController::class,'staff_index']);


            Route::get('add-student',[StudentController::class,'addStudent']);
            Route::post('add-student',[StudentController::class,'saveStudent'])->name('add-student');
            Route::get('all-students',[StudentController::class,'allStudents']);
            Route::get('/edit-student/get-state',[HomeController::class,'getState']);
            Route::get('/edit-student/get-city',[HomeController::class,'getCity']);
            Route::get('edit-student/{user_id}',[StudentController::class,'editStudent']);
            Route::post('edit-student',[StudentController::class,'updateStudent'])->name('edit-student');
            Route::get('manage-student-attendance',[StudentController::class,'manageStudentAttendance']);
            Route::get('manage-student-fees',[StudentController::class,'manageStudentFees']);
            Route::get('add-student-fees/{key}',[StudentController::class,'addStudentFees']);
            Route::post('add-student-fees',[StudentController::class,'saveStudentFees'])->name('add-student-fees');
            Route::get('change-student-status/{id}',[StudentController::class,'changeStudentStatus']);
            Route::get('student-attendance/{id}',[StudentController::class,'studentAttendance']);

            Route::get('add-study-material',[StudentController::class,'addStudyMaterial']);
            Route::post('add-study-material',[StudentController::class,'saveStudyMaterial'])->name('add-study-material');
            Route::get('all-study-materials',[StudentController::class,'allStudyMaterials']);
            Route::get('change-study-material-status/{id}',[StudentController::class,'changeStudyMaterialStatus']);
            Route::get('delete-study-material/{id}',[StudentController::class,'deleteStudyMaterial']);

            Route::get('ielts/add-score',[ScoreController::class,'addIeltsScore']);
            Route::post('ielts/save-score',[ScoreController::class,'saveIeltsScore'])->name('ielts.save-score');
            Route::get('ielts/manage-score',[ScoreController::class,'manageIeltsScore']);
            Route::get('ielts/score-report',[ScoreController::class,'ieltsScoreReport']);
            Route::get('ielts/today-score-summary/{key}',[ScoreController::class,'todayIeltsScoreSummary']);
            Route::get('ielts/overall-score-summary/{key}',[ScoreController::class,'overallIeltsScoreSummary']);

            Route::get('pte/manage-score',[ScoreController::class,'managePteScore']);
            Route::get('pte/add-score',[ScoreController::class,'addPteScore']);
            Route::post('pte/save-score',[ScoreController::class,'savePteScore'])->name('pte.save-score');
            Route::get('pte/score-report',[ScoreController::class,'pteScoreReport']);
            Route::get('pte/today-score-summary/{key}',[ScoreController::class,'todayPteScoreSummary']);
            Route::get('pte/overall-score-summary/{key}',[ScoreController::class,'overallPteScoreSummary']);


            Route::get('today-attendance',[StaffController::class,'todayAttendance']);
            Route::get('overall-attendance',[StaffController::class,'overallAttendance']);

            Route::get('reports',[ReportController::class,'reports']);
            Route::get('generate-report',[ReportController::class,'generateReport']);

            Route::get('/get-state',[HomeController::class,'getState']);
            Route::get('/get-city',[HomeController::class,'getCity']);
             Route::get('/generate-login-key',[ProcessController::class,'generateLoginKey']);
             Route::get('/get-user-name',[ProcessController::class,'getUserName']);
            Route::get('delete-user/{user_id}',[ProcessController::class,'deleteUser']);

            Route::get('profile',[HomeController::class,'profile']);
            Route::post('profile',[StaffController::class,'saveProfile'])->name('profile');


            Route::get('add-enquiry',[EnquiryController::class,'addEnquiry']);
            Route::post('add-enquiry',[EnquiryController::class,'saveEnquiry'])->name('add-enquiry');
            Route::get('all-enquiries',[EnquiryController::class,'allEnquiries']);
            Route::get('view-enquiry/{id}',[EnquiryController::class,'viewEnquiry']);
            Route::get('download-english-enquiry/{id}',[ReportController::class,'downloadEnglishEnquiry']);
            Route::get('download-study-visa-enquiry/{id}',[ReportController::class,'downloadStudyVisaEnquiry']);
            Route::post('update-enquiry',[EnquiryController::class,'updateEnquiry'])->name('update-enquiry');
            Route::get('delete-enquiry/{id}',[EnquiryController::class, 'deleteEnquiry']);

            Route::get('raise-ticket',[TicketController::class,'raiseTicket']);
            Route::post('raise-ticket',[TicketController::class,'uploadTicket'])->name('raise-ticket');
            Route::get('my-tickets',[TicketController::class,'myTickets']);
            Route::get('view-ticket/{id}',[TicketController::class,'viewTicket']);
            Route::post('add-ticket-comment',[TicketController::class,'addTicketComment'])->name('add-ticket-comment');

            
        });
    });
    Route::prefix('/student')->name('student.')->namespace('student')->group(function()
    {
        Route::group(['middleware'=>'studentauth'],function(){
            Route::get('/',[HomeController::class,'student_index']);



            Route::get('/get-state',[HomeController::class,'getState']);
            Route::get('/get-city',[HomeController::class,'getCity']);

            Route::get('profile',[HomeController::class,'profile']);
            Route::post('profile',[StudentController::class,'saveProfile'])->name('profile');
            Route::get('study-material',[StudentController::class,'studyMaterial']);

            Route::get('today-score',[ScoreController::class,'todayScore']);
            Route::get('overall-score',[ScoreController::class,'overallScore']);

            Route::get('today-attendance',[StudentController::class,'todayAttendance']);
            Route::get('overall-attendance',[StudentController::class,'overallAttendance']);

            Route::get('raise-ticket',[TicketController::class,'raiseTicket']);
            Route::post('raise-ticket',[TicketController::class,'uploadTicket'])->name('raise-ticket');
            Route::get('my-tickets',[TicketController::class,'myTickets']);
            Route::get('view-ticket/{id}',[TicketController::class,'viewTicket']);
            Route::post('add-ticket-comment',[TicketController::class,'addTicketComment'])->name('add-ticket-comment');
        });
    });
    Route::get('settings',[HomeController::class,'settings']);
    Route::get('two-factor-authentication',[HomeController::class,'twoFactorAuthentication']);
    Route::post('two-factor-authentication',[ProcessController::class,'twoFactorAuthentication'])->name('2fa');
    Route::post('settings',[ProcessController::class,'settings'])->name('settings');
    Route::get('theme-customizer',[HomeController::class,'themeCustomizer']);
    Route::get('change-password',[HomeController::class,'changePassword']);
    Route::post('change-password',[ProcessController::class,'changePassword'])->name('change-password');
    Route::get('discussion-hub',[ChatController::class,'discussionHub']);
    Route::post('discussion-hub',[ChatController::class,'sendDiscussion'])->name('send.discussion');
    
    Route::get('club',[ChatController::class,'club']);
    Route::get('enter-club/{key}',[ChatController::class,'enterClub']);
    Route::post('enter-club',[ChatController::class,'saveClubMessage'])->name('enter-club');
    Route::get('calendar',[HomeController::class,'calendar']);

    Route::get('view-notification/{id}',[ProcessController::class,'viewNotification']);
    Route::get('change-notification-status/{id}',[ProcessController::class,'changeNotificationStatus']);
    Route::get('all-notifications',[ProcessController::class,'allNotifications']);
    Route::get('mark-all-notifications-as-read',[ProcessController::class,'markAllNotificationsAsRead']);
    Route::get('delete-notification/{id}',[ProcessController::class,'deleteNotification']);
    
    Route::get('help',[HomeController::class,'help']);
});
Route::get('let-me-verify-you',[HomeController::class,'letMeVerifyYou']);
Route::post('let-me-verify-you',[ProcessController::class,'letMeVerifyYou'])->name('otp.verify');
Route::get('resend-otp',[ProcessController::class,'resendOtp']);
Route::get('lockscreen',[HomeController::class,'lockscreen']);

Route::post('lockscreen',[ProcessController::class,'lockscreen']);

// Route::get('send-email',[ProcessController::class,'sendEmail']);
Route::get('forget-password',[HomeController::class,'forgetPassword']);
Route::get('forget-password-on-lockscreen',[ProcessController::class,'forgetPasswordOnLockscreen']);
Route::post('forget-password',[ProcessController::class,'forgetPassword']);
Route::get('reset-password/{link}',[HomeController::class,'resetPassword']);
Route::post('reset-password',[ProcessController::class,'resetPassword']);

Route::get('test',function(){
    return view('email.reset-password');
});

Route::get('add-universal-enquiry',[EnquiryController::class,'addUniversalEnquiry']);
  Route::post('add-universal-enquiry',[EnquiryController::class,'saveUniversalEnquiry'])->name('addUniversalEnquiry');