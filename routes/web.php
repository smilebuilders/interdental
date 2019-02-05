<?php

Route::get('/', 'indexController@index')->name('index')->middleware('auth');

Route::middleware(['auth'])->group(function () {
  
  Route::get('/search', 'indexController@search')->name('patient_search');
  
  Route::prefix('patient')->group(function () {
    Route::get('/create', 'patientController@create')->name('patient_create');
    Route::get('/edit/{id}', 'patientController@edit')->name('patient_edit');
    Route::post('/store', 'patientController@store')->name('patient_store');
    Route::post('/update/{id}', 'patientController@update')->name('patient_update');
    Route::get('/benefits/{id}', 'policyController@benefits')->name('patient_benefits');
    Route::get('/treatmets/{id}', 'patientController@treatments')->name('patient_treatments');
    Route::get('/treatments/get/{id}', 'treatmentController@get');
    Route::get('/claims/generated/{id}', 'claimController@generated')->name('patient_claims');
    Route::get('/claim/show/{id}', 'patientController@showClaim')->name('patient_show_claim');
  });

  Route::prefix('dependent')->group(function() {
    Route::get('/create/{patient_id}', 'dependentController@create')->name('dependent_create');
    Route::post('/store', 'dependentController@store')->name('dependent_store');
  });

  Route::prefix('policy')->group(function() {
    Route::get('/pending', 'policyController@verify')->name('policy_verify');
    Route::get('/details/{id}', 'policyController@index')->name('policy');
    Route::get('/edit/{id}', 'policyController@edit')->name('policy_edit');
    Route::post('/update/{id}', 'policyController@update')->name('policy_update');
    Route::get('/coverage/edit/{id}', 'policyController@coverage')->name('policy_coverage_edit');
    Route::get('/extra_coverage/edit/{id}', 'policyController@extraCoverage')->name('policy_extra_coverage_edit');
    Route::post('change-status', 'policyController@changeStatus');
  });
  Route::prefix('treatments')->group(function() {
    Route::post('/post/', 'treatmentController@post');
    Route::post('/delete/{id}', 'treatmentController@delete');
    Route::post('/send', 'treatmentController@send');
    
    Route::post('/upload-image', 'treatmentController@uploadImage')->name('treatment_add_image');
    Route::post('/delete-image', 'treatmentController@deleteImage')->name('treatment_delete_image');
  });
  Route::prefix('claim')->group(function() {
    Route::get('/pending', 'claimController@pending')->name('claim_pending');
    Route::get('/generate/{id}', 'claimController@generate')->name('claim_generate');
    Route::get('/treatments/get/{id}', 'claimController@getTreatments');
    Route::post('/generate', 'claimController@generateClaim');
    
    Route::post('/update', 'claimController@update')->name('claim_update');
  });
  
  // ajax routes
  Route::get('/treatment/get/{category}', 'treatmentController@getCategoryTreatments');

  Route::get('/report', 'indexController@report')->name('report');
});

Auth::routes();
