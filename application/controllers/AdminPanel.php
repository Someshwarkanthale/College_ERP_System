<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminPanel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');  // Load the model
    }


    //-----------------------------------------------------Dashboard-----------------------------------------------------//


    public function Dashboard()
    {
        // Fetch counts using the model
        $data['total_students'] = $this->AdminModel->get_total_students_count();
        $data['total_courses'] = $this->AdminModel->get_total_courses();  // Count total courses
        $data['course_wise_counts'] = $this->AdminModel->get_course_wise_count();
        $data['category_wise_counts'] = $this->AdminModel->get_category_wise_count();

        // Load the dashboard view
        $this->load->view('AdminView/dashboard', $data);
    }


    //---------------------------------------------------Courses & fees Section -------------------------------------//
   
   
    public function CourseFee()
    {

        $courses = $this->AdminModel->get_courses(); // Fetch all courses
        $course_data = []; // To store data for each course

        foreach ($courses as $course) {
            $table_name = strtolower(str_replace(' ', '_', $course->course_name)); // Format table name
            $course_data[$course->course_name] = $this->AdminModel->get_course_data($table_name); // Fetch data
        }

        $data['courses'] = $courses;       // List of courses
        $data['course_data'] = $course_data; // Data for each course table
        $data['additional_fees'] = $this->AdminModel->get_additional_fees(); // Fetch additional fees


        $this->load->view('AdminView/Course_Fee', $data); // Load the view
    }



    // Display the form to add a new course
    public function add_course_form()
    {
        $this->load->view('AdminView/add_course_form');
    }

    public function add_course()
    {
        // Load the form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules(
            'course_name',
            'Course Name',
            'required|regex_match[/^[a-zA-Z\-]+$/]|min_length[2]',
            [
                'required' => 'The %s field is required.',
                'regex_match' => 'The %s field may only contain alphabets and dashes.',
                'min_length' => 'The %s field must be at least 2 characters long.'
            ]
        );
        $this->form_validation->set_rules(
            'fee',
            'Fee',
            'required|numeric',
            [
                'required' => 'The %s field is required.',
                'numeric' => 'The %s field must be a valid number.'
            ]
        );

        // Check if the form validation passed
        if ($this->form_validation->run() == FALSE) {
            // Load the view with error messages
            $this->load->view('AdminView/add_course_form'); // Replace 'add_course' with your actual view file
        } else {
            // Get course name and fee from the form
            $course_name = $this->input->post('course_name');
            $fee = $this->input->post('fee');

            // Check for duplicate entry
            if ($this->AdminModel->course_exists($course_name)) {
                $data['error'] = 'The course name already exists. Please choose a different name.';
                $this->load->view('AdminView/add_course_form', $data); // Reload the view with the error message
            } else {
                // Create a new entry in the courses table
                $this->AdminModel->insert_course($course_name, $fee);

                // Dynamically create a table for the course
                $this->AdminModel->create_course_table($course_name);

                // Redirect or show a success message
                redirect('index.php/AdminPanel/CourseFee');
            }
        }
    }
    private function format_table_name($course_name)
    {
        return strtolower(str_replace(' ', '_', $course_name));
    }

    public function update_course($course_id)
    {
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules(
            'course_name',
            'Course Name',
            'required|regex_match[/^[a-zA-Z\-]+$/]|min_length[2]',
            [
                'required' => 'The %s field is required.',
                'regex_match' => 'The %s field may only contain alphabets and dashes.',
                'min_length' => 'The %s field must be at least 2 characters long.'
            ]
        );
        $this->form_validation->set_rules(
            'fee',
            'Fee',
            'required|numeric',
            [
                'required' => 'The %s field is required.',
                'numeric' => 'The %s field must be a valid number.'
            ]
        );

        // Check if form validation passed
        if ($this->form_validation->run() == FALSE) {
            $data['course'] = $this->AdminModel->get_course_by_id($course_id);
            $this->load->view('AdminView/update_course_form', $data);
        } else {
            // Get updated values
            $new_name = $this->input->post('course_name');
            $new_fee = $this->input->post('fee');

            // Fetch current course details
            $current_course = $this->AdminModel->get_course_by_id($course_id);
            if (!$current_course) {
                show_404();
            }

            $current_table_name = $this->format_table_name($current_course->course_name);
            $new_table_name = $this->format_table_name($new_name);

            $this->db->trans_start();

            // Update course details
            $this->AdminModel->update_course($course_id, [
                'course_name' => $new_name,
                'fee' => $new_fee,
            ]);

            // Rename table if the course name is updated
            if ($current_table_name !== $new_table_name) {
                $this->AdminModel->rename_table($current_table_name, $new_table_name);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $data['error'] = 'Failed to update the course. Please try again.';
                $this->load->view('AdminView/update_course_form', $data);
            } else {
                redirect('index.php/AdminPanel/CourseFee');
            }
        }
    }

    public function delete_course($course_id)
    {
        // Fetch the course name by ID
        $course = $this->AdminModel->get_course_by_id($course_id);

        if ($course) {
            $course_name = strtolower(str_replace(' ', '_', $course->course_name));

            // Delete the related table
            $this->AdminModel->delete_related_table($course_name);

            // Delete the course from the `courses` table
            $this->AdminModel->delete_course($course_id);
        }

        // Redirect to the courses list with success message
        redirect('index.php/AdminPanel/CourseFee');
    }

//--------------------------------------------------------------Additional fee---------------------------------------//

    // Add additional fee form
    public function add_additional_fee_form()
    {
        $this->load->view('AdminView/additional_fee_form');
    }

    // Save new additional fee
    public function add_additional_fee()
    {
        $data = array(
            'department' => $this->input->post('department'),
            'fee' => $this->input->post('fee')
        );
        $this->AdminModel->add_additional_fee($data);
        redirect('index.php/AdminPanel/CourseFee'); // Redirect to the list of additional fees
    }

    // Edit additional fee form
    public function Upadate_additional_fee_form($id)
    {
        $data['fee'] = $this->AdminModel->get_additional_fee($id);
        $this->load->view('AdminView/update_additional_fee', $data);
    }

    // Update an additional fee
    public function update_additional_fee($id)
    {
        $data = array(
            'department' => $this->input->post('department'),
            'fee' => $this->input->post('fee')
        );
        $this->AdminModel->update_additional_fee($id, $data);
        redirect('index.php/AdminPanel/CourseFee'); // Redirect back to the list
    }

    // Delete an additional fee
    public function delete_additional_fee($id)
    {
        $this->AdminModel->delete_additional_fee($id);
        redirect('index.php/AdminPanel/CourseFee'); // Redirect back to the list
    }



    //----------------------------------------------------------Add category--------------------------------------------------//



    // Display the form to add data to a course's dynamically created table
    public function add_Category_form($course_name)
    {
        $data['course_name'] = $course_name;  // Pass course name to the view
        $this->load->view('AdminView/add_category_form', $data);
    }

    // Handle the form submission to add data to the course's table
    public function add_Category()
    {
        // Get course data from form
        $course_name = $this->input->post('course_name');
        $category = $this->input->post('category');
        $fee = $this->input->post('fee');

        // Insert data into the dynamically created table
        $this->AdminModel->insert_course_data($course_name, $category, $fee);

        // Redirect back to the courses list
        redirect('index.php/AdminPanel/CourseFee');
    }

    public function update_Category_form($course_name, $id)
    {
        $table_name = strtolower(str_replace(' ', '_', $course_name)); // Format table name
        $data['record'] = $this->AdminModel->get_record_by_id($table_name, $id); // Fetch the record by ID
        $data['course_name'] = $course_name; // Pass course name to view
        $this->load->view('AdminView/update_category_form', $data);
    }

    public function update_Category()
    {
        $course_name = $this->input->post('course_name');
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $fee = $this->input->post('fee');

        $table_name = strtolower(str_replace(' ', '_', $course_name));
        $this->AdminModel->update_record($table_name, $id, $category, $fee);

        redirect('index.php/AdminPanel/CourseFee');
    }

    public function delete_Category($course_name, $id)
    {
        $table_name = strtolower(str_replace(' ', '_', $course_name));
        $this->AdminModel->delete_record($table_name, $id);

        redirect('index.php/AdminPanel/CourseFee');
    }




    //------------------------------------Student Reports-----------------------------------------------------------//
   
      // List all students
      public function Studentlist()
      {
          $search = $this->input->get('search');  // Get search input from the form
  
          // Check if search query is not empty and filter based on name, course, or category
          if ($search) {
              $this->db->like('student_name', $search);
              $this->db->or_like('course_name', $search);
              $this->db->or_like('category', $search);
          }
          if (empty($students)) {
              $data['message'] = "No students found matching your search criteria.";
          } else {
              $data['message'] = null;
          }
          $data['students'] = $this->AdminModel->get_all_students();
          $this->load->view('AdminView/students_list', $data);
      }

      public function getSuggestions() {
        $search = $this->input->get('search');
        $this->load->model('AdminModel'); // Load your model
        $results = $this->AdminModel->getMatchingStudents($search);
        echo json_encode($results); // Return results as JSON
    }
    




//------------------------------------------Add Student---------------------------------------------------------------//


       // Fetch categories and fees for the selected course
    public function fetch_categories()
    {
        $course_name = $this->input->post('course_name');
        $categories = $this->AdminModel->get_categories_and_fees($course_name);

        echo json_encode($categories);
    }

    // Fetch fee for the selected course and category
    public function fetch_fee()
    {
        $course_name = $this->input->post('course_name');
        $category = $this->input->post('category');
        $categories = $this->AdminModel->get_categories_and_fees($course_name);

        // Find the fee for the selected category
        $fee = [];
        foreach ($categories as $cat) {
            if ($cat->category == $category) {
                $fee[] = $cat;
            }
        }

        echo json_encode($fee);
    }


    public function AddStudentForm()
    {
        // Fetch the list of courses and additional fees from the model
        $data['courses'] = $this->AdminModel->get_courses();
        $data['additional_fees'] = $this->AdminModel->get_additional_fees();  // Fetch additional fees

        // Load the student registration form view and pass course and additional fee data
        $this->load->view('AdminView/student_form', $data);
    }

    public function add_student()
    {
        // Get the student registration details from the form submission
        $name = $this->input->post('name');
        $course_name = $this->input->post('course');
        $category = $this->input->post('category');
        $base_fee = $this->input->post('fee');  // Base fee for the selected course/category
        $additional_fees = $this->input->post('additional_fees');  // Additional fees selected by checkboxes

        // Calculate total fee by adding selected additional fees
        $total_fee = $base_fee;

        // If additional fees are selected, add them to the total fee
        if (!empty($additional_fees)) {
            foreach ($additional_fees as $additional_fee_id) {
                $additional_fee = $this->AdminModel->get_additional_fee_by_id($additional_fee_id);
                $total_fee += $additional_fee->fee;  // Add each additional fee to the total fee
            }
        }

        // Set the paid and remaining fee values (assuming no fee is paid initially)
        $paid_fee = 0;
        $remaining_fee = $total_fee - $paid_fee;

        // Insert student data into the database
        $this->AdminModel->insert_student($name, $course_name, $category, $total_fee, $paid_fee, $remaining_fee);

        // Redirect to the student list page after registration
        redirect('index.php/AdminPanel/Studentlist');
    }
    public function edit_student($id)
    {
        // Fetch the student data by ID
        $data['student'] = $this->AdminModel->get_student_by_id($id);
        // Fetch the list of courses and additional fees from the model
        $data['courses'] = $this->AdminModel->get_courses();

        // Load the update form view
        $this->load->view('AdminView/update_student_form', $data);
    }
    public function update_student()
    {
        // Get input data
        $id = $this->input->post('id');
        $total_fee = $this->input->post('total_fee');
        $paid_fee = $this->input->post('paid_fee');

        // Calculate the remaining fee
        $remaining_fee = $total_fee - $paid_fee;

        // Prepare update data
        $update_data = [
            'student_name' => $this->input->post('student_name'),
            'course_name' => $this->input->post('course'),
            'category' => $this->input->post('category'),
            'total_fee' => $total_fee,
            'paid_fee' => $paid_fee,
            'remaining_fee' => $remaining_fee, // Automatically calculated
        ];

        // Update the student record
        $this->AdminModel->update_student($id, $update_data);

        // Redirect back to the student list
        redirect('index.php/AdminPanel/Studentlist');
    }


    // Delete student and associated data
    public function delete($id)
    {
        $this->AdminModel->delete_student($id);
        redirect('index.php/AdminPanel/Studentlist');
    }



//------------------------------------Fee Payment----------------------------------------------------------------------//


    public function pay_fee_form($id)
    {
        // Fetch student details and previous transactions
        $data['student'] = $this->AdminModel->get_student_by_id($id);
        $data['transactions'] = $this->AdminModel->get_transactions_by_student_id($id);

        // Load the fee payment form view
        $this->load->view('AdminView/pay_fee_form', $data);
    }

    public function process_fee_payment()
    {
        $id = $this->input->post('student_id');
        $paid_fee = $this->input->post('paid_fee');

        // Fetch the student's details
        $student = $this->AdminModel->get_student_by_id($id);

        if (!$student) {
            // If the student doesn't exist, redirect back with an error
            $this->session->set_flashdata('error', 'Student not found.');
            redirect('index.php/AdminPanel/pay_fee/' . $id);
        }

        // Validate that the paid fee does not exceed the remaining fee
        if ($paid_fee > $student->remaining_fee) {
            // Redirect back with an error message
            $this->session->set_flashdata('error', 'The entered fee cannot exceed the remaining fee.');
            redirect('index.php/AdminPanel/pay_fee/' . $id);
        }

        // Record the transaction and update the student's fee details
        $this->AdminModel->add_transaction($id, $paid_fee);

        // Redirect to the invoice page
        $this->session->set_flashdata('success', 'Payment successfully recorded.');
        redirect('index.php/AdminPanel/invoice/' . $id);
    }


    public function invoice($id)
    {
        $data['student'] = $this->AdminModel->get_student_by_id($id);
        $data['transactions'] = $this->AdminModel->get_transactions_by_student_id($id);

        // Load the invoice view
        $this->load->view('AdminView/invoice', $data);
    }
   
}
