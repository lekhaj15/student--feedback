<?php

use App\Http\Controllers\institute\answers\StudentAnswerController;
use App\Http\Controllers\institute\Auth\InstituteLoginController;
use App\Http\Controllers\institute\Auth\InstituteProfileController;
use App\Http\Controllers\institute\Auth\InstituteRegisterController;
use App\Http\Controllers\institute\Category\InstituteCategoryController;
use App\Http\Controllers\institute\grade\GradeCategoryController;
use App\Http\Controllers\institute\grade\GradeSubCategoryController;
use App\Http\Controllers\institute\grade\StaffGradeController;
use App\Http\Controllers\institute\grade\StaffInformationController;
use App\Http\Controllers\institute\grade\StudentInformationController;
use App\Http\Controllers\institute\InstituteDashboardController;
use App\Http\Controllers\institute\questions\QuestionController;
use App\Http\Controllers\institute\questions\QuestionPivotController;
use App\Http\Controllers\institute\questions\StaffQuestionsController;
use App\Http\Controllers\institute\questions\StaffQuestionsPivotController;
use App\Http\Controllers\institute\questions\TopicController;
use App\Http\Controllers\institute\Staff\InstituteStaffController;
use App\Http\Controllers\institute\Student\InstituteStudentController;
use App\Http\Controllers\institute\SubCategory\InstituteSubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', [InstituteRegisterController::class, 'postInstituteRegister']);

    Route::post('/login', [InstituteLoginController::class, 'postInstituteLogin']);
    Route::post('/logout', [InstituteLoginController::class, 'postInstituteLogout'])->middleware(['jwt', 'auth:institute']);

    Route::get('/me', [InstituteProfileController::class, 'getInstituteIndex'])->middleware(['jwt', 'auth:institute']);

});


Route::group([
    'middleware' => ['jwt', 'auth:institute'], // /api/institute
], function () {

    Route::get('/institute-dashboard', [InstituteDashboardController::class, 'getInstituteDashboardIndex']);
    Route::get('/institute-staff', [InstituteStaffController::class, 'getInstituteStaffIndex']);
    Route::get('/institute-student', [InstituteStudentController::class, 'getInstituteStudentIndex']);
    Route::get('/institute-grade', [InstituteCategoryController::class, 'getInstituteGradeIndex']);
    Route::get('/institute-subgrade', [InstituteSubCategoryController::class, 'getInstituteSubgradeIndex']);



    Route::post('/category/store', [GradeCategoryController::class, 'postGradeCategoryStore']);
    Route::get('/category/index', [GradeCategoryController::class, 'getGradeCategoryIndex']);
    Route::get('/category', [GradeCategoryController::class, 'getGradeCategory']);
    Route::get('/category/show/{id}/edit', [GradeCategoryController::class, 'getGradeCategoryShow']);
    Route::delete('/category/delete/{id}', [GradeCategoryController::class, 'deleteGradeCategory']);
    Route::patch('/category/update/{id}', [GradeCategoryController::class, 'patchGradeCategoryUpdate']);


    Route::delete('staff/delete/{id}', [StaffInformationController::class, 'deleteStaffInformation']);
    Route::get('/staff/index', [StaffInformationController::class, 'getStaffInformationIndex']);
    Route::get('/staff/index', [StaffInformationController::class, 'getStaffInformationIndex']);
    Route::post('/staff/store', [StaffInformationController::class, 'postStaffInformationStore']);
    Route::get('/staff/show/{id}/edit', [StaffInformationController::class, 'getStaffInformationShow']);
    Route::patch('/staff/update/{id}', [StaffInformationController::class, 'patchStaffInformationUpdate']);


    Route::delete('staffgrade/delete/{id}', [StaffGradeController::class, 'deletestaffgradeDestroy']);
    Route::get('/staffgrade/index', [StaffGradeController::class, 'getstaffgradeIndex']);
    Route::post('/staffgrade/store', [StaffGradeController::class, 'poststaffgradeStore']);
    Route::get('/staffgrade/show/{id}', [StaffGradeController::class, 'getstaffgradeShow']);
    Route::patch('/staffgrade/update/{id}', [StaffGradeController::class, 'patchstaffgradeUpdate']);


    Route::post('/subcategory/store', [GradeSubCategoryController::class, 'postSubCategoryStore']);
    Route::get('/subcategory/index', [GradeSubCategoryController::class, 'getGradeSubCategoryIndex']);
    Route::get('/subcategory/{category_id}', [GradeSubCategoryController::class, 'getGradeSubCategory']);

    Route::get('/subcategory/show/{id}/edit', [GradeSubCategoryController::class, 'getGradeSubCategoryShow']);
    Route::delete('/subcategory/delete/{id}', [GradeSubCategoryController::class, 'deleteGradeSubCategory']);
    Route::patch('/subcategory/update/{id}', [GradeSubCategoryController::class, 'patchGradeSubCategoryUpdate']);


    Route::get('/student/index', [StudentInformationController::class, 'getStudentInformationIndex']);
    Route::get('/student/show/{id}/edit ', [StudentInformationController::class, 'getStudentInformationShow']);
    Route::delete('/student/delete/{id}', [StudentInformationController::class, 'deleteStudentInformation']);
    Route::post('/student/store', [StudentInformationController::class, 'postStudentInformationStore']);
    Route::patch('/student/update/{id}', [StudentInformationController::class, 'patchStudentInformationUpdate']);


    Route::post('/topic/store', [TopicController::class, 'postquestionstopicStore']);
    Route::get('/topic/index', [TopicController::class, 'getquestionstopicIndex']);
    Route::get('/topic', [TopicController::class, 'gettopic']);
    Route::get('/topic/{category_id}/{subcategory_id}', [TopicController::class, 'getstafftopic']);
    Route::get('/topic/show/{id}/edit', [TopicController::class, 'getquestionstopicShow']);
    Route::delete('/topic/delete/{id}', [TopicController::class, 'deletequestionstopicDestroy']);
    Route::patch('/topic/update/{id}', [TopicController::class, 'patchquestionstopicUpdate']);

    Route::post('/question/store', [QuestionController::class, 'postQuestionStore']);
    Route::get('/question/index/{subcategory_id}', [QuestionController::class, 'getQuestionIndex']);
//    Route::get('/question/index', [QuestionController::class, 'getQuestionIndex']);
    Route::get('/question/show/{id}', [QuestionController::class, 'getQuestionShow']);
    Route::delete('/question/delete/{id}', [QuestionController::class, 'deleteQuestionDestroy']);
    Route::patch('/question/update/{id}', [QuestionController::class, 'patchQuestionUpdate']);

    Route::post('/pivot/store', [QuestionPivotController::class, 'postQuestionPivotStore']);
    Route::get('/pivot/index', [QuestionPivotController::class, 'getQuestionPivotIndex']);
    Route::get('/pivot/show/{id}', [QuestionPivotController::class, 'getQuestionPivotShow']);
    Route::delete('/pivot/delete/{id}', [QuestionPivotController::class, 'deleteQuestionPivotDestroy']);
    Route::patch('/pivot/update/{id}', [QuestionPivotController::class, 'patchQuestionPivotUpdate']);

    Route::post('/staff-question/store', [StaffQuestionsController::class, 'postStaffQuestionStore']);
    Route::get('/staff-question/index/{subcategory_id}', [StaffQuestionsController::class, 'getstaffquestionIndex']);
    //Route::get('/staffquestion/index', [StaffQuestionsController::class, 'getstaffquestionIndex']);
    Route::get('/staff-question/show/{id}', [StaffQuestionsController::class, 'getstaffquestionShow']);
    Route::delete('/staff-question/delete/{id}', [StaffQuestionsController::class, 'deletestaffQuestionDestroy']);
    Route::patch('/staff-question/update/{id}', [StaffQuestionsController::class, 'patchStaffQuestionUpdate']);

    Route::post('/staffpivot/store', [StaffQuestionsPivotController::class, 'postQuestionPivotStore']);
    Route::get('/staffpivot/index', [StaffQuestionsPivotController::class, 'getstaffquestionIndex']);
    Route::get('/staffpivot/show/{id}', [StaffQuestionsPivotController::class, 'getQuestionPivotShow']);
    Route::delete('/staffpivot/delete/{id}', [StaffQuestionsPivotController::class, 'deleteQuestionPivotDestroy']);
    Route::patch('/staffpivot/update/{id}', [StaffQuestionsPivotController::class, 'patchQuestionPivotUpdate']);

    Route::get('/student-answers/index/{student_id}', [StudentAnswerController::class, 'getStudentAnswerIndex']);
    Route::get('/staff-answers/index/{student_id}', [\App\Http\Controllers\institute\answers\StaffAnswerController::class, 'getStaffAnswerIndex']);


    Route::get('/Quiz/index', [\App\Http\Controllers\institute\quiz\QuizController::class, 'getQuizIndex']);
    Route::get('/Quiz/show/{id}', [\App\Http\Controllers\institute\quiz\QuizController::class, 'getQuizShow']);
    Route::patch('Quiz/update/{id}', [\App\Http\Controllers\institute\quiz\QuizController::class, 'patchQuizUpdate']);
    Route::delete('Quiz/delete/{id}', [\App\Http\Controllers\institute\quiz\QuizController::class, 'deleteQuizDestroy']);
    Route::post('Quiz', [\App\Http\Controllers\institute\quiz\QuizController::class, 'postStore']);


    Route::get('Quizpivot/index', [\App\Http\Controllers\institute\quiz\QuizPivotController::class, 'getQuizPivotIndex']);
    Route::get('Quizpivot/show/{id}', [\App\Http\Controllers\institute\quiz\QuizPivotController::class, 'getQuizPivotShow']);
    Route::patch('Quizpivot/update/{id}', [\App\Http\Controllers\institute\quiz\QuizPivotController::class, 'patchQuizPivotUpdate']);
    Route::delete('Quizpivot/delete/{id}', [\App\Http\Controllers\institute\quiz\QuizPivotController::class, 'deleteQuizDestroy']);
    Route::post('Quizpivot/store', [\App\Http\Controllers\institute\quiz\QuizPivotController::class, 'postStore']);

    Route::get('subject/index', [\App\Http\Controllers\institute\quiz\SubjectController::class, 'getSubjectIndex']);
    Route::post('subject/show/{id}', [\App\Http\Controllers\institute\quiz\SubjectController::class, 'postSubjectStore']);
    Route::get('subject', [\App\Http\Controllers\institute\quiz\SubjectController::class, 'getSubject']);
    Route::get('subject/show/{id}', [\App\Http\Controllers\institute\quiz\SubjectController::class, 'getSubjectShow']);
    Route::patch('subject/uodate/{id}', [\App\Http\Controllers\institute\quiz\SubjectController::class, 'patchsubjectUpdate']);


    Route::get('Quizanswer/index', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'getQuizAnswerIndex']);
    Route::get('Quizanswer', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'getQuizAnswer']);
    Route::post('Quizanswer/store/{id}', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'postQuizAnswerStore']);
    Route::patch('Quizanswer/update/{id}', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'patchQuizAnswerUpdate']);
    Route::delete('Quizanswer/delete/{id}', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'deleteQuizAnswerDestroy']);
    Route::get('Quizanswer', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'getShow']);
    Route::get('Quizanswer', [\App\Http\Controllers\institute\quiz\QuizAnswerController::class, 'getEdit']);

});

