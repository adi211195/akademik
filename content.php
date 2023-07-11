<?php
$pages=htmlspecialchars(@$_GET['p']);
$open_krs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM settings_open_krs"));
$open_sy=$open_krs['open_school_year'];
$open_sm=$open_krs['open_semester'];
if ($account_status=="Mahasiswa") {
	$mhs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where account_id='$account_id'"));	
	$student_nim=$mhs['student_nim'];
	switch ($pages) {	
		
		case 'krs':
			include "pages/mahasiswa/krs/krs.php"; 
			break;

		case 'score':
			include "pages/mahasiswa/score/score.php"; 
			break;

		case 'schedules':
			include "pages/mahasiswa/schedules/schedules.php"; 
			break;

		case 'ips':
			include "pages/mahasiswa/ips/ips.php"; 
			break;

		case 'ipk':
			include "pages/mahasiswa/ipk/ipk.php"; 
			break;

		case 'logbook':
			include "pages/mahasiswa/logbook/logbook.php"; 
			break;

		case 'skripsi':
			include "pages/mahasiswa/skripsi/skripsi.php"; 
			break;

		case 'student_skpi':
			include "pages/mahasiswa/student_skpi/student_skpi.php"; 
			break;

		case 'questions':
			include "pages/mahasiswa/questions/questions.php"; 
			break;



		//questionnaire

		case 'administration':
			include "pages/mahasiswa/administration/administration.php"; 
			break;

		case 'podcast':
			include "pages/mahasiswa/podcast/podcast.php"; 
			break;

		case 'forum_majors':
			include "pages/mahasiswa/forum_majors/forum_majors.php"; 
			break;

		case 'forum_general':
			include "pages/mahasiswa/forum_general/forum_general.php"; 
			break;

		case 'polling_majors':
			include "pages/mahasiswa/polling_majors/polling_majors.php"; 
			break;

		case 'polling_general':
			include "pages/mahasiswa/polling_general/polling_general.php"; 
			break;


		case 'questionnaire_general':
			include "pages/mahasiswa/questionnaire_general/questionnaire_general.php"; 
			break;

		case 'questionnaire_advisor':
			include "pages/mahasiswa/questionnaire_advisor/questionnaire_advisor.php"; 
			break;

		case 'questionnaire_academic':
			include "pages/mahasiswa/questionnaire_academic/questionnaire_academic.php"; 
			break;

		case 'questionnaire_lecturer':
			include "pages/mahasiswa/questionnaire_lecturer/questionnaire_lecturer.php"; 
			break;


		case 'blog':
			include "pages/mahasiswa/blog/blog.php"; 
			break;

		case 'chat_personal':
			include "pages/mahasiswa/chat_personal/chat_personal.php"; 
			break;

		case 'chat_group':
			include "pages/mahasiswa/chat_group/chat_group.php"; 
			break;

		case 'drive':
			include "pages/mahasiswa/drive/drive.php"; 
			break;

		case 'elearning':
			include "pages/mahasiswa/elearning/elearning.php"; 
			break;

		case 'mail':
			include "pages/mahasiswa/mail/mail.php"; 
			break;

		case 'calendar':
			include "pages/mahasiswa/calendar/calendar.php"; 
			break;

		case 'support':
			include "pages/mahasiswa/support/support.php"; 
			break;


		case 'edit_password':
			include "pages/mahasiswa/edit_password/edit_password.php"; 
			break;	

		case 'view_profile':
			include "pages/mahasiswa/view_profile/view_profile.php"; 
			break;


		default:
			include "pages/mahasiswa/home/home.php"; 
			break;

}} else if ($account_status=="Dosen") {

	$dsn=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_lecturer where account_id='$account_id'"));
	$open_krs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM settings_open_krs"));
	$open_sy=$open_krs['open_school_year'];
	$open_sm=$open_krs['open_semester'];
	$lecturer_code=$dsn['lecturer_code'];
	switch ($pages) {

		case 'krs':
			include "pages/dosen/krs/krs.php"; 
			break;

		case 'schedules':
			include "pages/dosen/schedules/schedules.php"; 
			break;

		case 'questionnaire_lecturer':
			include "pages/dosen/questionnaire_lecturer/questionnaire_lecturer.php"; 
			break;

		case 'attendance':
			include "pages/dosen/attendance/attendance.php"; 
			break;

		case 'score':
			include "pages/dosen/score/score.php"; 
			break;

		case 'logbook':
			include "pages/dosen/logbook/logbook.php"; 
			break;


		case 'questions':
			include "pages/dosen/questions/questions.php"; 
			break;

		case 'forum_general':
			include "pages/dosen/forum_general/forum_general.php"; 
			break;

		case 'polling_general':
			include "pages/dosen/polling_general/polling_general.php"; 
			break;


		case 'blog':
			include "pages/dosen/blog/blog.php"; 
			break;

		case 'chat_personal':
			include "pages/dosen/chat_personal/chat_personal.php"; 
			break;

		case 'chat_group':
			include "pages/dosen/chat_group/chat_group.php"; 
			break;

		case 'drive':
			include "pages/dosen/drive/drive.php"; 
			break;

		case 'elearning':
			include "pages/dosen/elearning/elearning.php"; 
			break;

		case 'mail':
			include "pages/dosen/mail/mail.php"; 
			break;

		case 'calendar':
			include "pages/dosen/calendar/calendar.php"; 
			break;

		case 'support':
			include "pages/dosen/support/support.php"; 
			break;	

		case 'edit_password':
			include "pages/dosen/edit_password/edit_password.php"; 
			break;

		case 'view_profile':
			include "pages/dosen/view_profile/view_profile.php"; 
			break;
	
	default:
		include "pages/dosen/home/home.php"; 
		break;

}} else if ($account_status=="Administrator") {
	switch ($pages) {	
	
	//MASTERS
	case 'college':
		include "pages/administrator/college/college.php"; 
		break;

	case 'majors':
		include "pages/administrator/majors/majors.php"; 
		break;

	case 'school_year':
		include "pages/administrator/school_year/school_year.php"; 
		break;

	case 'semester':
		include "pages/administrator/semester/semester.php"; 
		break;

	case 'generation':
		include "pages/administrator/generation/generation.php"; 
		break;

	case 'courses':
		include "pages/administrator/courses/courses.php"; 
		break;

	case 'class':
		include "pages/administrator/class/class.php"; 
		break;

	case 'curriculum_types':
		include "pages/administrator/curriculum_types/curriculum_types.php"; 
		break;

	case 'curriculum':
		include "pages/administrator/curriculum/curriculum.php"; 
		break;

	case 'schedule':
		include "pages/administrator/schedule/schedule.php"; 
		break;

	//KRS
	case 'krs_personal':
		include "pages/administrator/krs_personal/krs_personal.php"; 
		break;

	case 'krs_package':
		include "pages/administrator/krs_package/krs_package.php"; 
		break;

	case 'attendance':
		include "pages/administrator/attendance/attendance.php"; 
		break;

	case 'score':
		include "pages/administrator/score/score.php"; 
		break;


	//IPK IPS
	case 'ipk':
		include "pages/administrator/ipk/ipk.php"; 
		break;

	case 'ips':
		include "pages/administrator/ips/ips.php"; 
		break;

	case 'ijasah':
		include "pages/administrator/ijasah/ijasah.php"; 
		break;

	case 'transkrip':
		include "pages/administrator/transkrip/transkrip.php"; 
		break;


	//MASTER KUESIONER
	case 'category_questionnaire':
		include "pages/administrator/category_questionnaire/category_questionnaire.php"; 
		break;

	case 'academic_questionnaire':
		include "pages/administrator/academic_questionnaire/academic_questionnaire.php"; 
		break;

	case 'lecturer_questionnaire':
		include "pages/administrator/lecturer_questionnaire/lecturer_questionnaire.php"; 
		break;

	case 'advisor_questionnaire':
		include "pages/administrator/advisor_questionnaire/advisor_questionnaire.php"; 
		break;

	case 'general_questionnaire':
		include "pages/administrator/general_questionnaire/general_questionnaire.php"; 
		break;


	case 'report_academic_questionnaire':
		include "pages/administrator/report_academic_questionnaire/report_academic_questionnaire.php"; 
		break;

	case 'report_lecturer_questionnaire':
		include "pages/administrator/report_lecturer_questionnaire/report_lecturer_questionnaire.php"; 
		break;

	case 'report_advisor_questionnaire':
		include "pages/administrator/report_advisor_questionnaire/report_advisor_questionnaire.php"; 
		break;

	case 'report_general_questionnaire':
		include "pages/administrator/report_general_questionnaire/report_general_questionnaire.php"; 
		break;

	//PDPT
	case 'pdpt':
		include "pages/administrator/pdpt/pdpt.php"; 
		break;

	case 'salary_another':
		include "pages/administrator/salary_another/salary_another.php"; 
		break;

	case 'salary_teaching':
		include "pages/administrator/salary_teaching/salary_teaching.php"; 
		break;

	case 'report_salary_another':
		include "pages/administrator/report_salary_another/report_salary_another.php"; 
		break;

	case 'report_salary_teaching':
		include "pages/administrator/report_salary_teaching/report_salary_teaching.php"; 
		break;


	//MASTER USER
	case 'user':
		include "pages/administrator/user/user.php"; 
		break;

	case 'student':
		include "pages/administrator/student/student.php"; 
		break;

	case 'student_access':
		include "pages/administrator/student_access/student_access.php"; 
		break;

	case 'student_skpi':
		include "pages/administrator/student_skpi/student_skpi.php"; 
		break;

	case 'student_open_krs':
		include "pages/administrator/student_open_krs/student_open_krs.php"; 
		break;

	case 'lecturer':
		include "pages/administrator/lecturer/lecturer.php"; 
		break;

	//ADDITIONAL
	case 'skripsi':
		include "pages/administrator/skripsi/skripsi.php"; 
		break;

	case 'podcast':
		include "pages/administrator/podcast/podcast.php"; 
		break;

	case 'forum_majors':
		include "pages/administrator/forum_majors/forum_majors.php"; 
		break;

	case 'forum_general':
		include "pages/administrator/forum_general/forum_general.php"; 
		break;

	case 'polling_majors':
		include "pages/administrator/polling_majors/polling_majors.php"; 
		break;

	case 'polling_general':
		include "pages/administrator/polling_general/polling_general.php"; 
		break;

	case 'blog':
		include "pages/administrator/blog/blog.php"; 
		break;

	case 'chat_personal_student':
		include "pages/administrator/chat_personal_student/chat_personal_student.php"; 
		break;

	case 'chat_personal_lecturer':
		include "pages/administrator/chat_personal_lecturer/chat_personal_lecturer.php"; 
		break;

	case 'chat_group':
		include "pages/administrator/chat_group/chat_group.php"; 
		break;

	case 'drive_student':
		include "pages/administrator/drive_student/drive_student.php"; 
		break;

	case 'drive_lecturer':
		include "pages/administrator/drive_lecturer/drive_lecturer.php"; 
		break;

	case 'elearning':
		include "pages/administrator/elearning/elearning.php"; 
		break;

	case 'mail_student':
		include "pages/administrator/mail_student/mail_student.php"; 
		break;

	case 'mail_lecturer':
		include "pages/administrator/mail_lecturer/mail_lecturer.php"; 
		break;

	case 'calendar':
		include "pages/administrator/calendar/calendar.php"; 
		break;


	//PRINT
	case 'logbook':
		include "pages/administrator/logbook/logbook.php"; 
		break;



	//SETTINGS
	case 'range_sks':
		include "pages/administrator/range_sks/range_sks.php"; 
		break;

	case 'range_ipk':
		include "pages/administrator/range_ipk/range_ipk.php"; 
		break;

	case 'open_krs':
		include "pages/administrator/open_krs/open_krs.php"; 
		break;

	case 'open_questionnaire':
		include "pages/administrator/open_questionnaire/open_questionnaire.php"; 
		break;


	case 'edit_password':
			include "pages/administrator/edit_password/edit_password.php"; 
			break;


	case 'view_profile':
			include "pages/administrator/view_profile/view_profile.php"; 
			break;


	//ALUMNI
	case 'alumni':
			include "pages/administrator/alumni/alumni.php"; 
			break;

	case 'alumni_home':
			include "pages/administrator/alumni_home/alumni_home.php"; 
			break;

	case 'alumni_links':
			include "pages/administrator/alumni_links/alumni_links.php"; 
			break;

	case 'alumni_campus':
			include "pages/administrator/alumni_campus/alumni_campus.php"; 
			break;

	case 'alumni_company':
			include "pages/administrator/alumni_company/alumni_company.php"; 
			break;

	case 'alumni_agenda':
			include "pages/administrator/alumni_agenda/alumni_agenda.php"; 
			break;

	case 'alumni_job_vacancy':
			include "pages/administrator/alumni_job_vacancy/alumni_job_vacancy.php"; 
			break;

	case 'alumni_job_vacancies_web':
			include "pages/administrator/alumni_job_vacancies_web/alumni_job_vacancies_web.php"; 
			break;

	//COOPERATION
	case 'coo_education':
			include "pages/administrator/coo_education/coo_education.php"; 
			break;

	case 'coo_community_service':
			include "pages/administrator/coo_community_service/coo_community_service.php"; 
			break;

	case 'coo_research':
			include "pages/administrator/coo_research/coo_research.php"; 
			break;




	default:
		include "pages/administrator/home/home.php"; 
		break;

}}
?>

