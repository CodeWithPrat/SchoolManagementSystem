<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
		
		 <!-- SESSION -->
        <li class="<?php if ($page_name == 'session') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/session">
                <i class="fa fa-gear"></i>
                <span><?php echo get_phrase('manage_session'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' ||
                $page_name == 'student_bulk_add' ||
                $page_name == 'student_information' ||
                
                $page_name == 'student_promotion')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('students'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_bulk_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_bulk_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
				
				

            </ul>
        </li>
		
 <!-- ENQUIRY TABLE INFO -->
        <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('academic_syllabus'); ?></span>
            </a>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/teacher">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teachers'); ?></span>
            </a>
        </li>

        <!-- PARENTS -->
        <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/parent">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('parents'); ?></span>
            </a>
        </li>
		
		 <!-- LIBRARIAN -->
        <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/librarian">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('librarians'); ?></span>
            </a>
        </li>
		
		 <!-- LIBRARIAN -->
        <li class="<?php if ($page_name == 'alumni') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/alumni">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('manage_alumni'); ?></span>
            </a>
        </li>

 <!-- MEDIA -->
        <li class="<?php if ($page_name == 'media') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/media">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('manage_media'); ?></span>
            </a>
        </li>

		 <!-- ENQUIRY TABLE INFO -->
        <li class="<?php if ($page_name == 'enquiry') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/enquiry">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('all_enquiries'); ?></span>
            </a>
        </li>
		
		 <!-- LOAN PAGE -->
        <li class="<?php
        if ($page_name == 'loan_applicant' ||
                $page_name == 'loan_approval')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('manage_loan'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'loan_applicant') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/loan_applicant">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_loan_applicants'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'loan_approval') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/loan_approval">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_loan_approvals'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

		
		 <!-- ENQUIRY TABLE INFO -->
        <li class="<?php if ($page_name == 'enquiry_setting') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/enquiry_setting">
                <i class="fa fa-gear"></i>
                <span><?php echo get_phrase('enquiry_category'); ?></span>
            </a>
        </li>
		
		 <!-- ACCOUNTANT -->
        <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/accountant">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('accountants'); ?></span>
            </a>
        </li>
		
		 <!-- HOSTEL MANAGER -->
        <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/hostel">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('hostel_manager'); ?></span>
            </a>
        </li>
		
		 <li class="<?php
        if ($page_name == 'teacher_id_card' ||
		 	$page_name == 'hostel_id_card' ||
			$page_name == 'accountant_id_card' ||			
                $page_name == 'librarian_id_card')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('generate_ID_cards'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'teacher_id_card') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/teacher_id_card">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('teachers'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'hostel_id_card') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/hostel_id_card">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('hostel_manager'); ?></span>
                    </a>
                </li>
				<li class="<?php if ($page_name == 'accountant_id_card') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/accountant_id_card">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('accountants'); ?></span>
                    </a>
                </li>
				<li class="<?php if ($page_name == 'librarian_id_card') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/librarian_id_card">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('librarians'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section' ||
                    $page_name == 'academic_syllabus')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('class'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/classes">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_classes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/section">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('academic_syllabus'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subjects'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('classs'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/class_routine">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routines'); ?></span>
            </a>
        </li>
		
		 <!-- CLUB -->
        <li class="<?php if ($page_name == 'club') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/club">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('school_clubs'); ?></span>
            </a>
        </li>
		
				 <!-- CIRCULAR MANAGER -->
                <li class="<?php if ($page_name == 'circular') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/circular">
                        <span><i class="entypo-book"></i> <?php echo get_phrase('manage_circular'); ?></span>
                    </a>
                </li>
				
			<!-- TASK MANAGER -->
                <li class="<?php if ($page_name == 'task_manager') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/task_manager">
                        <span><i class="entypo-book"></i> <?php echo get_phrase('task_manager'); ?></span>
                    </a>
                </li>
		
		 <!-- STUDY MATERIALS -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/study_material">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('study_materials'); ?></span>
            </a>
        </li>

        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_attendance/<?php echo date("d/m/Y"); ?>">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendances'); ?></span>
            </a>

        </li>
		
		
		
		 <!-- EXAMS -->
        <li class="<?php
        if ($page_name == 'exam_list' ||
                $page_name == 'exam_add' || 
				      $page_name == 'exam_view'||
					   $page_name == 'exam_result_list')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('manage_CBT'); ?></span>
            </a>
            <ul>
			
			<li class="<?php if ($page_name == 'exam_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_exams'); ?></span>
                    </a>
                </li>  
				
                <li class="<?php if ($page_name == 'exam_list' || $page_name == 'exam_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam_list">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('list_exams'); ?></span>
                    </a>
                </li>
				
				 <li class="<?php if ($page_name == 'exam_result_list') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam_result_list">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('view_result'); ?></span>
                    </a>
                </li>    
				            
            </ul>
        </li>
		
	
        <!-- EXAMS -->
        <li class="<?php
        if ($page_name == 'exam' ||
                $page_name == 'grade' ||
                $page_name == 'marks' ||
                    $page_name == 'exam_marks_sms' ||
                    $page_name == 'examquestion' ||
                        $page_name == 'tabulation_sheet')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exams'); ?></span>
            </a>
            <ul>
			  <li class="<?php if ($page_name == 'examquestion') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/examquestion">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_exam_questions'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'exam') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/grade">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_grades'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam_marks_sms">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('send_marks_by_sms'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/tabulation_sheet">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('tabulation_sheet'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

<!-- AASIGNMENTS -->
        <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/assignment">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('assignments'); ?></span>
            </a>
        </li>
        <!-- PAYMENT -->
        <!-- <li class="<?php //if ($page_name == 'invoice') echo 'active'; ?> ">
            <a href="<?php //echo base_url(); ?>index.php?admin/invoice">
                <i class="entypo-credit-card"></i>
                <span><?php //echo get_phrase('payment'); ?></span>
            </a>
        </li> -->

        <!-- ACCOUNTING -->
        <li class="<?php
        if ($page_name == 'income' ||
                $page_name == 'expense' ||
                    $page_name == 'expense_category' ||
                        $page_name == 'student_payment')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_payment">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('create_student_payment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/income">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_payments'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/expense">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/expense_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense_category'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/book">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('libraries'); ?></span>
            </a>
        </li>

        <!-- TRANSPORT -->
        <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/transport">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transports'); ?></span>
            </a>
        </li>

        <!-- DORMITORY -->
        <li class="<?php if ($page_name == 'dormitory') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dormitory">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('dormitories'); ?></span>
            </a>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboards'); ?></span>
            </a>
        </li>
		
		
<!-- HOLIDAYS -->
        <li class="<?php if ($page_name == 'holiday') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/holiday">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('manage_holiday'); ?></span>
            </a>
        </li>
		
		 <!-- TODAYS THOUGHT -->
        <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/todays_thought">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('manage_thoughts'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('messages'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
				 $page_name == 'banar' ||
				  $page_name == 'front_end' ||
				   $page_name == 'news' ||
                    $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/sms_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
				
				<li class="<?php if ($page_name == 'banar') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/banar">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_banners'); ?></span>
                    </a>
                </li>
				
				<li class="<?php if ($page_name == 'front_end') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/front_end">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('front_ends'); ?></span>
                    </a>
                </li>
				
				<li class="<?php if ($page_name == 'news') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/news">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('news_settings'); ?></span>
                    </a>
                </li>
				
				
            </ul>
        </li>
		
  <!-- HELP LINKS -->
        <li class="<?php if ($page_name == 'help_link') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/help_link">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('manage_help_link'); ?></span>
            </a>
        </li>
		
		 <!-- HELP DESK -->
        <li class="<?php if ($page_name == 'help_desk') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/help_desk">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('manage_help_desks'); ?></span>
            </a>
        </li>
		
        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('accounts'); ?></span>
            </a>
        </li>

    </ul>

</div>