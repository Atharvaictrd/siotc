<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('Home/getNextEnquiryNo', 'Home::getNextEnquiryNo');
 $routes->get('Home/getNextProsNo', 'Home::getNextProsNo');
    $routes->get('/', 'Home::index');
    $routes->get('/cron_todays_collection', 'CronController::cron_todays_collection');
    $routes->get('/cron_todays_enquiry', 'CronController::cron_todays_enquiry');
    $routes->post('/loginsubmit', 'Admin::loginsubmit', ['as' => 'admin.loginsubmit']);
    $routes->group('', ['filter' => ['isAdminLoggedin', 'moduleViewPermission']], function ($routes) {
    $routes->match(['get','post'],'/dashboard', 'Admin::dashboard', ['as' => 'dashboard']);
    $routes->match(['get','post'],'/regenerateSession', 'Admin::regenerateSession', ['as' => 'regenerateSession']);
    // $routes->get('/dashboard', 'Admin::dashboard', ['as' => 'dashboard']);
    $routes->get('/logout', 'Admin::logout', ['as' => 'admin.logout']); 
    $routes->get('/download-backup', 'BackupController::downloadBackup');
    $routes->get('/student_enquiry', 'Admin::student_enquiry', ['as' => 'student_enquiry']);
    $routes->match(['get','post'],'/section', 'Admin::section', ['as' => 'section']);
    $routes->match(['get','post'],'/list_student_enquiry', 'Admin::list_student_enquiry', ['as' => 'list_student_enquiry']);
    $routes->get('delete_enquiry/(:num)', 'Marketing::delete_enquiry/$1');
    $routes->post('/create_enquiry', 'Marketing::create_enquiry', ['as' => 'marketing.create_enquiry']);
    $routes->post('/create_prospect', 'Prospectus::create_prospect', ['as' => 'prospectus.create_prospect']);
    $routes->get('delete_prospect', 'Prospectus::delete_prospect');
    $routes->get('delete_prospect_enquired', 'Prospectus::delete_prospect_enquired');
    $routes->get('delete_prospect_report', 'Prospectus::delete_prospect_report');
    $routes->post('search_enquiry_pro', 'Prospectus::search_enquiry_pro');
    $routes->post('search_enquiry', 'Marketing::search_enquiry');  
    $routes->match(['get','post'],'/list_student_area', 'EnquiryController::list_student_area', ['as' => 'list_student_area']);
    $routes->post('/save_new_keyword', 'EnquiryController::save_new_keyword');
    $routes->match(['get','post'],'/list_student_program', 'EnquiryController::list_student_program', ['as' => 'list_student_program']);
    // $routes->post('/masters/search_list_student_program', 'EnquiryController::search_list_student_program');
    $routes->match(['get','post'],'/list_student_college', 'EnquiryController::list_student_college', ['as' => 'list_student_college']);
    $routes->match(['get','post'],'/list_student_category', 'EnquiryController::list_student_category', ['as' => 'list_student_category']);
    $routes->match(['get','post'],'/list_student_percentage', 'EnquiryController::list_student_percentage', ['as' => 'list_student_percentage']);
    $routes->match(['get','post'],'/list_student_medium', 'EnquiryController::list_student_medium', ['as' => 'list_student_medium']);
    $routes->get('/not_taken_admission', 'EnquiryController::not_taken_admission', ['as' => 'not_taken_admission']);
    $routes->match(['get','post'],'/not_taken_admission_area', 'EnquiryController::not_taken_admission_area', ['as' => 'not_taken_admission_area']);
    $routes->match(['get','post'],'/enquiry_college', 'EnquiryController::enquiry_college', ['as' => 'enquiry_college']);
    $routes->match(['get','post'],'/enquiry_category', 'EnquiryController::enquiry_category', ['as' => 'enquiry_category']);
    $routes->match(['get','post'],'/enquiry_percentage', 'EnquiryController::enquiry_percentage', ['as' => 'enquiry_percentage']);
    $routes->match(['get','post'],'/enquiry_medium', 'EnquiryController::enquiry_medium', ['as' => 'enquiry_medium']);
    $routes->match(['get','post'],'/enquiry_reference', 'EnquiryController::enquiry_reference', ['as' => 'enquiry_reference']);
    $routes->get('/bulk_sms', 'EnquiryController::bulk_sms', ['as' => 'bulk_sms']);
    $routes->match(['get','post'],'/create_user', 'Admin::create_user', [
        'as' => 'create_user',
        'filter' => ['isAdminLoggedin', 'isSuperAdmin']
    ]);
    $routes->match(['get','post'],'/update_password', 'Admin::update_password', ['as' => 'update_password']);
    $routes->post('/save_user', 'Admin::save_user', [
        'filter' => ['isAdminLoggedin', 'isSuperAdmin']
    ]);
    $routes->get('/permission_panel', 'Admin::permission_panel', ['as' => 'permission_panel']);
    $routes->get('/permission-panel', 'Admin::permission_panel1', ['as' => 'permission-panel']);
    // $routes->get('/edit_user/(:num)', 'UserController::edit_user/$1');
    // $routes->post('/update_user/(:num)', 'UserController::update_user/$1');
    // $routes->get('/delete_user/(:num)', 'UserController::delete_user/$1');
    //HrManagement
    $routes->get('/add_teacher', 'HrController::add_teacher');
    $routes->get('/hr_management', 'HrController::hr_management');
    $routes->get('/getEmployeeDetails', 'HrController::getEmployeeDetails');
     
    $routes->post('/add_new_employee', 'HrController::add_new_employee');
    $routes->post('/update_employee', 'HrController::update_employee');
    $routes->get('/delete_emp/(:num)', 'HrController::delete_emp/$1');
    $routes->get('/pay-salary','HrController::pay_salary');
    $routes->post('/generate_slip', 'HrController::generate_slip');
    $routes->get('/salary_slip_down', 'HrController::salary_slip_down');
    $routes->get('/print_salary_slip', 'HrController::print_salary_slip', ['as' => 'print_salary_slip']);
    // AcEDEMIC
    $routes->match(['get','post'],'/prospectus', 'Admin::prospectus', ['as' => 'prospectus']);
    $routes->match(['get','post'],'/prospectus_report', 'Prospectus::prospectus_report', ['as' => 'prospectus_report']);
    $routes->match(['get','post'],'/prospectus_session', 'Prospectus::prospectus_session', ['as' => 'prospectus_session']);
    $routes->match(['get','post'],'/prospectus_enquired', 'Admin::prospectus_enquired', ['as' => 'prospectus_enquired']);
    
    $routes->match(['get','post'],'/student_prospectus', 'Prospectus::student_prospectus', ['as' => 'student_prospectus']);
    
    $routes->match(['get','post'],'/prospectus_enquired1', 'Admin::prospectus_enquired1', ['as' => 'prospectus_enquired1']);
    $routes->get('/import_excel', 'Admin::import_excel', ['as' => 'import_excel']);
    $routes->match(['get','post'],'/student_status', 'Report::student_status', ['as' => 'student_status']);
    $routes->get('/admission_report', 'Admin::admission_report', ['as' => 'admission_report']);
    $routes->match(['get','post'],'/section_allocation', 'Admin::section_allocation', ['as' => 'section_allocation']); 
    $routes->post('insert_section', 'Admin::insert_section');
    
    $routes->match(['get','post'],'create_prospect_enquired', 'Prospectus::create_prospect_enquired', ['as' => 'create_prospect_enquired']); 
    
    // $routes->match(['get','post'],'create_prospect_enquired1', 'Prospectus::create_prospect_enquired1', ['as' => 'create_prospect_enquired1']); 
    
    // $routes->post('/create_prospect_enquired1', 'Prospectus::create_prospect_enquired1');

    // $routes->post('create_prospect_enquired', 'Prospectus::create_prospect_enquired');
    
    $routes->match(['get','post'],'student_search', 'Admin::student_search');
    $routes->get('/delete_student_list/(:num)', 'Admin::delete_student_list/$1');
    $routes->get('/student_admission_form/(:num)', 'Admin::student_admission_form/$1');
    $routes->match(['get','post'],'student_parent_contact', 'Admin::student_parent_contact');
       
    //Fees
    $routes->get('/fees_report', 'Admin::fees_report', [
        'as' => 'fees_report',
        'filter' => ['isAdminLoggedin', 'moduleViewPermission']
    ]);
    $routes->get('/fees_report/program', 'Admin::fees_program', ['as' => 'fees_program']);   
    $routes->get('/fees_report/scholarship', 'Admin::fees_scholarship', ['as' => 'fees_scholarship']);
    $routes->match(['get','post'],'/fees_report/fees', 'FeesController::fees_fees', ['as' => 'fees_fees']);
    $routes->match(['get','post'],'/fees_report/collect_other_fee', 'FeesController::collect_other_fee', ['as' => 'collect_other_fee']);
    $routes->match(['get','post'],'/insert_other_fees', 'FeesController::insert_other_fees', ['as' => 'insert_other_fees']);
    $routes->get('/fees_report/print_slip', 'FeesController::print_slip', ['as' => 'print_slip']);
    $routes->get('/fees_report/print_other_slip', 'FeesController::print_other_slip', ['as' => 'print_other_slip']);
    $routes->get('/fees_report/print_late_slip', 'FeesController::print_late_slip', ['as' => 'print_late_slip']);
    $routes->match(['get','post'],'/fees_test', 'FeesController::fees_test', ['as' => 'fees_test']);
    $routes->match(['get','post'],'/fees_report/bus', 'Admin::fees_bus', ['as' => 'fees_bus']);
    $routes->get('/fees_report/collect', 'Admin::fees_collect', ['as' => 'fees_collect']);
    $routes->match(['get','post'],'/fees_report/management', 'FeesController::fees_management', ['as' => 'fees_management']);
    $routes->match(['get','post'],'/fees_report/category', 'Admin::fees_category', ['as' => 'fees_category']);
    $routes->match(['get','post'],'/fees_report/fees_structure', 'Admin::fees_structure', ['as' => 'fees_structure']);
    $routes->get('/fees_report/report', 'Admin::fees_report2', ['as' => 'fees_report2']);
    $routes->post('/fees_report/change_fee_structure/(:num)', 'Admin::change_fee_structure/$1');
    $routes->match(['get','post'],'/fees_report/insert_management', 'FeesController::insert_management');
    $routes->post('/fees_report/scholarship/togglestatus', 'Admin::togglestatus');
     
    //  Fees Report --> Report
    
    $routes->match(['get','post'],'/daily_collection_report', 'Admin::daily_collection_report');
    $routes->match(['get','post'],'/bus_collection_report', 'Admin::bus_collection_report');
    $routes->match(['get','post'],'/student_fees_report', 'Admin::student_fees_report');
    $routes->match(['get','post'],'/balance_on_student', 'Admin::balance_on_student');
    $routes->match(['get','post'],'/balance_bus', 'Admin::balance_bus');
    $routes->match(['get','post'],'/forget_password', 'Admin::forget_password');
    $routes->match(['get','post'],'/support', 'Admin::support');
    $routes->match(['get','post'],'/balance_only_outstanding', 'Admin::balance_only_outstanding');
    $routes->get('/section_wise', 'Admin::section_wise');
    $routes->match(['get','post'],'/fees_consession_report', 'Admin::fees_consession_report');
    $routes->get('/balance_less_paid', 'Admin::balance_less_paid');
    $routes->get('/scholarship_form_not_submitted_ref', 'Admin::scholarship_form_not_submitted_ref');
    $routes->get('/scholarship_form_not_submitted', 'Admin::scholarship_form_not_submitted');
    $routes->get('/balance_student_reference', 'Admin::balance_student_reference');
    $routes->match(['get','post'],'/bus_fees_report', 'Admin::bus_fees_report');
    // AcEDEMIC /Certificate
    $routes->match(['get','post'],'/leaving', 'Admin::leaving', ['as' => 'leaving']);
    $routes->match(['get','post'],'/bonafied', 'Admin::bonafied', ['as' => 'bonafied']);
    $routes->match(['get','post'],'/cert_bonafied', 'Admin::cert_bonafied', ['as' => 'cert_bonafied']);
    $routes->match(['get','post'],'/leaving_list', 'Admin::leaving_list', ['as' => 'leaving_list']);
    $routes->match(['get','post'],'/bonafied_list', 'Admin::bonafied_list', ['as' => 'bonafied_list']);
    $routes->match(['get','post'],'/cert_leaving', 'Admin::cert_leaving', ['as' => 'cert_leaving']);
    $routes->match(['get','post'],'/cer_leaving_print_final', 'Admin::cer_leaving_print_final', ['as' => 'cer_leaving_print_final']);
     
    // AcEDEMIC /Attendence
    $routes->get('/stu_attendence_daily', 'Admin::stu_attendence_daily', ['as' => 'stu_attendence_daily']);
    $routes->get('/stu_attendence_report', 'Admin::stu_attendence_report', ['as' => 'stu_attendence_report']);
     
    //  Student Attedence Report
     $routes->get('/stu_attendence_report/daily_report', 'Admin::daily_report', ['as' => 'daily_report']);
    $routes->get('/stu_attendence_report/present_report', 'Admin::present_report', ['as' => 'present_report']);
    $routes->get('/stu_attendence_report/absent_report', 'Admin::absent_report', ['as' => 'absent_report']);
    $routes->get('/stu_attendence_report/weekly_report', 'Admin::weekly_report', ['as' => 'weekly_report']);
    $routes->get('/stu_attendence_report/branchwise_report', 'Admin::branchwise_report', ['as' => 'branchwise_report']);
    $routes->get('/stu_attendence_report/monthly_report', 'Admin::monthly_report', ['as' => 'monthly_report']);
    $routes->get('/stu_attendence_report/attendence_percentage', 'Admin::attendence_percentage', ['as' => 'attendence_percentage']);
    $routes->get('/stu_attendence_report/send_sms', 'Admin::send_sms', ['as' => 'send_sms']);
    
    
    // Admission Report
    
    $routes->get('/report_section', 'Admin::report_section');
    $routes->get('/report_category', 'Admin::report_category'); 
    $routes->get('/report_register', 'Admin::report_register');
    $routes->get('/report_admission_type', 'Admin::report_admission_type');
    $routes->get('/report_student', 'Admin::report_student');
    $routes->get('/report_admission_report', 'Admin::report_admission_report');
    $routes->get('/report_last_exam', 'Admin::report_last_exam');
    $routes->get('/report_last_school', 'Admin::report_last_school');
    $routes->match(['get','post'],'/report_medium', 'Admin::report_medium');
    $routes->get('/report_institute', 'Admin::report_institute');
    $routes->get('/report_percentage', 'Admin::report_percentage');
    $routes->get('/report_sports_achievement', 'Admin::report_sports_achievement');
    $routes->get('/report_custom', 'Admin::report_custom');
    $routes->get('/report_area', 'Admin::report_area');
    $routes->get('/list_purchase_prospectus', 'Admin::list_purchase_prospectus');
    $routes->get('/list_not_purchase_prospectus', 'Admin::list_not_purchase_prospectus');
    $routes->get('/update_percentage', 'Admin::update_percentage');
    $routes->match(['get','post'],'/strength_report', 'Admin::strength_report');
          
    //Student Admission 
    $routes->match(['get','post'],'/student_admission', 'Admission::student_admission', ['as' => 'student_admission']);
    $routes->get('/student_admission/new_admission', 'Admin::new_admission', ['as' => 'new_admission']);
      
    //Admission
    $routes->post('/std_data', 'Admission::std_data');
    $routes->post('/update_std_data/(:num)', 'Admission::update_std_data/$1');
    $routes->post('/existing_data', 'Admission::existing_data');
    $routes->post('/search_reg_no', 'Admission::search_reg_no');
    $routes->get('/test', 'Admission::test');
    // MASTERS
    $routes->get('/masters', 'Masters::masters', ['as' => 'masters']);
    $routes->get('/masters/last_school_attended', 'Masters::last_school_attended');
    $routes->get('/masters/delete_last_school_attended/(:num)', 'Masters::delete_last_school_attended/$1');
    $routes->get('/masters/reference_details', 'Masters::reference_details', ['as' => 'reference_details']);
    $routes->post('/masters/save_reference_detail', 'Masters::save_reference_detail');
    $routes->post('/masters/last_school_attended_name', 'Masters::last_school_attended_name');
    $routes->post('/masters/update_reference_detail/(:num)', 'Masters::update_reference_detail/$1');
    $routes->get('/masters/program', 'Masters::program', ['as' => 'program']);
    $routes->get('/masters/class', 'Masters::class');
    $routes->get('/masters/sem', 'Masters::sem');
    $routes->post('/masters/save_class', 'Masters::save_class');
    $routes->post('/masters/save_sem', 'Masters::save_sem');
    $routes->get('/masters/edit_class/(:num)', 'Masters::edit_class/$1');
    $routes->post('/masters/update_class/(:num)', 'Masters::update_class/$1');
    $routes->get('/masters/delete_class/(:num)', 'Masters::delete_class/$1');
    $routes->get('/masters/edit_sem/(:num)', 'Masters::edit_sem/$1');
    $routes->post('/masters/update_sem/(:num)', 'Masters::update_sem/$1');
    $routes->get('/masters/delete_sem/(:num)', 'Masters::delete_sem/$1');
    $routes->get('/masters/section', 'Masters::section', ['as' => 'section']);
    $routes->post('/masters/save_section', 'Masters::save_section');
    $routes->get('/masters/edit_section/(:num)', 'Masters::edit_section/$1');
    $routes->post('/masters/update_section/(:num)', 'Masters::update_section/$1');
    $routes->get('/masters/delete_section/(:num)', 'Masters::delete_section/$1');
    
    $routes->get('/masters/adress_keywords', 'Masters::adress_keywords', ['as' => 'adress_keywords']);
    $routes->post('/masters/save_adress_keywords', 'Masters::save_adress_keywords');
    $routes->get('/masters/edit_adress_keywords/(:num)', 'Masters::edit_adress_keywords/$1');
    $routes->post('/masters/update_adress_keywords/(:num)', 'Masters::update_adress_keywords/$1');
    $routes->get('/masters/delete_adress_keywords/(:num)', 'Masters::delete_adress_keywords/$1');
    
    $routes->get('/masters/exam', 'Masters::exam', ['as' => 'exam']);
    $routes->post('/masters/save_exam', 'Masters::save_exam');
    $routes->get('/masters/edit_exam/(:num)', 'Masters::edit_exam/$1');
    $routes->post('/masters/update_exam/(:num)', 'Masters::update_exam/$1');
    $routes->get('/masters/delete_exam/(:num)', 'Masters::delete_exam/$1');
    
    $routes->get('/masters/program_sem', 'Masters::program_sem', ['as' => 'program_sem']);
    $routes->post('/masters/save_program_sem', 'Masters::save_program_sem');
    $routes->get('/masters/edit_program_sem/(:num)', 'Masters::edit_program_sem/$1');
    $routes->post('/masters/update_program_sem/(:num)', 'Masters::update_program_sem/$1');
    $routes->get('/masters/delete_program_sem/(:num)', 'Masters::delete_program_sem/$1');
    
    $routes->get('/masters/add_group', 'Masters::add_group', ['as' => 'add_group']);
    $routes->post('/masters/save_group', 'Masters::save_group');
    $routes->get('/masters/edit_group/(:num)', 'Masters::edit_group/$1');
    $routes->post('/masters/update_group/(:num)', 'Masters::update_group/$1');
    $routes->get('/masters/delete_group/(:num)', 'Masters::delete_group/$1');
    $routes->get('/masters/subjects', 'Masters::subjects', ['as' => 'subjects']);
    $routes->get('/masters/subjects_list', 'Masters::subjects_list', ['as' => 'subjects_list']);
    $routes->post('/masters/save_subjects', 'Masters::save_subjects');
    $routes->get('/masters/edit_subjects_list/(:num)', 'Masters::edit_subjects_list/$1');
    $routes->post('/masters/update_subjects_list/(:num)', 'Masters::update_subjects_list/$1');
    $routes->get('/masters/delete_subjects_list/(:num)', 'Masters::delete_subjects_list/$1');
    
    $routes->get('/masters/student_category', 'Masters::student_category', ['as' => 'student_category']);
    $routes->post('/masters/save_student_category', 'Masters::save_student_category');
    $routes->get('/masters/edit_student_category/(:num)', 'Masters::edit_student_category/$1');
    $routes->post('/masters/update_student_category/(:num)', 'Masters::update_student_category/$1');
    $routes->get('/masters/delete_student_category/(:num)', 'Masters::delete_student_category/$1');
    
    $routes->get('/masters/add_prospectus', 'Masters::add_prospectus', ['as' => 'add_prospectus']);
    $routes->post('/masters/save_prospectus', 'Masters::save_prospectus');
    $routes->get('/masters/edit_prospectus/(:num)', 'Masters::edit_prospectus/$1');
    $routes->post('/masters/update_prospectus/(:num)', 'Masters::update_prospectus/$1');
    $routes->get('/masters/delete_prospectus/(:num)', 'Masters::delete_prospectus/$1');
    
    $routes->get('/masters/designation', 'Masters::designation', ['as' => 'designation']);
    $routes->post('/masters/save_designation', 'Masters::save_designation');
    $routes->get('/masters/edit_designation/(:num)', 'Masters::edit_designation/$1');
    $routes->post('/masters/update_designation/(:num)', 'Masters::update_designation/$1');
    $routes->get('/masters/delete_designation/(:num)', 'Masters::delete_designation/$1');
    
    $routes->get('/masters/department', 'Masters::department', ['as' => 'department']);
    $routes->post('/masters/save_department', 'Masters::save_department');
    $routes->get('/masters/edit_department/(:num)', 'Masters::edit_department/$1');
    $routes->post('/masters/update_department/(:num)', 'Masters::update_department/$1');
    $routes->get('/masters/delete_department/(:num)', 'Masters::delete_department/$1');
    
    $routes->get('/masters/delete_student_info', 'Masters::delete_student_info');
    
    $routes->get('/masters/allowances', 'Masters::allowances', ['as' => 'allowances']);
    $routes->post('/masters/save_allowances', 'Masters::save_allowances');
    $routes->get('/masters/edit_allowances/(:num)', 'Masters::edit_allowances/$1');
    $routes->post('/masters/update_allowances/(:num)', 'Masters::update_allowances/$1');
    $routes->get('/masters/delete_allowances/(:num)', 'Masters::delete_allowances/$1');
    
    $routes->get('/masters/deduction', 'Masters::deduction', ['as' => 'deduction']);
    $routes->post('/masters/save_deduction', 'Masters::save_deduction');
    $routes->get('/masters/edit_deduction/(:num)', 'Masters::edit_deduction/$1');
    $routes->post('/masters/update_deduction/(:num)', 'Masters::update_deduction/$1');
    $routes->get('/masters/delete_deduction/(:num)', 'Masters::delete_deduction/$1');
    
    $routes->get('/masters/edit_reference_details/(:num)', 'Masters::edit_reference_details/$1');
    $routes->get('/masters/delete_reference_details/(:num)', 'Masters::delete_reference_details/$1');

    $routes->post('/masters/search_subjects_list', 'Masters::search_subjects_list');
    $routes->get('/masters/edit_subjects_list/(:num)', 'Masters::edit_subjects_list/$1');
    $routes->post('/masters/update_subjects_list/(:num)', 'Masters::update_subjects_list/$1');
    $routes->get('/masters/delete_subjects_list/(:num)', 'Masters::delete_subjects_list/$1');
    
    $routes->get('/masters/student_category', 'Masters::student_category', ['as' => 'student_category']);
    $routes->get('/masters/prospectus', 'Masters::prospectus', ['as' => 'prospectus']);
    $routes->get('/masters/prospectus_list', 'Masters::prospectus_list', ['as' => 'prospectus_list']);
    $routes->get('/masters/fee_components', 'Masters::fee_components', ['as' => 'fee_components']);
    $routes->get('/masters/edit_fee_components/(:num)', 'Masters::edit_fee_components/$1');
    $routes->post('/masters/update_fee_components/(:num)', 'Masters::update_fee_components/$1');
    $routes->match(['get','post'],'/masters/fee_assign_to_program', 'Masters::fee_assign_to_program', ['as' => 'fee_assign_to_program']);
    $routes->match(['get','post'],'/masters/fee_assign_to_program1', 'Masters::fee_assign_to_program1', ['as' => 'fee_assign_to_program1']);
    $routes->get('/masters/demo_fee_assign_to_program', 'Masters::demo_fee_assign_to_program', ['as' => 'demo_fee_assign_to_program']);
    // $routes->get('/masters/fee_assign_to_program_list', 'Masters::fee_assign_to_program_list', ['as' => 'fee_assign_to_program_list']);
    $routes->get('/masters/designation_add', 'Masters::designation_add', ['as' => 'designation_add']);
    $routes->get('/masters/designation_list', 'Masters::designation_list', ['as' => 'designation_list']);
    $routes->get('/masters/department_add', 'Masters::department_add', ['as' => 'department_add']);
    $routes->get('/masters/department_list', 'Masters::department_list', ['as' => 'department_list']);
    
    $routes->get('/masters/delete_student_info', 'Masters::delete_student_info', ['as' => 'delete_student_info']);
    $routes->post('/masters/search_student_list', 'Masters::search_student_list');
    $routes->get('/masters/delete_student_list/(:num)', 'Masters::delete_student_list/$1');
    
    $routes->get('/masters/allowances', 'Masters::allowances', ['as' => 'allowances']);
    $routes->get('/masters/deduction', 'Masters::deduction', ['as' => 'deduction']);
    
    $routes->post('/masters/save_fee_components', 'Masters::save_fee_components');
    $routes->post('/masters/save_fee_assign_program', 'Masters::save_fee_assign_program');
    $routes->post('/masters/save_demo_fee_assign_program', 'Masters::save_demo_fee_assign_program');
    $routes->post('/masters/search_fee_components', 'Masters::search_fee_components');
    $routes->match(['get','post'],'/masters/search_fee_assign_to_program_list', 'Masters::search_fee_assign_to_program_list');
    $routes->get('/masters/delete_fee_assign_to_program_list/(:num)', 'Masters::delete_fee_assign_to_program_list/$1');
    $routes->get('/masters/delete_fee_components/(:num)', 'Masters::delete_fee_components/$1');
    $routes->match(['get','post'],'/masters/fee_assign_to_program_list', 'Masters::fee_assign_to_program_list');
    $routes->get('/masters/edit_fee_program_list/(:num)', 'Masters::edit_fee_program_list/$1');
    $routes->match(['get','post'],'/masters/update_fee_program_list', 'Masters::update_fee_program_list');
    
    //Delete data
    $routes->match(['get','post'],'/delete_fees/(:num)', 'DeleteController::delete_fees/$1');
    $routes->match(['get','post'],'/delete_bus_fees/(:num)', 'DeleteController::delete_bus_fees/$1');
    $routes->match(['get','post'],'/delete_management/(:num)', 'DeleteController::delete_management/$1');

    //new routes
$routes->group('', ['filter' => ['isAdminLoggedin', 'isSuperAdmin']], function ($routes) {
$routes->get('/create_role', 'Admin::create_role');
$routes->post('/save_role', 'Admin::save_role');
$routes->post('/save-role-permissions', 'Admin::save_role_permissions');
$routes->post('save_user', 'Admin::save_user');
$routes->get('get_role_permissions', 'Admin::get_role_permissions');
$routes->get('edit_user/(:num)', 'Admin::edit_user/$1');
$routes->get('manage_user_permissions/(:num)', 'Admin::manage_user_permissions/$1');
$routes->post('update_user/(:num)', 'Admin::update_user/$1');
$routes->post('update_user_permissions/(:num)', 'Admin::update_user_permissions/$1');
$routes->post('delete_user/(:num)', 'Admin::delete_user/$1');
$routes->post('update_user/(:num)', 'Admin::update_user/$1');
$routes->post('delete_user/(:num)', 'Admin::delete_user/$1');
$routes->get('create_menu', 'Admin::create_menu');
$routes->post('save_custom_menu', 'Admin::save_custom_menu');
$routes->get('edit_custom_menu/(:num)', 'Admin::edit_custom_menu/$1');
$routes->post('update_custom_menu/(:num)', 'Admin::update_custom_menu/$1');
$routes->post('delete_custom_menu/(:num)', 'Admin::delete_custom_menu/$1');
});
});


    