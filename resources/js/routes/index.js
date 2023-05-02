import Main from '../Pages/Main.vue'
import Login from '../Pages/Login.vue'
import Superadmin_Dashboard from '../Pages/Superadmin/Superadmin_Dashboard.vue'
import Announcement_Information from '../Pages/SchoolAdmin/Announcement_information.vue'
import Parent_Information from '../Pages/Superadmin/Parent_Information.vue'
import Parent_Dashboard from '../Pages/Parents/Parent_Dashboard.vue'
import Parents_Profile from '../Pages/Parents/Parents_Profile.vue'
import Teacher_Dashboard from '../pages/Teacher/Teacher_Dashboard.vue'
import School_Admin_Dashboard from '../Pages/SchoolAdmin/School_Admin_Dashboard.vue'
import Finance_Officer_Dashboard from '../pages/Staff/Finance_Officer_Dashboard.vue'
import Guard_Dashboard from '../Pages/Staff/Guard_Dashboard.vue'
import Subject_Group from '../pages/SchoolAdmin/Subject_Group.vue'
import Teacher_Profile from '../pages/Teacher/Teacher_Profile.vue'
import Announcement_Posts from '../pages/Teacher/Announcements.vue'
import Room_Group from '../Pages/SchoolAdmin/Room_Group.vue'
import Classes_Group from '../pages/SchoolAdmin/Classes_Group.vue'
import Buildings_Group from '../pages/SchoolAdmin/Buildings_Group.vue'
import Assign_Exam from '../pages/Teacher/Assign_Exam.vue'
import Assign_Quiz from '../pages/Teacher/Assign_Quiz.vue'
import Quiz_Group from '../pages/Teacher/Quiz_Group.vue'
import Exam_Group from '../pages/Teacher/Exam_Group.vue'
import Question_Group from '../pages/Teacher/Question_Group.vue'
import Academic_Relationship from '../pages/Teacher/Academic_Relationship.vue'
import Staff_Dashboard from '../pages/Staff/Staff_Dashboard.vue'
import SuperAdmin_Profile from '../pages/Superadmin/SuperAdmin_Profile.vue'
import Staff_Information from '../pages/Superadmin/Staff_Information.vue'
import Grade_Computation from '../pages/Teacher/Grade_Computation.vue'
import Attendance from '../pages/Teacher/Attendance.vue'
import Student_Report_Summary from '../pages/Teacher/Student_Report_Summary.vue'
import Student_Profile from '../pages/Student/Student_Profile.vue'
//Student_Information
import Student_Information from '../pages/Superadmin/Student_Information.vue'
import Student_Information_Teacher from '../Pages/SchoolAdmin/Student_Information.vue'
//Gate
import Gate_Dashboard from '../Pages/Gate/Gate_Dashboard.vue'
//guard
import Gate_Logs from '../Pages/Guard/gate_logs.vue'
import User_Accounts from '../pages/Superadmin/User_Accounts.vue'
import Teacher_Information from '../Pages/Superadmin/Teacher_Information.vue'
import Student_Dashboard from '../pages/Student/Student_Dashboard.vue'
//Student Folder
import Student_Schedule from '../pages/Student/Student_Schedule.vue'
import Student_Academic_Status from '../pages/Student/Student_Academic_Status.vue'
import Student_Academic_Status_Parent from '../pages/Parents/Student_Academic_Status.vue'
import Student_Attendance_Grade from '../pages/Student/Student_Attendance_Grade.vue'
import Student_Payment from '../pages/Student/Student_Payment.vue'
import Student_Attendance from '../pages/Student/Student_Attendance.vue'
import Student_Files from '../pages/Student/Student_Files.vue'
import Student_Activities from '../pages/Student/Student_Activities.vue'

//Navigation
import StudentNavigation from '../Pages/Navigation/StudentNavigation.vue'
import TeacherNavigation from '../Pages/Navigation/TeacherNavigation.vue'
import SuperadminNavigation from '../Pages/Navigation/SuperadminNavigation.vue'
import StaffNavigation from '../Pages/Navigation/StaffNavigation.vue'
import FinanceNavigation from '../Pages/Navigation/FinanceNavigation.vue'
import ParentNavigation from '../Pages/Navigation/ParentNavigation.vue'
import GuardNavigation from '../Pages/Navigation/GuardNavigation.vue'
import SchooladminNavigation from '../Pages/Navigation/SchooladminNavigation.vue'

import Sample from '../pages/sample.vue'

//Documents
import Document_Page from '../Pages/Files/Parent_Document_Page.vue'
import Finance_Document_Page from '../Pages/Files/Finance_Document_Page.vue'
import Guard_Document_Page from '../Pages/Files/Guard_Document_Page.vue'
import SchoolAdmin_Document_Page from '../Pages/Files/SchoolAdmin_Document_Page.vue'
import image_store from '../Pages/Files/image_store.vue'
import Student_Document_Page from '../Pages/Files/Student_Document.vue'
//gate pass
import Gate_Pass from '../pages/gate_pass.vue'
const requireAuth = (to, from, next) => {
    console.log('Checking if user is authenticated...')
    if (localStorage.getItem('token')) {
      console.log('User is authenticated.')
      next()
    } else {
      console.log('User is not authenticated. Redirecting to login page...')
      next('/login')
    }
  }

export default {
  mode: 'history',
    routes: [
        {
            path: '/',
            component: Login
        },
        {
            path: '/main',
            name: 'main',
            component: Main,
            meta: { requiresAuth: true }
        },
        {
          path: '/gate_logs',
          name: 'gate_logs',
          component: Gate_Logs,
          meta: { requiresAuth: true }
      },
        {
          path: '/gate_pass',
          name: 'gate_pass',
          component: Gate_Pass,
          meta: { requiresAuth: true }
      },
      {
        path: '/gate_dashboard',
        name: 'gate_dashboard',
        component: Gate_Dashboard,
        meta: { requiresAuth: true }
    },
      {
        path: '/student_report_summary',
        name: 'student_report_summary',
        component: Student_Report_Summary,
        meta: { requiresAuth: true }
    },
    {
      path: '/attendance',
      name: 'attendance',
      component: Attendance,
      meta: { requiresAuth: true }
  },
    {
      path: '/student_profile',
      name: 'student_profile',
      component: Student_Profile,
      meta: { requiresAuth: true }
  },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
          path: '/accounts',
          name: 'accounts',
          component: User_Accounts,
          meta: { requireAuth: true }
      },
          {
            path: '/classes',
            name: 'classes',
            component: Classes_Group,
            meta: { requireAuth: true }
        },
        {
          path: '/buildings',
          name: 'buildings',
          component: Buildings_Group,
          meta: { requireAuth: true }
      },
      {
        path: '/assign_exams',
        name: 'assign_exams',
        component: Assign_Exam,
        meta: { requireAuth: true }
    },
    {
      path: '/assign_quizzes',
      name: 'assign_quizzes',
      component: Assign_Quiz,
      meta: { requireAuth: true }
  },
        {
          path: '/subject_group',
          name: 'subject_group',
          component: Subject_Group,    
          meta: { requiresAuth: true }
         },
         {
          path: '/room_group',
          name: 'room_group',
          component: Room_Group,    
          meta: { requiresAuth: true }
         },
         {
          path: '/student_dashboard',
          name: 'student_dashboard',
          component: Student_Dashboard,
          meta: { requiresAuth: true }
         },
         {
          path: '/teacherNavigation',
          name: 'teacherNavigation',
          component: TeacherNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/schooladminNavigation',
          name: 'schooladminNavigation',
          component: SchooladminNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/superadminNavigation',
          name: 'superadminNavigation',
          component: SuperadminNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/studentNavigation',
          name: 'studentNavigation',
          component: StudentNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/guardNavigation',
          name: 'guardNavigation',
          component: GuardNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/parentNavigation',
          name: 'parentNavigation',
          component: ParentNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/staffNavigation',
          name: 'staffNavigation',
          component: StaffNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/financeNavigation',
          name: 'financeNavigation',
          component: FinanceNavigation,
          meta: { requiresAuth: true }
         },
         {
          path: '/question_group',
          name: 'question_group',
          component: Question_Group,    
          meta: { requiresAuth: true }
         },
         {
          path: '/relationship',
          name: 'relationship',
          component: Academic_Relationship,    
          meta: { requiresAuth: true }
         },
         {
          path: '/quiz_group',
          name: 'quiz_group',
          component: Quiz_Group,    
          meta: { requiresAuth: true }
         },
         {
          path: '/exam_group',
          name: 'exam_group',
          component: Exam_Group,    
          meta: { requiresAuth: true }
         },
        {
            path: '/Superadmin_Dashboard',
            name: 'Superadmin_Dashboard',
            component: Superadmin_Dashboard,    
            meta: { requiresAuth: true }
        },
        {
          path: '/announcement_information',
          name: 'announcement_information',
          component: Announcement_Information,    
          meta: { requiresAuth: true }
      },
        {
          path: '/student_information',
          name: 'student_information',
          component: Student_Information,    
          meta: { requiresAuth: true }
      },
      {
        path: '/student_information_teacher',
        name: 'student_information_teacher',
        component: Student_Information_Teacher,    
        meta: { requiresAuth: true }
    },
    {
      path: '/announcement_posts',
      name: 'announcement_posts',
      component: Announcement_Posts,    
      meta: { requiresAuth: true }
  },
        {
            path: '/parent_information',
            name: 'parent_information',
            component: Parent_Information,    
            meta: { requiresAuth: true }
        },

        {
          path: '/parent_dashboard',
          name: 'parent_dashboard',
          component: Parent_Dashboard,    
          meta: { requiresAuth: true }
      },
        {
          path: '/parents_profile',
          name: 'parents_profile',
          component: Parents_Profile,    
          meta: { requiresAuth: true }
      },
        {
            path: '/student_attendance_grade',
            name: 'student_attendance_grade',
            component: Student_Attendance_Grade,    
            meta: { requiresAuth: true }
        },
        {
            path: '/grade_computation',
            name: 'grade_computation',
            component: Grade_Computation,
            meta: { requiresAuth: true }
        },
        {
            path: '/teacher_dashboard',
            name: 'teacher_dashboard',
            component: Teacher_Dashboard,    
            meta: { requiresAuth: true }
        },
        {
          path: '/teacher_profile',
          name: 'teacher_profile',
          component: Teacher_Profile,    
          meta: { requiresAuth: true }
      }, 
        {
            path: '/sample',
            name: 'sample',
            component: Sample,    
            meta: { requiresAuth: true }
        },
        {
          path: '/parent_document_page',
          name: 'Parent_Document_Page',
          component: Document_Page,    
          meta: { requiresAuth: true }
      },
      {
        path: '/student_document_page',
        name: 'student_document_page',
        component: Student_Document_Page,    
        meta: { requiresAuth: true }
    },
      {
        path: '/finance_document_page',
        name: 'Finance_Document_Page',
        component: Finance_Document_Page,    
        meta: { requiresAuth: true }
    },
    {
      path: '/guard_document_page',
      name: 'Guard_Document_Page',
      component: Guard_Document_Page,    
      meta: { requiresAuth: true }
  },
  {
    path: '/schooladmin_document_page',
    name: 'SchoolAdmin_Document_Page',
    component: SchoolAdmin_Document_Page,    
    meta: { requiresAuth: true }
},
      {
        path: '/image_store',
        name: 'image_store',
        component: image_store,    
        meta: { requiresAuth: true }
    },
        {
            path: '/staff_dashboard',
            name: 'staff_dashboard',
            component: Staff_Dashboard,    
            meta: { requiresAuth: true }
        },
        {
          path: '/staff_information',
          name: 'staff_information',
          component: Staff_Information,    
          meta: { requiresAuth: true }
      },

        {
            path: '/teacher_information',
            name: 'teacher_information',
            component: Teacher_Information,    
            meta: { requiresAuth: true }
        },
        {
            path: '/finance_officer_dashboard',
            name: 'finance_officer_dashboard',
            component: Finance_Officer_Dashboard,
            meta: { requiresAuth: true }
        },
        {
            path: '/guard_dashboard',
            name: 'guard_dashboard',
            component: Guard_Dashboard,
            meta: { requiresAuth: true }
        },

        {
            path: '/school_admin_dashboard',
            name: 'school_admin_dashboard',
            component: School_Admin_Dashboard,
            meta: { requiresAuth: true }
        },
        {
          path: '/superadmin_profile',
          name: 'superadmin_profile',
          component: SuperAdmin_Profile,
          meta: { requiresAuth: true }
      },
        {
            path: '/student_schedule',
            name: 'student_schedule',
            component: Student_Schedule,
            meta: { requiresAuth: true }
        },
        {
            path: '/student_academic_status',
            name: 'student_academic_status',
            component: Student_Academic_Status,
            meta: { requiresAuth: true }
        },
        {
          path: '/student_academic_status_parent',
          name: 'student_academic_status_parent',
          component: Student_Academic_Status_Parent,
          meta: { requiresAuth: true }
      },
        {
            path: '/student_payment',
            name: 'student_payment',
            component: Student_Payment,
            meta: { requiresAuth: true }
        },
        {
            path: '/student_attendance',
            name: 'student_attendance',
            component: Student_Attendance,
            meta: { requiresAuth: true }
        },
        {
            path: '/student_files',
            name: 'student_files',
            component: Student_Files,
            meta: { requiresAuth: true }
        },
        {
            path: '/student_activities',
            name: 'student_activities',
            component: Student_Activities,
            meta: { requiresAuth: true }
        },
    ],
    beforeEach: (to, from, next) => {
      if (to.meta.requiresAuth) {
        requireAuth(to, from, next)
      } else if (to.meta.guest) {
        if (localStorage.getItem('token')) {
          next('/dashboard')
        } else {
          next()
        }
      } else {
        next()
      }
    }
}
