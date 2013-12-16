Codeigniter Upload Email
========================

Creates a form which allows users to upload a file and also sends a notice to site admin with complete URL.

This is a relatively basic method to allow users to upload a file to your Codeigniter-based website and simultaneously notify a site administrator. It was built for Codeigniter v. 2.1.4 and probably won't work properly on earlier versions. You will need to customize it by adding your specific URLs, email address, file types, etc. Follow the comments on the PHP files to see where you need to customize it. You may also rename the file called 'Upload'. It's basically creates a view within a view and will allow you to use a file path suited to your purpose.

Currently, I have it set up where the user can only submit Name, Email and Document. I will be working on allowing the user to add a message (textarea).

If you wish to customize the design of the form to match your overall look, you can add your custom code to 'upload_form.php' or 'upload_success'.php. Alternatively, you may also use your templates for Header and Footer by loading them in the controller file 'upload.php' by modifying the code starting on line 13:

// Example:
// $this->load->view('templates/header');
// $this->load->view('upload_form', array('error' => ' ' ));
// $this->load->view('templates/footer');
