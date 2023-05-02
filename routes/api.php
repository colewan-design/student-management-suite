<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FiltersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\AssignExamController;
use App\Http\Controllers\AssignQuizzesController;
use App\Http\Controllers\StudentTeacherConnectionsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentGradesController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GateController;
//Exports
use App\Exports\StudentsExport;
use App\Exports\GatePassExport;
use App\Exports\AttendanceExport;
use App\Exports\TranscriptStudentExport;
use App\Exports\TopStudentsExport;
use App\Exports\LeastStudentsExport;
use App\Exports\StudentsProfileExport;
use App\Exports\StudentsExportPerFilter;
use Maatwebsite\Excel\Facades\Excel;
//Export Excel
//per filter:
Route::middleware('auth:sanctum')->get('/students/export-per-filter/{section}/{age}/{dropout}/{gender}/{address}', function ($section, $age, $dropout, $gender, $address) {
    return Excel::download(new StudentsExportPerFilter($section, $age, $dropout, $gender, $address), 'students_filtered.xlsx');
});

//per section:
Route::middleware('auth:sanctum')->get('/students/export-per-section/{section}', function ($section) {
    return Excel::download(new StudentsExport($section), 'students_section_'.$section.'.xlsx');
});
//student transcript of records:
Route::middleware('auth:sanctum')->get('/students/export-transcript-records/{student}', function ($studentId) {
    return Excel::download(new TranscriptStudentExport($studentId), 'student_'.$studentId.'.xlsx');
});
//student attendance:
Route::middleware('auth:sanctum')->get('/students/export-attendance/{student}', function ($selectedAttendanceStudent) {
    return Excel::download(new AttendanceExport($selectedAttendanceStudent), 'student_'.$selectedAttendanceStudent.'.xlsx');
});

//least students per section:
Route::middleware('auth:sanctum')->get('/students/export-least-students/{section}', function ($section) {
    return Excel::download(new LeastStudentsExport($section), 'students_section_'.$section.'.xlsx');
});
//top students per section:
Route::middleware('auth:sanctum')->get('/students/export-top-students/{section}', function ($section) {
    return Excel::download(new TopStudentsExport($section), 'students_section_'.$section.'.xlsx');
});
//all students:
Route::middleware('auth:sanctum')->get('/students/export', function () {
    return Excel::download(new StudentsExport, 'students.xlsx');
});
//all students | gate logs:
Route::middleware('auth:sanctum')->get('/gate_logs/export', function () {
    return Excel::download(new GatePassExport, 'gate_logs.xlsx');
});
//all students | gate logs:
Route::middleware('auth:sanctum')->get('/gate_logs/pdf', [PdfController::class, 'generateGateLogsPdf']);


//per student profile:
Route::middleware('auth:sanctum')->get('/student-profile-export/{account_id}', function ($account_id) {
    return Excel::download(new StudentsProfileExport($account_id), 'student_profile_'.$account_id.'.xlsx');
});

//Students Table Routes
Route::middleware('auth:sanctum')->get('/students/pdf', [PdfController::class, 'generatePdf']);
Route::middleware('auth:sanctum')->get('/students/profilepdf', [PdfController::class, 'generateProfilePdf']);
Route::middleware('auth:sanctum')->get('/students/pdf-per-section', [PdfController::class, 'generatePdfPerSection']);
Route::middleware('auth:sanctum')->get('/students/pdf-top-students', [PdfController::class, 'generatePdfTopStudentsPerSection']);
Route::middleware('auth:sanctum')->get('/students/pdf-least-students', [PdfController::class, 'generatePdfLeastStudentsPerSection']);
Route::middleware('auth:sanctum')->get('/students/pdf-transcript-records', [PdfController::class, 'generatePdfTranscriptRecords']);
Route::middleware('auth:sanctum')->get('/students/pdf-attendance', [PdfController::class, 'generatePdfAttendance']);
Route::middleware('auth:sanctum')->get('/students/pdf-per-filter', [PdfController::class, 'generatePdfPerFilter']);
Route::middleware('auth:sanctum')->get('/students/sections', [StudentsController::class, 'getSections']);
Route::middleware('auth:sanctum')->get('/students/genders', [StudentsController::class, 'getGenders']);
Route::middleware('auth:sanctum')->get('/students/addresses', [StudentsController::class, 'getAddresses']);
Route::middleware('auth:sanctum')->get('/students/ages', [StudentsController::class, 'getAges']);
Route::middleware('auth:sanctum')->get('/students/dropouts', [StudentsController::class, 'getDropouts']);
Route::middleware('auth:sanctum')->get('/students/students', [StudentsController::class, 'getStudents']);
//Subject Table Routes:
Route::middleware('auth:sanctum')->get('/subjects/subjects', [SubjectController::class, 'getSubjects']);
// API routes that require authentication
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/authuser', [AuthController::class, 'authuser']);
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    });

    Route::apiResources([
        'samples' => SampleController::class,
        'students' => StudentsController::class,
        'parents' => ParentController::class,
        'staffs' => StaffController::class,
        'teachers' => TeacherController::class,
        'files' => FilesController::class,
    
        'rooms' => RoomController::class,
        'student_teacher_connections' => StudentTeacherConnectionsController::class,
        'announcements' => AnnouncementController::class,
        'quizzes' => QuizController::class,
        'questions' => QuestionController::class,
        'relationships' => RelationshipController::class,
        'accounts' => AccountsController::class,
        'classes' => ClassesController::class,

        'documents' => DocumentsController::class,
    ]);
});

//gate logs
Route::get('/gate_logs', [GateController::class, 'index']);

// Public API routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

 //Student Grades
 Route::get('/student_grades', [StudentGradesController::class, 'index']);
 Route::post('/student_grades/store', [StudentGradesController::class, 'store']);
 Route::post('/student_grades/update', [StudentGradesController::class, 'update']);
 Route::post('/student_grades/checkStudentGrades/{student_id}/{subject_id}', [StudentGradesController::class, 'checkStudentGrades']);

 Route::middleware('auth:sanctum')->get('/student_grades/getStudentGrades', [StudentGradesController::class, 'getStudentGrades']);
//gates
Route::post('/gates/saveLog', [GateController::class, 'saveLog']);
  //classess
  Route::get('/classes', [ClassesController::class, 'index']);
  Route::post('/classes/create', [ClassesController::class, 'store']);
  Route::put('/classes/update/{id}', [ClassesController::class, 'update']);
  Route::delete('/classes/delete/{id}', [ClassesController::class, 'destroy']);
//Accounts
Route::get('/accounts', [AccountsController::class, 'index']);
Route::post('/accounts/create', [AccountsController::class, 'store']);
Route::put('/accounts/update/{id}', [AccountsController::class, 'update']);
Route::delete('/accounts/delete/{id}', [AccountsController::class, 'destroy']);

//attendance
Route::post('/attendance/saveAttendance', [AttendanceController::class, 'saveAttendance']);
Route::get('/attendance/getAttendance', [AttendanceController::class, 'getAttendance']);
//students
 Route::get('/students', [StudentsController::class, 'index']);
 Route::post('/students/create', [StudentsController::class, 'store']);
 Route::put('/students/update/{id}', [StudentsController::class, 'update']);
 Route::delete('/students/delete/{id}', [StudentsController::class, 'destroy']);
 Route::get('/students/count', [StudentsController::class, 'count']);
 //Parent

 Route::get('/parents', [ParentController::class, 'index']);
 Route::post('/parents/create', [ParentController::class, 'store']);
 Route::put('/parents/update/{id}', [ParentController::class, 'update']);
 Route::delete('/parents/delete/{id}', [ParentController::class, 'destroy']);

 //staff

 Route::get('/staffs', [StaffController::class, 'index']);
 Route::post('/staffs/create', [StaffController::class, 'store']);
 Route::put('/staffs/update/{id}', [StaffController::class, 'update']);
 Route::delete('/staffs/delete/{id}', [StaffController::class, 'destroy']);


//teacher
 Route::get('/account', [TeacherController::class, 'account']);
 Route::get('/teachers', [TeacherController::class, 'index']);
 Route::post('/teachers/create', [TeacherController::class, 'store']);
 Route::put('/teachers/update/{id}', [TeacherController::class, 'update']);
 Route::delete('/teachers/delete/{id}', [TeacherController::class, 'destroy']);

 //subjects
 Route::get('/subjects', [SubjectController::class, 'index']);
 Route::get('/subjects/{id}', [SubjectController::class, 'show']);
 Route::post('/subjects/create', [SubjectController::class, 'store']);
 Route::put('/subjects/update/{id}', [SubjectController::class, 'update']);
 Route::delete('/subjects/delete/{id}', [SubjectController::class, 'destroy']);
 //buildings
 Route::get('/buildings', [BuildingsController::class, 'index']);
 Route::post('/buildings/create', [BuildingsController::class, 'store']);
 Route::put('/buildings/update/{id}', [BuildingsController::class, 'update']);
 Route::delete('/buildings/delete/{id}', [BuildingsController::class, 'destroy']);
  //assign exams
  Route::get('/assign_exams', [AssignExamController::class, 'index']);
  Route::post('/assign_exams/create', [AssignExamController::class, 'store']);
  Route::put('/assign_exams/update/{id}', [AssignExamController::class, 'update']);
  Route::delete('/assign_exams/delete/{id}', [AssignExamController::class, 'destroy']);

    //assign exams
    Route::get('/assign_quizzes', [AssignQuizzesController::class, 'index']);
    Route::post('/assign_quizzes/create', [AssignQuizzesController::class, 'store']);
    Route::put('/assign_quizzes/update/{id}', [AssignQuizzesController::class, 'update']);
    Route::delete('/assign_quizzes/delete/{id}', [AssignQuizzesController::class, 'destroy']);
//rooms
Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms/create', [RoomController::class, 'store']);
Route::put('/rooms/update/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/delete/{id}', [RoomController::class, 'destroy']);

 //teacher student connection
 Route::get('/student_teacher_connections', [StudentTeacherConnectionsController::class, 'index']);
 Route::post('/student_teacher_connections/create', [StudentTeacherConnectionsController::class, 'store']);
 Route::put('/student_teacher_connections/update/{id}', [StudentTeacherConnectionsController::class, 'update']);
 Route::delete('/student_teacher_connections/delete/{id}', [StudentTeacherConnectionsController::class, 'destroy']);
//announcements
Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::post('/announcements/create', [AnnouncementController::class, 'store']);
Route::put('/announcements/update/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcements/delete/{id}', [AnnouncementController::class, 'destroy']);
//quizzes
Route::get('/quizzes', [QuizController::class, 'index']);
Route::post('/quizzes/create', [QuizController::class, 'store']);
Route::put('/quizzes/update/{id}', [QuizController::class, 'update']);
Route::delete('/quizzes/delete/{id}', [QuizController::class, 'destroy']);

//exams
Route::get('/exams', [ExamController::class, 'index']);
Route::post('/exams/create', [ExamController::class, 'store']);
Route::put('/exams/update/{id}', [ExamController::class, 'update']);
Route::delete('/exams/delete/{id}', [ExamController::class, 'destroy']);

//questions
Route::get('/questions', [QuestionController::class, 'index']);
Route::post('/questions/create', [QuestionController::class, 'store']);
Route::put('/questions/update/{id}', [QuestionController::class, 'update']);
Route::delete('/questions/delete/{id}', [QuestionController::class, 'destroy']);

//relationship
Route::get('/relationship', [RelationshipController::class, 'index']);
Route::post('/relationship/create', [RelationshipController::class, 'store']);
Route::put('/relationship/update/{id}', [RelationshipController::class, 'update']);
Route::delete('/relationship/delete/{id}', [RelationshipController::class, 'destroy']);



 //Address filters
 Route::prefix('filters')->group(function(){
    Route::get('/get_regions', [FiltersController::class, 'getRegions']);
    Route::get('/get_provinces', [FiltersController::class, 'getProvinces']);
    Route::get('/get_muncities', [FiltersController::class, 'getMuncities']);
    Route::get('/get_brgys', [FiltersController::class, 'getBrgys']);
    Route::get('/get_brgys/{id}', [FiltersController::class, 'getCompleteAdd']);
});

//File Upload Routes
Route::get('/files', [FilesController::class, 'index']);
Route::post('/files/create', [FilesController::class, 'create']);
Route::post('/files/upload_student_image', [FilesController::class, 'upload_student_image']);
Route::put('/files/update/{id}', [FilesController::class, 'update']);
Route::delete('/files/delete/{id}', [FilesController::class, 'destroy']);


//Image Sample Upload Here >>
Route::get('store-image', [ImageController::class, 'store_image'])->name('store_image');
Route::post('save-image', [ImageController::class, 'save_image'])->name('save_image');
Route::get('image-list', [ImageController::class, 'image_list'])->name('image_list');

Route::get('/notifications', function () {
    $notifications = DB::table('notifications')->get();
    return response()->json($notifications);
});


?>