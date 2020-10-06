Registration System - By Md. Imran
-----------------------------------

							~~~~~~~~~~~~~~~~
							|Form Prototype|
							~~~~~~~~~~~~~~~~
=============================================================================
Applicant Basic Info
---------------------
Applicant's Name:	|Text Box|

Email Address:	|Text Box|

Applicant Mailing Address
---------------------------
|Division : Dropdown List|       |District : Dropdown List|          |Upazila / Thana : Dropdown List|

Note: Dependency dropdown. Ex. If Select Dhaka from Division Dropdown List  , then only Dhaka division district will come in District : Dropdown List         
      
Address Details:	Text Area

Language Proficiency: 	Bangla  English French  (Check Box)

Applicant Education Qualification
----------------------------------
Exam Name	          University 	      Board	         Result	          Action
Dropdown List        Dropdown List     Dropdown List  	Text Box          Delete
From Table            From Table         From Table

Dropdown List        Dropdown List     Dropdown List     Text Box        Add More..
From Table            From Table         From Table


Photo:	File Upload (Only Allow Image)

CV Attachment:	File Upload (Only Allow DOC/PDF)



Training:	Radio Button YES      Radio Button No

If user click on YES, then the following  Area will open:

Training Name	Training Details	Action
Text Box	       Text Box	
Text Box	       Text Box	       Add More..

Submit Button

====================================================================

				~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				|Registration List Search Wizard|
				~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
====================================================================
Applicant's Name:	Text Box

Email Address:	Text Box

|Division : Dropdown List|      |District : Dropdown List|   |Upazila / Thana : Dropdown List|

Note: Dependency dropdown. Ex. If Select Dhaka from Division Dropdown List  , then only Dhaka division district will come in District : Dropdown List         


Note: Based on search parameter following list will generate.
Registration List

Applicant's Name	Email Address	Division	District 	Upazila / Thana	Insert Date	Action
Mamun	        bdabdulla@gmail.com	Dhaka	Kishoregonj	Kishoregonj  Sadar	2016-08-01	Edit
Mhabub	        mhabub@gmail.com	Dhaka	Mymensingh	Mymensingh Sadar	2016-08-01	Edit
Paging

==============================================================================


Please compete the application based on following requirement:
Technology: 
Framework: Codeigniter/Laravel
Database: MYSQL
	User Part (No Authentication)
	Admin Part:  After login admin will get the registration list.




Note: 
1.	Addes PHP Validation
2.	Apply jQuery Validation in registration form
3.	Form data submited by Ajax
